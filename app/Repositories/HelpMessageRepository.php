<?php

namespace App\Repositories;

use App\Models\{
    HelpMessage,
    Tag,
    Comment,
    ParentMenu,
    ChooseNo,
    PostTab,
    SubMenu,
    Address
};
use App\Services\Thumb;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class HelpMessageRepository
{
    /**
     * The Tag instance.
     *
     * @var \App\Models\Tag
     */
    protected $tag;

    /**
     * The Comment instance.
     *
     * @var \App\Models\Comment
     */
    protected $comment;

    /**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;


    /**
     * Create a new BlogRepository instance.
     *
     * @param  \App\Models\Post $post
     * @param  \App\Models\Tag $tag
     * @param  \App\Models\Comment $comment
     */
    public function __construct(HelpMessage $post, Tag $tag, Comment $comment)
    {
        $this->model = $post;
        $this->tag = $tag;
        $this->comment = $comment;
    }

    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActiveOrderByDate()
    {
        return $this->model
            ->select('id', 'title', 'slug', 'excerpt', 'image')
            ->whereActive(true)
            ->latest();
    }

    /**
     * Get active posts collection paginated.
     *
     * @param  int  $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDate($nbrPages)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }

    /**
     * Get all posts collection paginated.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters, $search = null)
    {
        $result = $this->model->with('ingoing');
        // ->orderBy ($parameters['order'], $parameters['direction'])
        // ->when ($parameters['active'], function ($query) {
        //     $query->whereActive (true);
        // })->when ($parameters['new'], function ($query) {
        //     $query->has ('ingoing');
        // });

        if (isset($search)) {
            $result =  $result->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%" . $search . "%")
                    ->orWhere('excerpt', 'like', "%" . $search . "%");
            });
        }
        return $result->paginate($nbrPages);
    }

    /**
     * Get active posts for specified tag.
     *
     * @param  int  $nbrPages
     * @param  int  $tag_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForTag($nbrPages, $tag_id)
    {

        return $this->queryActiveOrderByDate()
            ->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('tags.id', $tag_id);
            })->paginate($nbrPages);
    }

    /**
     * Get active posts for specified tag.
     *
     * @param  int  $nbrPages
     * @param  string  $category_slug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForCategory($nbrPages, $category_slug)
    {
        return $this->queryActiveOrderByDate()
            ->whereHas('categories', function ($q) use ($category_slug) {
                $q->where('categories.slug', $category_slug);
            })->paginate($nbrPages);
    }

    /**
     * Get post by slug.
     *
     * @param  string  $slug
     * @return array
     */
    public function getPostBySlug($slug)
    {
        // Post for slug with user, tags and categories
        $post = $this->model->with([
            'user' => function ($q) {
                $q->select('id', 'name', 'email');
            },
            'tags' => function ($q) {
                $q->select('tags.id', 'tag');
            },
            'categories' => function ($q) {
                $q->select('title', 'slug');
            }
        ])
            ->with(['parentComments' => function ($q) {
                $q->with('user')
                    ->latest()
                    ->take(config('app.numberParentComments'));
            }])
            ->withCount('validComments')
            ->withCount('parentComments')
            ->whereSlug($slug)
            ->firstOrFail();

        // Previous post
        $post->previous = $this->getPreviousPost($post->id);

        // Next post
        $post->next = $this->getNextPost($post->id);

        return compact('post');
    }

    /**
     * Get previous post
     *
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPreviousPost($id)
    {
        return $this->model->select('title', 'slug')->where('id', '<', $id)->latest('id')->first();
    }

    /**
     * Get next post
     *
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getNextPost($id)
    {
        return $this->model->select('title', 'slug')->where('id', '>', $id)->oldest('id')->first();
    }

    /**
     * Get posts with search.
     *
     * @param  int  $n
     * @param  string  $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($n, $search)
    {

        return $this->queryActiveOrderByDate()
            ->where(function ($q) use ($search) {
                $q->where('excerpt', 'like', "%$search%")
                    ->orWhere('body', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            })->paginate($n);
    }

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function store($request)
    {

        // dd($request->all());
        // $sub_news_id = SubMenu::where('parent_menu_id','=',$parent_news_id->id)->where('constant','=','news')->whereNull('deleted_at')->first();

        if (!empty($request->help_message_date)) {
            $help_message_Date = Carbon::createFromFormat('d/m/Y', $request->help_message_date)->format('Y-m-d');
        } else {
            $help_message_Date = null;
        }

        $news_id = SubMenu::select('id')->where('slug', '=', 'blogs')->first();
        $case_study_id = SubMenu::select('id')->where('slug', '=', 'case-studies')->first();

        // $help_message_id = ParentMenu::select('id')->where('slug','=','services')->first();

        $menu_id = (int)$request->parent_menu_id;
        $sub_menu_id = (int)$request->sub_menu_id;

        if (($news_id->id != $sub_menu_id) && ($case_study_id->id != $sub_menu_id)) {

            $record_exists = Post::where('parent_menu_id', $request->parent_menu_id)->where('sub_menu_id', $request->sub_menu_id)->where('child_menu_id', $request->child_menu_id)->whereNull('deleted_at')->first();

            if ($record_exists == null) {
                if (isset($request->tab_section)) {

                    $request->merge(['user_id' => auth()->id()]);
                    $request->merge(['active' => $request->has('active')]);
                    $request->merge(['slug' => Str::slug($request->title)]);
                    $request->merge(['help_message_date' => $help_message_Date]);
                    $request->merge(['body' => $request->body]);
                    $request->merge(['tab_section' => $request->has('tab_section')]);

                    $post = Post::create($request->all());

                    foreach ($request->tab_title as $key => $value) {

                        $post_tab = new PostTab();
                        $post_tab->post_id = $post->id;
                        $post_tab->tab_title = $request->tab_title[$key];
                        $post_tab->tab_image = $request->tab_image[$key];
                        $post_tab->tab_body = $request->tab_body[$key];
                        $post_tab->user_id = auth()->id();
                        $post_tab->save();
                    }
                } else {
                    $request->merge(['user_id' => auth()->id()]);
                    $request->merge(['active' => $request->has('active')]);
                    $request->merge(['slug' => Str::slug($request->title)]);
                    $request->merge(['help_message_date' => $help_message_Date]);
                    $request->merge(['tab_section' => 'N']);
                    // dd($request->all());
                    $post = Post::create($request->all());
                }

                return 'success';
            } else {
                return 'error';
            }
        } else {
            if (isset($request->tab_section)) {

                $request->merge(['user_id' => auth()->id()]);
                $request->merge(['active' => $request->has('active')]);
                $request->merge(['slug' => Str::slug($request->title)]);
                if ($news_id) {
                    $request->merge(['help_message_date' => $help_message_Date]);
                }

                $request->merge(['body' => $request->body]);
                $request->merge(['tab_section' => $request->has('tab_section')]);
                $post = Post::create($request->all());


                foreach ($request->tab_title as $key => $value) {

                    $post_tab = new PostTab();
                    $post_tab->post_id = $post->id;
                    $post_tab->tab_title = $request->tab_title[$key];
                    $post_tab->tab_image = $request->tab_image[$key];
                    $post_tab->tab_body = $request->tab_body[$key];
                    $post_tab->user_id = auth()->id();
                    $post_tab->save();
                }
            } else {
                $request->merge(['user_id' => auth()->id()]);
                $request->merge(['active' => $request->has('active')]);
                $request->merge(['slug' => Str::slug($request->title)]);
                if ($news_id) {
                    $request->merge(['help_message_date' => $help_message_Date]);
                }

                $request->merge(['tab_section' => 'N']);

                $post = Post::create($request->all());
            }

            return 'success';
        }

        $this->saveCategoriesAndTags($post, $request);
    }


    /**
     * Update post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function update($post, $request)
    {
        // dd($request->all());

        if (!empty($request->help_message_date)) {

            $help_message_Date = Carbon::createFromFormat('d/m/Y', $request->help_message_date)->format('Y-m-d');
        } else {
            $help_message_Date = null;
        }

        //$parent_news_id = ParentMenu::where('slug','=','atc-catalog')->first();

        //$sub_news_id = SubMenu::where('parent_menu_id','=',$parent_news_id->id)->where('constant','=','news')->whereNull('deleted_at')->first();

        $news_id = SubMenu::select('id')->where('slug', '=', 'blogs')->first();
        $case_study_id = SubMenu::select('id')->where('slug', '=', 'case-studies')->first();

        // $help_message_id = ParentMenu::select('id')->where('slug','=','services')->first();

        $menu_id = (int)$request->parent_menu_id;
        $sub_menu_id = (int)$request->sub_menu_id;

        if (($news_id->id != $sub_menu_id) && ($case_study_id->id != $sub_menu_id)) {

            $record_already_exists = Post::where('id', '!=', $post->id)->where('parent_menu_id', $request->parent_menu_id)->where('sub_menu_id', $request->sub_menu_id)->where('child_menu_id', $request->child_menu_id)->whereNull('deleted_at')->first();

            // dd($record_already_exists);

            if (!$record_already_exists) {
                if (isset($request->tab_section)) {

                    $request->merge(['active' => $request->has('active')]);
                    $request->merge(['slug' => Str::slug($request->title)]);
                    $request->merge(['help_message_date' => $help_message_Date]);
                    $request->merge(['body' => $request->body]);
                    $request->merge(['tab_section' => $request->has('tab_section')]);


                    $post->update($request->all());

                    foreach ($request->tab_title as $key => $value) {

                        if (is_array($value)) {
                            foreach ($value as $tab_key => $tab_value) {

                                PostTab::where('id', $key)->update(['tab_title' => $tab_value, 'tab_image' => $request->tab_image[$key][$tab_key], 'tab_body' => $request->tab_body[$key][$tab_key]]);
                            }
                        } else {
                            $post_tab = new PostTab();
                            $post_tab->post_id = $post->id;
                            $post_tab->tab_title = $request->tab_title[$key];
                            $post_tab->tab_image = $request->tab_image[$key];
                            $post_tab->tab_body = $request->tab_body[$key];
                            $post_tab->user_id = auth()->id();
                            $post_tab->save();
                        }
                    }
                } else {
                    $request->merge(['active' => $request->has('active')]);
                    $request->merge(['slug' => Str::slug($request->title)]);
                    $request->merge(['help_message_date' => $help_message_Date]);
                    $request->merge(['tab_section' => 'N']);

                    $post->update($request->all());
                }

                return 'success';
            } else {
                return 'error';
            }
        } else {
            if (isset($request->tab_section)) {

                $request->merge(['active' => $request->has('active')]);
                $request->merge(['slug' => Str::slug($request->title)]);
                if ($news_id) {
                    $request->merge(['help_message_date' => $help_message_Date]);
                }

                $request->merge(['body' => $request->body]);
                $request->merge(['tab_section' => $request->has('tab_section')]);

                $post->update($request->all());

                // dd($request->tab_title);
                foreach ($request->tab_title as $key => $value) {

                    if (is_array($value)) {
                        foreach ($value as $tab_key => $tab_value) {

                            PostTab::where('id', $key)->update(['tab_title' => $tab_value, 'tab_image' => $request->tab_image[$key][$tab_key], 'tab_body' => $request->tab_body[$key][$tab_key]]);
                        }
                    } else {
                        $post_tab = new PostTab();
                        $post_tab->post_id = $post->id;
                        $post_tab->tab_title = $request->tab_title[$key];
                        $post_tab->tab_image = $request->tab_image[$key];
                        $post_tab->tab_body = $request->tab_body[$key];
                        $post_tab->user_id = auth()->id();
                        $post_tab->save();
                    }
                }
            } else {
                $request->merge(['active' => $request->has('active')]);
                $request->merge(['slug' => Str::slug($request->title)]);
                if ($news_id) {
                    $request->merge(['help_message_date' => $help_message_Date]);
                }

                $request->merge(['tab_section' => 'N']);

                $post->update($request->all());
            }

            return 'success';
        }

        //$this->saveCategoriesAndTags($post, $request);
    }
}
