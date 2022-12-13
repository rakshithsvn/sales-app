<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\Testimonial,
    Repositories\TestimonialRepository
};
use DB;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{

    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(TestimonialRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'testimonials';
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
        $testimonials = Testimonial::select('title','image','active','created_at','id')->orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $testimonials =  Testimonial::where('title', 'like', "%".$search."%")->paginate(10);
        }
        $links = $testimonials->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.testimonials.table", ['testimonials' => $testimonials])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.testimonials.index', compact ('testimonials'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_list = array( 'our_dealers'=>'Our Dealers', 'our_clients' =>'Our Clients');

        return view('back.testimonials.create', compact('type_list'));
    }

    
    public function store(Request $request)
    {
       
       $result = $this->repository->store($request);
       
       if($result == 'success')
       {
            return redirect(route('testimonials.index'))->with('category-ok', __('Testimonial added successfully'));
       }
       else
       {

            return redirect(route('testimonials.index'))->with('category-danger', __('The Testimonial already exist'));
       }

    
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
      
        $testimonials = $testimonial;

        $type_list = array( 'our_dealers'=>'Our Dealers', 'our_clients' =>'Our Clients');
        
        return view('back.testimonials.edit', compact ('testimonials','type_list'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Testimonial $testimonial)
    {
   
        $result = $this->repository->update($testimonial, $request);

        if($result == 'success')
       {
             return redirect(route('testimonials.index'))->with('category-ok', __('The testimonial details has been successfully updated'));
       }
       else
       {

         return redirect(route('testimonials.index'))->with('category-danger', __('The testimonial already exist. Cannot update'));
       }
        
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Testimonial $testimonial, $status = false)
    {

        $testimonial->active = $status;
        $testimonial->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        dd($testimonial);
        $testimonial->delete ();
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

}
