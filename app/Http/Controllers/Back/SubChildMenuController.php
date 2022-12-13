<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Models\SubChildMenu,
    Repositories\SubChildMenuRepository
};
use DB;
use Response;
use Illuminate\Support\Str;

class SubChildMenuController extends Controller
{
    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(SubChildMenuRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'sub_child_menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request['search'])?$request['search']:null;
        $subchildmenus = SubChildMenu::select('name','active','created_at','id','hierarchy','child_menu_id')->orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $subchildmenus =  SubChildMenu::where('name', 'like', "%".$search."%")->paginate(10);
        }
        $links = $subchildmenus->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.sub-child-menus.table", ['subchildmenus' => $subchildmenus])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.sub-child-menus.index', compact ('subchildmenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array_select = array('' => '--Select--');

        $child_menus = ChildMenu::all()->where('sub_child_menu','Y')->pluck('name','id');

        foreach ($child_menus as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $child_menus = $array_select;
      

        $actual_child_menu = null;
        $actual_display_menu = null;

        $display_child_menu = array('Y' => 'Yes','N' => 'No');

        $route="create";
        $menu_id = 0;

        return view('back.sub-child-menus.create',compact('child_menus','actual_child_menu','actual_display_menu','display_child_menu','route','menu_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
       $result = $this->repository->store($request);
       
       if($result == 'success')
       {
            return redirect(route('sub-child-menus.index'))->with('category-ok', __('Sub Child menu added successfully'));
       }
       else
       {

         return redirect(route('sub-child-menus.index'))->with('category-danger', __('The Sub Child menu already exist'));
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubChildMenu  $subChildMenu
     * @return \Illuminate\Http\Response
     */
    public function show(SubChildMenu $subChildMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubChildMenu  $subChildMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(SubChildMenu $sub_child_menu)
    {
        $subchildmenus = $sub_child_menu;

        $child_menus = ChildMenu::all()->where('sub_child_menu','Y')->pluck('name','id');

        foreach ($child_menus as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $child_menus = $array_select;
      
        $actual_child_menu = $sub_child_menu->child_menu_id;

        $actual_display_menu = $sub_child_menu->display_child_menu;

        $display_child_menu = array('Y' => 'Yes','N' => 'No');

        $route="edit";

        $menu_id = $subchildmenus->id;

        return view('back.sub-child-menus.edit',compact('subchildmenus','actual_child_menu','actual_display_menu','display_child_menu','child_menus','route','menu_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubChildMenu  $subChildMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubChildMenu $sub_child_menu)
    {
        $result = $this->repository->update($sub_child_menu, $request);

        if($result == 'success')
       {
             return redirect(route('sub-child-menus.index'))->with('category-ok', __('The Sub child menu details has been successfully updated'));
       }
       else
       {

         return redirect(route('sub-child-menus.index'))->with('category-danger', __('The Sub child menu already exist. Cannot update'));
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubChildMenu  $subChildMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubChildMenu $sub_child_menu)
    {
        $sub_child_menu->delete ();
        return response ()->json ();
    }

    /**
     * Update "active" field for SubChildMenu.
     *
     * @param  \App\Models\SubChildMenu $sub_child_menu
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(SubChildMenu $sub_child_menu, $status = false)
    {
        $sub_child_menu->active = $status;
        $sub_child_menu->save();

        return response ()->json ();
    }


    public function getSubContentList(Request $request)
    {
        $subContentList = PostTab::where('post_id',$request->id)->whereNull('deleted_at')->pluck('post_tabs.tab_title', 'post_tabs.id');

        return response ()->json($subContentList);
    }

     public function deletePostTabSection(Request $request)
    {
       PostTab::where('id',$request->id)->delete();

       return 'true';
       
    }

    public function gethierarchy(Request $request)
    {
        $hierarchy_nos = SubChildMenu::select(DB::raw('MAX(hierarchy)+1 as max'))->where('child_menu_id', $request->id)->whereNull('deleted_at')->first();


        if (is_null($hierarchy_nos->max)) {
            $hierarchy_no = 1;

        } else {
            $hierarchy_no = $hierarchy_nos->max;
        }

        return Response::json($hierarchy_no);
    }

    public function checkHierarchy(Request $request)
    {
        $hierarchy_exist = SubChildMenu::where('child_menu_id', $request->child_menu_id)->where('hierarchy', $request->hierarchy)->first();

        if (!$hierarchy_exist) {
            return 'success';
        } else {
            return 'error';
        }

    }

    public function checkPostHierarchy(Request $request)
    {
        $hierarchy_exist = SubChildMenu::where('id','!=',$request->id)->where('child_menu_id', $request->child_menu_id)->where('hierarchy', $request->hierarchy)->first();


        if (!$hierarchy_exist) {
            return 'success';
        } else {
            return 'error';
        }

    }
}
