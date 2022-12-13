<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\FacultyDetail,
    Models\FacultyTab,
    Models\LinkFaculty,
    Models\Event,
    Models\ParentMenu,
    Repositories\LinkFacultyRepository
};
use DB;
use Illuminate\Support\Str;

class LinkFacultyController extends Controller
{

    use Indexable;

    /**
     * Create a new EventController instance.
     *
     * @param  \App\Repositories\EventRepository $repository
     */
    public function __construct(LinkFacultyRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'link_faculties';
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
        $link_faculties = LinkFaculty::orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $link_faculties = LinkFaculty::join('faculty_details', function($faculty_details){
                $faculty_details->on('faculty_details.id','=','link_faculties.faculty_id');
            })->select('link_faculties.*','faculty_details.id as faculty_id')->where('faculty_details.name', 'like', "%".$search."%")->paginate(10);

            // $link_faculties =   LinkFaculty::join('Events', function($Events){
            //     $Events->on('Events.id','=','link_faculties.Event_id');
            // })->select('link_faculties.*','Events.id as Event_id')->where('title', 'like', "%".$search."%")->paginate(10);
        }
        $links = $link_faculties->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.link-faculties.table", ['link_faculties' => $link_faculties])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.link-faculties.index', compact ('link_faculties'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array_select = array('' => '--Select--');

        $dept_menu_id = ParentMenu::select('id')->where('slug','=','services')->first();

        $event_list = Event::orderBy('name')->pluck('name','id');

        foreach ($event_list as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $event_list = $array_select;


        $actual_event = null;
        $actual_faculty_name = null;
        $actual_post_tab = null;

        $faculty_select = array('' => '--Select--');

        $faculty_names = FacultyDetail::all()->pluck('full_name','id');

        foreach($faculty_names as $key => $value)
        {
        	$faculty_select[$key] =$value;
        }

        $faculty_names = $faculty_select;
       // $faculty_tabs = null;

        //dd($event_list);

        return view('back.link-faculties.create',compact('event_list','actual_event','faculty_names','actual_faculty_name','actual_post_tab'));
    }

    
    public function store(Request $request)
    {

        //dd($request->all());

     $result = $this->repository->store($request);

     if($result == 'success')
     {
        return redirect(route('link-faculties.index'))->with('category-ok', __('Faculty details linked to page successfully'));
    }
    else
    {
       return redirect(route('link-faculties.index'))->with('category-danger', __('The link is already exist'));
   }


}

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(LinkFaculty $link_faculty)
    {
      // dd($link_faculty);

        $link_faculties = $link_faculty;

        $dept_menu_id = ParentMenu::select('id')->where('slug','=','services')->first();

        $event_list = Event::orderBy('name')->pluck('name','id');

        foreach ($event_list as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $event_list = $array_select;

        // $faculty_select = array('' => '--Select--');

        $faculty_names = FacultyDetail::all()->pluck('full_name','id');
        
        foreach($faculty_names as $key => $value)
        {
        	$faculty_select[$key] = $value;
        }

        $faculty_names = $faculty_select; 

        $actual_event = $link_faculty->event_id;
        $actual_post_tab = $link_faculty->post_tab_id;
        $actual_faculty_name =$link_faculty->faculty_id;

        return view('back.link-faculties.edit', compact ('actual_event','link_faculties','actual_post_tab','actual_faculty_name','event_list','faculty_names'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, LinkFaculty $link_faculty)
    {

        $result = $this->repository->update($link_faculty, $request);

        if($result == 'success')
        {
           return redirect(route('link-faculties.index'))->with('category-ok', __('The faculty details has been successfully updated'));
       }
       else
       {

           return redirect(route('link-faculties.index'))->with('category-danger', __('The faculty already exist. Cannot update'));
       }

   }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
     public function updateActive(LinkFaculty $link_faculty, $status = false)
     {
        $link_faculty->active = $status;
        $link_faculty->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(LinkFaculty $link_faculty)
    {
        $link_faculty->delete ();
        return response ()->json ();
    }


}
