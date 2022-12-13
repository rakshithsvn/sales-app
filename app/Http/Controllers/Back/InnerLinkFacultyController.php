<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\FacultyDetail,
    Models\FacultyTab,
    Models\LinkFaculty,
    Models\Post,
    Models\PostLinkPage,
    Models\PostLinkPageTab,
    Models\InnerLinkFaculty,
    Repositories\InnerLinkFacultyRepository
};
use DB;
use Illuminate\Support\Str;

class InnerLinkFacultyController extends Controller
{

    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(InnerLinkFacultyRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'inner_link_faculties';
    }
    /**
     * Display a listing of the sliders.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $link_faculties = InnerLinkFaculty::orderBy('id','desc')->paginate(10);

        return view('back.post-link-faculties.index', compact ('link_faculties'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $array_select = array('' => '--Select--');

        $post_pages = PostLinkPage::all()->pluck('title','id');

        foreach ($post_pages as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $post_pages = $array_select;
      

        $actual_post_page = null;
        $actual_faculty_name = null;
        $actual_post_tab = null;

        $faculty_select = array('' => '--Select--');

        $faculty_names = FacultyDetail::all()->pluck('faculty_name','id');

        foreach($faculty_names as $key => $value)
        {
        	$faculty_select[$key] =$value;
        }

        $faculty_names = $faculty_select;
       // $faculty_tabs = null;

        //dd($post_pages);

        return view('back.post-link-faculties.create',compact('post_pages','actual_post_page','faculty_names','actual_faculty_name','actual_post_tab'));
    }

    
    public function store(Request $request)
    {

        //dd($request->all());
       
       $result = $this->repository->store($request);
       
       if($result == 'success')
       {
            return redirect(route('post-link-faculties.index'))->with('category-ok', __('Faculty details linked to page successfully'));
       }
       else
       {
         return redirect(route('post-link-faculties.index'))->with('category-danger', __('The link is already exist'));
       }

    
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(InnerLinkFaculty $post_link_faculty)
    {
       //dd($post_link_faculty);

       	$link_faculties = $post_link_faculty;
       	$post_pages = PostLinkPage::all()->pluck('title','id');

        foreach ($post_pages as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $post_pages = $array_select;
        $faculty_select = array('' => '--Select--');

        $faculty_names = FacultyDetail::all()->pluck('faculty_name','id');

        foreach($faculty_names as $key => $value)
        {
        	$faculty_select[$key] =$value;
        }

        $faculty_names = $faculty_select;
      


       	$actual_post_page = $post_link_faculty->post_link_page_id;
        $actual_post_tab = $post_link_faculty->post_link_page_tab_id;
        $actual_faculty_name =$post_link_faculty->faculty_id;

        //dd($actual_post_tab);
       

        return view('back.post-link-faculties.edit', compact ('actual_post_page','link_faculties','actual_post_tab','actual_faculty_name','post_pages','faculty_names'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, InnerLinkFaculty $post_link_faculty)
    {
    
        //dd($post_link_faculty);
        $result = $this->repository->update($post_link_faculty, $request);

        if($result == 'success')
       {
             return redirect(route('post-link-faculties.index'))->with('category-ok', __('The faculty details has been successfully updated'));
       }
       else
       {

         return redirect(route('post-link-faculties.index'))->with('category-danger', __('The faculty already exist. Cannot update'));
       }
        
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(InnerLinkFaculty $post_link_faculty, $status = false)
    {
        $post_link_faculty->active = $status;
        $post_link_faculty->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(InnerLinkFaculty $post_link_faculty)
    {
        $post_link_faculty->delete ();
        return response ()->json ();
    }


    public function getInnerPageList(Request $request)
    {
        $subContentList = PostLinkPageTab::where('post_link_page_id',$request->id)->whereNull('deleted_at')->pluck('post_link_page_tabs.tab_title', 'post_link_page_tabs.id');

        return response ()->json($subContentList);
    }


   
}
