<?php

namespace App\Repositories;

use App\Models\ {
    Post,
    Tag,
    Comment,
    ParentMenu,
    ChooseNo,
    FacultyDetail,
    FacultyTab
};
use App\Services\Thumb;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FacultyRepository
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
    public function __construct(FacultyDetail $faculty, Tag $tag, Comment $comment)
    {
        $this->model = $faculty;
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
    public function getAll($nbrPages, $parameters)
    {
        return $this->model->with ('ingoing')
        ->orderBy ($parameters['order'], $parameters['direction'])
        ->when ($parameters['active'], function ($query) {
            $query->whereActive (true);
        })->when ($parameters['new'], function ($query) {
            $query->has ('ingoing');
        })->paginate ($nbrPages);
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
     * Update post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function update($faculty, $request)
    {

        $request->merge(['from_date' => $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d') : null]);
        $request->merge(['to_date' => $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date)->format('Y-m-d') : null]);

        $current_date = date('Y-m-d');   
        
        if($request->from_date<=$current_date && $request->to_date>=$current_date){

            $request->merge(['appointment' => '0']);
        } 
          
        // dd($request->all());
       $name = $request->name.' '.$request->last_name;
       
       $record_already_exists = FacultyDetail::where('id','!=',$faculty->id)->where('name','=',$request->name)->where('last_name','=',$request->last_name)->whereNull('deleted_at')->first();

           //dd($record_already_exists);

       if(empty($record_already_exists))
       {
           if(isset($request->tab_section))
           {

            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($name)]);
            $request->merge(['tab_section' => $request->has('tab_section')]);
            $faculty->update($request->all());

            foreach ($request->event_date as $key => $value) {

                if (is_array($value)){
                    foreach ($value as $tab_key => $tab_value) {

                        FacultyTab::where('id', $key)->update(['event_date' => $tab_value, 'event_title' => $request->event_title[$key][$tab_key], 'start_time' => $request->start_time[$key][$tab_key], 'end_time' => $request->end_time[$key][$tab_key] ]);
                    }
                }
                else
                {
                    $faculty_tab = new FacultyTab();
                    $faculty_tab->faculty_id = $faculty->id;
                    $faculty_tab->event_date = $request->event_date[$key];
                    $faculty_tab->event_title = $request->event_title[$key];
                    $faculty_tab->start_time = $request->start_time[$key];
                    $faculty_tab->end_time = $request->end_time[$key];
                    $faculty_tab->user_id = auth()->id();
                    $faculty_tab->save();
                }
            }
        }
        else
        {
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($name)]);
            $request->merge(['tab_section' => 'N']);
            $faculty->update($request->all());
        }

        return 'success';
    }
    else
    {
        return 'error';
    }
}

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function store($request)
    {
        //dd($request->all());
        $name = $request->name.' '.$request->last_name;

        $record_exists = FacultyDetail::where('name',$request->name)->where('last_name',$request->last_name)->first();

        if(empty($record_exists))
        {
            if(isset($request->tab_section))
            {

                $request->merge(['user_id' => auth()->id()]);
                $request->merge(['active' => $request->has('active')]);
                $request->merge(['slug' => Str::slug($name)]);
                $request->merge(['tab_section' => $request->has('tab_section')]);
                $faculty = FacultyDetail::create($request->all());

                foreach ($request->event_date as $key => $value) {

                 $faculty_tab = new FacultyTab();
                 $faculty_tab->faculty_id = $faculty->id;
                 $faculty_tab->event_date = $request->event_date[$key];
                 $faculty_tab->event_title = $request->event_title[$key];
                 $faculty_tab->start_time = $request->start_time[$key];
                 $faculty_tab->end_time = $request->end_time[$key];
                 $faculty_tab->user_id = auth()->id();
                 $faculty_tab->save();
             }

         }
         else
         {
            $request->merge(['user_id' => auth()->id()]);
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($name)]);
            $request->merge(['tab_section' => 'N']);
            $faculty = FacultyDetail::create($request->all());
        }

        return 'success';
    }
    else
    {
        return 'error';
    }



        //$this->saveCategoriesAndTags($post, $request);
}

    /**
     * Save categories and tags.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    protected function saveCategoriesAndTags($post, $request)
    {
        $post->categories()->sync($request->categories);

        $tags_id = [];

        if ($request->tags) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                $tag_ref = Tag::firstOrCreate(['tag' => $tag]);
                $tags_id[] = $tag_ref->id;
            }
        }

        $post->tags()->sync($tags_id);
    }

}
