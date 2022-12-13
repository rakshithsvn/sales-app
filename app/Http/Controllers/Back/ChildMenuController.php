<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\FacultyRequest,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Models\SubChildMenu,
    Repositories\ChildMenuRepository
};
use DB;
use Response;
use Illuminate\Support\Str;

class ChildMenuController extends Controller
{

    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(ChildMenuRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'child_menus';
    }
    /**
     * Display a listing of the sliders.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request['search'])?$request['search']:null;
        $childmenus = ChildMenu::select('name','active','created_at','id','hierarchy','sub_menu_id')->orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $childmenus =  ChildMenu::where('name', 'like', "%".$search."%")->paginate(10);
        }
        $links = $childmenus->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.child-menus.table", ['childmenus' => $childmenus])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.child-menus.index', compact ('childmenus'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array_select = array('' => '--Select--');

        $sub_menus = SubMenu::all()->where('child_menu','Y')->pluck('name','id');

        foreach ($sub_menus as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $sub_menus = $array_select;
      

        $actual_sub_menu = null;
        $actual_display_menu = null;
        $actual_sub_child_menu = null;

        $display_child_menu = array('Y' => 'Yes','N' => 'No');

        $sub_child_menu = array('N' => 'No','Y' => 'Yes');

        $route="create";
        $menu_id = 0;

        return view('back.child-menus.create',compact('sub_menus','actual_sub_menu','actual_display_menu','display_child_menu','route','menu_id','actual_sub_child_menu','sub_child_menu'));
    }

    
    public function store(Request $request)
    {
       //dd($request->all());
       $result = $this->repository->store($request);
       
       if($result == 'success')
       {
            return redirect(route('child-menus.index'))->with('category-ok', __('Child menu added successfully'));
       }
       else
       {

         return redirect(route('child-menus.index'))->with('category-danger', __('The Child menu already exist'));
       }

    
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildMenu $child_menu)
    {
        $childmenus = $child_menu;

        $sub_menus = SubMenu::all()->where('child_menu','Y')->pluck('name','id');

        foreach ($sub_menus as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $sub_menus = $array_select;
      
        $actual_sub_menu = $child_menu->sub_menu_id;

        $actual_display_menu = $child_menu->display_child_menu;

        $actual_sub_child_menu = $child_menu->sub_child_menu;

        $display_child_menu = array('Y' => 'Yes','N' => 'No');

        $sub_child_menu = array('N' => 'No','Y' => 'Yes');

        $route="edit";

        $menu_id = $childmenus->id;

        return view('back.child-menus.edit',compact('childmenus','actual_sub_menu','actual_display_menu','display_child_menu','sub_menus','route','menu_id','actual_sub_child_menu','sub_child_menu'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, ChildMenu $child_menu)
    {
   
        $result = $this->repository->update($child_menu, $request);

        if($result == 'success')
       {
             return redirect(route('child-menus.index'))->with('category-ok', __('The child menu details has been successfully updated'));
       }
       else
       {

         return redirect(route('child-menus.index'))->with('category-danger', __('The child menu already exist. Cannot update'));
       }
        
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(ChildMenu $childmenu, $status = false)
    {
        $childmenu->active = $status;
        $childmenu->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildMenu $child_menu)
    { 
        $sub_child_menu = SubChildMenu::where('child_menu_id',$child_menu->id)->first();
        
        if($sub_child_menu){
            return redirect(route('child-menus.index'))->with('category-danger', __('The menu has Child Menus. Cannot Delete'));          
        }else{
           
            $child_menu->delete ();
            return response ()->json ();
        }
    }


    public function getSubContentList(Request $request)
    {
        $subContentList = PostTab::where('post_id',$request->id)->whereNull('deleted_at')->pluck('post_tabs.tab_title', 'post_tabs.id');

        return response ()->json($subContentList);
    }

     public function deletePostTabSection(Request $request)
    {
       FacultyTab::where('id',$request->id)->delete();

       return 'true';
       
    }

    public function gethierarchy(Request $request)
    {
        $hierarchy_nos = ChildMenu::select(DB::raw('MAX(hierarchy)+1 as max'))->where('sub_menu_id', $request->id)->whereNull('deleted_at')->first();


        if (is_null($hierarchy_nos->max)) {
            $hierarchy_no = 1;

        } else {
            $hierarchy_no = $hierarchy_nos->max;
        }

        return Response::json($hierarchy_no);
    }

    public function checkHierarchy(Request $request)
    {
        $hierarchy_exist = ChildMenu::where('sub_menu_id', $request->sub_menu_id)->where('hierarchy', $request->hierarchy)->first();

        if (!$hierarchy_exist) {
            return 'success';
        } else {
            return 'error';
        }

    }

    public function checkPostHierarchy(Request $request)
    {
        $hierarchy_exist = ChildMenu::where('id','!=',$request->id)->where('sub_menu_id', $request->sub_menu_id)->where('hierarchy', $request->hierarchy)->first();



        if (!$hierarchy_exist) {
            return 'success';
        } else {
            return 'error';
        }

    }

}
