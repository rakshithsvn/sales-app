<?php

namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ {
    Http\Requests\PostRequest,
    Http\Controllers\Controller,
    Models\Category,
    Models\Post,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Models\SubChildMenu,
    Models\ChooseNo,
    Models\PostTab,

    Repositories\PostRepository
};
use Carbon\Carbon;
use DB;

class PostController extends Controller
{
    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'posts';
    }

    /**
     * Update "new" field for post.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Post $post)
    {
        $post->ingoing->delete ();

        return response ()->json ();
    }

    /**
     * Update "active" field for post.
     *
     * @param  \App\Models\Post $post
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Post $post, $status = false)
    {
        $post->active = $status;
        $post->save();

        return response ()->json ();
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //  $parent_menus = ParentMenu::all()->pluck('name','id')->prepend('--Select--');

        $parent_menus = ParentMenu::where('status','Active')->where('post_entry','Y')->pluck('name','id')->prepend('--Select--','');

        $categories = Category::all()->pluck('title', 'id');

       // dd($parent_menus);

        $sub_menus = array('' => '--Select--');
        $actual_parent_slug = null;
        $actual_sub_slug = null;
        $actual_parent_menu = null;
        $actual_category = null;
        $actual_sub_menu = null;
        $actual_child_menu = null;
        $actual_sub_child_menu = null;
        $actual_event_date = null;
        $post_tabs = null;
        $actual_event_to_date = null;
        $actual_event_time = null;
        $actual_event_to_time = null;
        $title1 = null;
        $title2 = null;

        $actual_brochure = 'N';

        return view('back.posts.create', compact('actual_parent_slug','actual_sub_slug','parent_menus','actual_parent_menu','actual_sub_menu','actual_child_menu','actual_sub_child_menu','actual_event_date','post_tabs','actual_event_to_date','actual_event_time','actual_event_to_time','actual_brochure','categories','actual_category','title1','title2'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        // dd($request->all());

       $result = $this->repository->store($request);

       if($result == 'success')
       {
         return redirect(route('posts.index'))->with('post-ok', __('The post has been successfully created'));
     }
     else
     {

         return redirect(route('posts.index'))->with('post-danger', __('The post already exist'));
     }


 }


    /**
     * Display the post.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('back.posts.show', compact('post'));
    }



    /**
     * Show the form for editing the post.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       // dd($post);
       // $this->authorize('manage', $post);

       $categories = Category::all()->pluck('title', 'id');

       $parent_menus = ParentMenu::where('status','Active')->where('post_entry','Y')->pluck('name','id')->prepend('--Select--','');

       $actual_parent_slug = $post->mainMenu->slug;

       $actual_sub_slug = @$post->subMenu->slug;

       $actual_parent_menu = $post->parent_menu_id;

       $actual_category = $post->category_id;

       $actual_sub_menu = $post->sub_menu_id;

       $actual_child_menu =$post->child_menu_id;

       $actual_sub_child_menu =$post->sub_child_menu_id;

       if (!empty($post->event_date)) {

        $actual_event_date = $post->event_date->format('d/m/Y');
           //dd($actual_event_date);
    }
    else
    {
        $actual_event_date =null;
    }

    if (!empty($post->event_to_date)) {

        $actual_event_to_date = $post->event_to_date->format('d/m/Y');
    }
    else
    {
        $actual_event_to_date =null;
    }


    if($post->tab_section == 'Y')
    {
        $post_tabs = PostTab::where('post_id','=',$post->id)->get();
        $tab_id = $post_tabs->pluck('id');
    }
    else
    {
        $post_tabs = null;
        $tab_id = null;
    }

    $actual_brochure = null;

    $title1 = null;
    $title2 = null;

    $actual_event_time = null;
    $actual_event_to_time = null;

       // dd($actual_event_date);
    return view('back.posts.edit', compact('post', 'parent_menus','actual_parent_slug','actual_sub_slug','actual_parent_menu','actual_sub_menu','actual_child_menu','actual_sub_child_menu','actual_event_date','post_tabs','tab_id','actual_event_to_date','actual_event_time','actual_event_to_time','actual_brochure','categories','actual_category','title1','title2'));
}



    /**
     * Update the post in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
         // dd($request->all());
        // $this->authorize('manage', $post);

        $result = $this->repository->update($post, $request);

        if($result == 'success')
        {
            return redirect(route('posts.index'))->with('post-ok', __('The post has been successfully updated'));
        }
        else
        {

         return redirect(route('posts.index'))->with('post-danger', __('The post already exist. Cannot update'));
     }

 }

    /**
     * Remove the post from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $this->authorize('manage', $post);

        //dd($post);

        $post->delete ();

        PostTab::where('post_id', $post->id)->delete();

        return response ()->json ();
    }


    public function getParentSlug(Request $request)
    {
        $parentSlug = ParentMenu::select('name','slug')->where('id', $request->id)->first();

        return response ()->json($parentSlug);
    }

    public function getSubSlug(Request $request)
    {
        $subSlug = SubMenu::select('name','slug')->where('id', $request->id)->first();

        return response ()->json($subSlug);
    }

    public function getSubmenuList(Request $request)
    {
      $subMenuList = SubMenu::where('parent_menu_id', $request->id)->where('link_active', '!=', 1)->whereNull('deleted_at')->pluck('sub_menus.name', 'sub_menus.id');

      return response ()->json($subMenuList);
  }

  public function getChildmenuList(Request $request)
  {
    $childMenuList = ChildMenu::where('sub_menu_id', $request->id)->whereNull('deleted_at')->pluck('name', 'id');

    return response ()->json($childMenuList);
}

public function getSubChildmenuList(Request $request)
{
    $subChildMenuList = SubChildMenu::where('child_menu_id', $request->id)->whereNull('deleted_at')->pluck('name', 'id');

    return response ()->json($subChildMenuList);
}

public function viewCounter()
{

    $counter_details = ChooseNo::first();

    return view('back.posts.counter',compact('counter_details'));
}

public function storeCounterDetails(Request $request)
{
        // dd($request->all());

    $this->repository->storeCount($request);

    return redirect(route('choose.index'))->with('post-ok', __('The count has been successfully updated'));
}

public function viewROI()
{
    $roi_details = DB::table('roi_creds')->first();

    return view('back.posts.roi',compact('roi_details'));
}

public function storeROI(Request $request)
{
    // dd($request->all());

    $this->repository->storeROI($request);

    return redirect(route('roi.index'))->with('post-ok', __('The details has been successfully updated'));
}

public function deletePostTabSection(Request $request)
{
        //dd($request->all());
        //$content = PostTab::where('id',$request->id)->first();

   PostTab::where('id',$request->id)->delete();

   return 'true';

}

}
