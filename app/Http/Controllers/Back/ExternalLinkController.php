<?php

namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ {
    Http\Requests\ExternalRequest,
    Http\Controllers\Controller,
    Models\Post,
    Models\PostTab,
    Models\PostLinkPage,
    Models\PostLinkPageTab,
    Repositories\ExternalLinkRepository
};
use Carbon\Carbon;

class ExternalLinkController extends Controller
{
    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(ExternalLinkRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'post_link_pages';
    }

    public function index(Request $request)
    {
        $search = ($request['search'])?$request['search']:null;
        $pages = PostLinkPage::select('title','created_at','active','id')->orderBy('id','desc')->paginate(10);
        if(isset($search))
        {
            $pages =  PostLinkPage::where('title', 'like', "%".$search."%")->paginate(10);
        }
        $links = $pages->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.post-link-pages.table", ['pages' => $pages])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.post-link-pages.index',compact('pages'));
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
    public function updateActive(PostLinkPage $post_link_page, $status = false)
    {
        $post_link_page->active = $status;
        $post_link_page->save();

        return response ()->json ();
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $post_tabs = null;

        return view('back.post-link-pages.create', compact('post_tabs'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExternalRequest $request)
    {

        //dd($request->all());
       
       $result = $this->repository->store($request);
       
       if($result == 'success')
       {
             return redirect(route('post-link-pages.index'))->with('category-ok', __('The page has been successfully created'));
       }
       else
       {

         return redirect(route('post-link-pages.index'))->with('category-danger', __('The page already exist'));
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
    public function edit(PostLinkPage $post_link_page)
    {
     
        $post = $post_link_page;
        

       if($post->tab_section == 'Y')
       {
            $post_tabs = PostLinkPageTab::where('post_link_page_id','=',$post->id)->get();
            $tab_id = $post_tabs->pluck('id');
       }
       else
       {
            $post_tabs = null;
            $tab_id = null;
       }

      
        return view('back.post-link-pages.edit', compact('post','post_tabs','tab_id'));
    }

    /**
     * Update the post in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(ExternalRequest $request, PostLinkPage $post_link_page)
    {

        $result = $this->repository->update($post_link_page, $request);

        if($result == 'success')
       {
            return redirect(route('post-link-pages.index'))->with('category-ok', __('The page has been successfully updated'));
       }
       else
       {

         return redirect(route('post-link-pages.index'))->with('category-danger', __('The page already exist. Cannot update'));
       }
        
    }

    /**
     * Remove the post from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostLinkPage $post_link_page)
    {
        $post_link_page->delete ();

        PostLinkPageTab::where('post_link_page_id', $post_link_page->id)->delete();

        return response ()->json ();
    }


   
    public function deletePostTabSection(Request $request)
    {
        //dd($request->all());
        //$content = PostTab::where('id',$request->id)->first();

      PostLinkPageTab::where('id',$request->id)->delete();

       return 'true';
       
    }

     public function copyLink()
    {
        
        $links = PostLinkPage::select('title','slug')->orderBy('id','desc')->paginate(10);
        return view('back.post-link-pages.link',compact('links'));

    }
}
