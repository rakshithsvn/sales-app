<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\FacultyRequest,
    Models\FacultyDetail,
    Models\FacultyTab,
    Models\FacultySchedule,
    Models\PostTab,
    Repositories\FacultyRepository
};
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FacultyController extends Controller
{

    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(FacultyRepository $repository)
    {
        $faculty_list = FacultyDetail::whereNotNull('from_date')->get();

        $current_date = date('Y-m-d');   

        foreach($faculty_list as $faculty)
        {
            if($faculty->from_date->format('Y-m-d')<=$current_date && $faculty->to_date->format('Y-m-d')>=$current_date){

                $faculty->update(['appointment' => '0']);
            } 
            else
            {
                $faculty->update(['appointment' => '1',]);
            }

            if($faculty->to_date->format('Y-m-d') < $current_date)
            {
                $faculty->update(['from_date' => null, 'to_date' => null]);
            }
        }

        $this->repository = $repository;

        $this->table = 'faculty_details';
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
        $faculties = FacultyDetail::orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $faculties =  FacultyDetail::where('name', 'like', "%".$search."%")->orWhere('last_name', 'like', "%".$search."%")->orWhere('designation','like',"%".$search."%")->paginate(10);
        }
        $links = $faculties->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.faculties.table", ['faculties' => $faculties])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.faculties.index', compact ('faculties'));
    }

    /**
     * Show the form for creating a new faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $faculty_tabs = null;

        $type_list = array('director' => 'Director', 'faculty' => 'Faculty' );

        return view('back.faculties.create',compact('faculty_tabs','type_list'));
    }

    
    public function store(Request $request)
    {
     
     $result = $this->repository->store($request);
     
     if($result == 'success')
     {
        return redirect(route('faculties.index'))->with('category-ok', __('Faculty details added successfully'));
    }
    else
    {

       return redirect(route('faculties.index'))->with('category-danger', __('The faculty already exist'));
   }

   
}

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyDetail $faculty)
    {
      
     $faculties = $faculty;

     if($faculties->tab_section == 'Y')
     {
        $faculty_tabs = FacultyTab::where('faculty_id','=',$faculties->id)->get();
        $tab_id = $faculty_tabs->pluck('id');
    }
    else
    {
        $faculty_tabs = null;
        $tab_id = null;
    }

    $type_list = array('founder' => 'Founder', 'director' => 'Director', 'faculty' => 'Faculty' );

    return view('back.faculties.edit', compact ('faculties','faculty_tabs','tab_id','type_list'));
}

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, FacultyDetail $faculty)
    {
     
        $result = $this->repository->update($faculty, $request);

        if($result == 'success')
        {
            return redirect(route('faculties.index'))->with('category-ok', __('The faculty details has been successfully updated'));
        }
        else
        {
            return redirect(route('faculties.index'))->with('category-danger', __('The faculty already exist. Cannot update'));
        }
        
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
     public function updateActive(FacultyDetail $faculty, $status = false)
     {
        $faculty->active = $status;
        $faculty->save();

        return response ()->json ();
    }

    public function updateAppointment(FacultyDetail $faculty, $status = false)
     {
        $faculty->appointment = $status;
        $faculty->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyDetail $faculty)
    {
        $faculty->delete ();
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

    // Doctor Appointment

     public function appointmentIndex(Request $request)
    {      
        $search = ($request['search'])?$request['search']:null;
        $faculties = FacultyDetail::where('type', 'doctor')->orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $faculties =  FacultyDetail::where('type', 'doctor')->where('name', 'like', "%".$search."%")->orWhere('last_name', 'like', "%".$search."%")->orWhere('designation','like',"%".$search."%")->paginate(10);
        }
        $links = $faculties->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.appointment.table", ['faculties' => $faculties])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.appointment.index', compact ('faculties'));
    }

    public function appointmentStore(Request $request)  
    {
        
        if($request->submit == 'unblock')
        {
            $request->merge(['from_date' => null]);
            $request->merge(['to_date' => null]);
            $request->merge(['appointment' => '1']);
        }      
        else
        {
            $request->merge(['from_date' => $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d') : null]);
            $request->merge(['to_date' => $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date)->format('Y-m-d') : null]);

            $current_date = date('Y-m-d');   
            
            if($request->from_date<=$current_date && $request->to_date>=$current_date){

                $request->merge(['appointment' => '0']);
            } 
            else
            {
                $request->merge(['appointment' => '1']);
            }
        }
         
        $faculty = FacultyDetail::updateOrCreate(
            [
                'id' => $request->faculty_id,
            ],
            [
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'appointment' => $request->appointment, 
                'limit' => $request->limit,                      
                'user_id' => auth()->id()
            ]
        ); 

        return redirect(route('appointment.index'))->with('category-success', __('The data updated'));
    }


    // Doctor Schedules

    public function scheduleCreate()
    {      
        $schedule_data = FacultySchedule::get();

        return view('back.faculties.schedule', compact('schedule_data'));
    }

    public function getSchedule()
    {      
        return FacultySchedule::get();
    }

    public function getDoctor()
    {      
        return FacultyDetail::where('type', 'doctor')->get();
    }

    public function scheduleStore(Request $request){

        foreach($request->schedules as $key => $link){

            FacultySchedule::updateOrCreate(
                [
                    'id' => $link['id']
                ],
                [
                    'faculty_id' => $link['faculty_id'],
                    'day' => $link['day'],
                    'from_time' => $link['from_time'],
                    'to_time' => $link['to_time'],
                    'location' => $link['location'],                       
                    'user_id' => auth()->id()
                ]
            ); 
        }
    }

    public function scheduleRemove(Request $request){
       
        return FacultySchedule::where('id', $request->id)->delete();
    }   

}
