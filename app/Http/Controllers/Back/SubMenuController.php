<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\FacultyRequest,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Repositories\SubMenuRepository
};
use DB;
use Response;
use Illuminate\Support\Str;

class SubMenuController extends Controller
{

    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(SubMenuRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'sub_menus';
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
        $submenus = SubMenu::select('name','active','created_at','id','hierarchy','parent_menu_id')->orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $submenus =  SubMenu::where('name', 'like', "%".$search."%")->paginate(10);
        }
        $links = $submenus->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.sub-menus.table", ['submenus' => $submenus])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.sub-menus.index', compact ('submenus'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array_select = array('' => '--Select--');

        $parent_menus = ParentMenu::all()->where('display_menu','=','Y')->where('sub_menu','=','Y')->pluck('name','id');

        foreach ($parent_menus as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $parent_menus = $array_select;

        $actual_parent_menu = null;
        $actual_display_menu = null;
        $actual_child_menu = null;

        $display_sub_menu = array('Y' => 'Yes','N' => 'No');

        $child_menu = array('' => '--Select--','Y' => 'Yes','N' => 'No');

        $route="create";
        $menu_id = 0;

        return view('back.sub-menus.create',compact('parent_menus','actual_parent_menu','display_sub_menu','actual_display_menu','actual_child_menu','route','menu_id','child_menu'));
    }

    
    public function store(Request $request)
    {
       //dd($request->all());
       $result = $this->repository->store($request);
       
       if($result == 'success')
       {
            return redirect(route('sub-menus.index'))->with('category-ok', __('Sub menu added successfully'));
       }
       else
       {

         return redirect(route('sub-menus.index'))->with('category-danger', __('The Sub menu already exist'));
       }

    
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(SubMenu $sub_menu)
    {
      $submenus = $sub_menu;

        $array_select = array('' => '--Select--');

        $parent_menus = ParentMenu::all()->where('display_menu','=','Y')->where('sub_menu','=','Y')->pluck('name','id');

        foreach ($parent_menus as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $parent_menus = $array_select;

 // dd($submenus);
        $actual_parent_menu = $sub_menu->parent_menu_id;

        $actual_display_menu = $sub_menu->display_sub_menu;

        $actual_child_menu = $sub_menu->child_menu;

        $display_sub_menu = array('Y' => 'Yes','N' => 'No');

        $child_menu = array('' => '--Select--','Y' => 'Yes','N' => 'No');

        $route="edit";

        $menu_id = $submenus->id;


        return view('back.sub-menus.edit', compact ('submenus','parent_menus','actual_parent_menu','actual_display_menu','actual_child_menu','display_sub_menu','route','menu_id','child_menu'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, SubMenu $sub_menu)
    {
   
        $result = $this->repository->update($sub_menu, $request);

        if($result == 'success')
       {
             return redirect(route('sub-menus.index'))->with('category-ok', __('The menu details has been successfully updated'));
       }
       else
       {

         return redirect(route('sub-menus.index'))->with('category-danger', __('The menu already exist. Cannot update'));
       }
        
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(SubMenu $submenu, $status = false)
    {
        $submenu->active = $status;
        $submenu->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMenu $sub_menu)
    {
        $child_menu = ChildMenu::where('sub_menu_id',$sub_menu->id)->first();
        
        if($child_menu){
            return redirect(route('sub-menus.index'))->with('category-danger', __('The menu has Child Menus. Cannot Delete'));          
        }else{
            $sub_menu->delete ();
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
        $hierarchy_nos = SubMenu::select(DB::raw('MAX(hierarchy)+1 as max'))->where('parent_menu_id', $request->id)->whereNull('deleted_at')->first();


        if (is_null($hierarchy_nos->max)) {
            $hierarchy_no = 1;

        } else {
            $hierarchy_no = $hierarchy_nos->max;
        }

        return Response::json($hierarchy_no);
    }

    public function checkHierarchy(Request $request)
    {
        $hierarchy_exist = SubMenu::where('parent_menu_id', $request->parent_menu_id)->where('hierarchy', $request->hierarchy)->first();

        if (!$hierarchy_exist) {
            return 'success';
        } else {
            return 'error';
        }

    }

    public function checkPostHierarchy(Request $request)
    {
        $hierarchy_exist = SubMenu::where('id','!=',$request->id)->where('parent_menu_id', $request->parent_menu_id)->where('hierarchy', $request->hierarchy)->first();



        if (!$hierarchy_exist) {
            return 'success';
        } else {
            return 'error';
        }

    }

}
