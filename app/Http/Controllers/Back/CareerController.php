<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\Career,
    Models\ParentMenu,
    Models\Post,
    Repositories\CareerRepository
};
use DB;
use Illuminate\Support\Str;

class CareerController extends Controller
{

    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(CareerRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'careers';
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
        $careers = Career::select('title','active','created_at','excerpt','id')->orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $careers =  Career::where('faculty_name', 'like', "%".$search."%")->orWhere('designation','like',"%".$search."%")->paginate(10);
        }
        $links = $careers->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.faculties.table", ['careers' => $careers])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.careers.index', compact ('careers'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('back.careers.create');
    }

    
    public function store(Request $request)
    {
       
       $result = $this->repository->store($request);
       
       if($result == 'success')
       {
            return redirect(route('careers.index'))->with('category-ok', __('Career details added successfully'));
       }
       else
       {

         return redirect(route('careers.index'))->with('category-danger', __('The Career already exist'));
       }

    
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
      
       $careers = $career;
        
        return view('back.careers.edit', compact ('careers'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Career $career)
    {
   
        $result = $this->repository->update($career, $request);

        if($result == 'success')
       {
             return redirect(route('careers.index'))->with('category-ok', __('The career details has been successfully updated'));
       }
       else
       {

         return redirect(route('careers.index'))->with('category-danger', __('The career already exist. Cannot update'));
       }
        
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Career $career, $status = false)
    {

        $career->active = $status;
        $career->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        $career->delete ();
        return response ()->json ();
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

    // Career Statistics

    public function careerCreate()
    {      
        $place_data = Career::get();

        return view('back.placement.create', compact('place_data'));
    }

    public function getCareer()
    {      
        return Career::get();
    }

    public function getDept()
    {      
        $dept_menu_id = ParentMenu::select('slug','id')->where('slug', 'departments')->first();

        return Post::where('parent_menu_id', $dept_menu_id->id)->orderBy('sub_menu_id')->get();
    }

    public function careerStore(Request $request){
     
        foreach($request->dealers as $key => $link){

                Career::updateOrCreate(
                    [
                        'id' => $link['id']
                    ],
                    [
                        'title' => $link['title'],
                        'slug' => Str::slug($link['title']),
                        'excerpt' => $link['excerpt'],
                        'qual' => $link['qual'],
                        'post' => $link['post'],
                        'expr' => $link['expr'],
                        'dept' => $link['dept'],
                        'active' => $request->has('active'),
                        'user_id' => auth()->id()
                    ]
                ); 
            }
        }

    public function careerRemove(Request $request){

        return Career::where('id', $request->id)->delete();
    }   

}
