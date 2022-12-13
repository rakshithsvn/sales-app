<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\ParentMenu
};
use DB;
use Response;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct()
    {
        // $this->repository = $repository;

        $this->table = 'dashboard';
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
        $parentmenus = ParentMenu::orderBy('id','asc')->paginate(10);

        if(isset($search))
        {
            $parentmenus =  ParentMenu::where('name', 'like', "%".$search."%")->paginate(10);
        }
        $links = $parentmenus->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.parent-menus.table", ['parentmenus' => $parentmenus])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.parent-menus.index', compact ('parentmenus'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array_select = array('' => '--Select--');

        $parent_menus = ParentMenu::all()->where('display_menu','=','Y')->pluck('name','id');

        foreach ($parent_menus as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $parent_menus = $array_select;

        $menu_option = array('Y' => 'Yes','N' => 'No');

        // $menu_option = array('' => '--Select--','Y' => 'Yes','N' => 'No');

        $layouts = array('COMMON','ABOUT','SERVICES','PORTFOLIO','BLOG','CONTACT');

        $route = "create";

        $menu_id = 0;

        return view('back.parent-menus.create',compact('parent_menus','menu_option','layouts','route','menu_id'));
    }

    
    public function store(Request $request)
    {
       //dd($request->all());
       $result = $this->repository->store($request);

       if($result == 'success')
       {
        return redirect(route('parent-menus.index'))->with('category-ok', __('Parent menu added successfully'));
    }
    else
    {
     return redirect(route('parent-menus.index'))->with('category-danger', __('The Parent menu already exist'));
 }

}

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentMenu $parent_menu)
    {

      $parentmenus = $parent_menu;

      $array_select = array('' => '--Select--');

      $parent_menus = ParentMenu::all()->where('display_menu','=','Y')->where('parent_menu','=','Y')->pluck('name','id');

      foreach ($parent_menus as $key => $value) 
      {
        $array_select[$key] = $value;
    }

    $parent_menus = $array_select;

    $menu_option = array('Y' => 'Yes','N' => 'No');

    $layouts = array('COMMON','ABOUT','SERVICES','PORTFOLIO','BLOG','CONTACT');

    $route = "edit";

    $menu_id = $parentmenus->id;

    return view('back.parent-menus.edit', compact ('parentmenus','parent_menus','menu_option','layouts','route','menu_id'));
}

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, ParentMenu $parent_menu)
    {

        $result = $this->repository->update($parent_menu, $request);

        if($result == 'success')
        {
         return redirect(route('parent-menus.index'))->with('category-ok', __('The menu details has been successfully updated'));
     }
     else
     {

         return redirect(route('parent-menus.index'))->with('category-danger', __('The menu already exist. Cannot update'));
     }

 }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
     public function updateActive(ParentMenu $parentmenu, $status = false)
     {
        $parentmenu->active = $status;
        $parentmenu->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentMenu $parent_menu)
    {
        $sub_menu = ChildMenu::where('parent_menu_id',$parent_menu->id)->first();
        
        if($sub_menu){
            return redirect(route('parent-menus.index'))->with('category-danger', __('The menu has Child Menus. Cannot Delete'));          
        }else{
            $parent_menu->delete ();
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
    $hierarchy_nos = ParentMenu::select(DB::raw('MAX(hierarchy)+1 as max'))->where('parent_menu_id', $request->id)->whereNull('deleted_at')->first();


    if (is_null($hierarchy_nos->max)) {
        $hierarchy_no = 1;

    } else {
        $hierarchy_no = $hierarchy_nos->max;
    }

    return Response::json($hierarchy_no);
}

public function checkHierarchy(Request $request)
{
    $hierarchy_exist = ParentMenu::where('parent_menu_id', $request->parent_menu_id)->where('hierarchy', $request->hierarchy)->first();

    if (!$hierarchy_exist) {
        return 'success';
    } else {
        return 'error';
    }

}

public function checkPostHierarchy(Request $request)
{
    $hierarchy_exist = ParentMenu::where('id','!=',$request->id)->where('parent_menu_id', $request->parent_menu_id)->where('hierarchy', $request->hierarchy)->first();

    if (!$hierarchy_exist) {
        return 'success';
    } else {
        return 'error';
    }

}

}
