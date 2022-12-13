<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
  Http\Controllers\Controller,
  Models\DownloadProspect,
  Models\GraduationRegister,
  Models\ApplicationRegister,
  Http\Requests\DownloadRequest,
  Models\Post,
  Models\ParentMenu,
  Models\SubMenu,
  Models\ChildMenu,
  Models\UploadedResume,
  Models\Career,
  Models\FacultyDetail
};
use DataTables;
use DB;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DownloadController extends Controller
{
    /**
     * Display a listing of the sliders.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    private $i = 1;
    
    public function index(Request $request)
    {
      $search = ($request['search'])?$request['search']:null;
      $prospects = DownloadProspect::orderBy('id','desc')->paginate(10);

      if(isset($search))
      {
        $prospects =  DownloadProspect::where('title', 'like', "%".$search."%")->paginate(10);
      }
      $links = $prospects->appends ($request->all())->links ('back.pagination');
        // Ajax response
      if ($request->ajax ()) {

        return response ()->json ([
          'table' => view ("back.downloads.table", ['prospects' => $prospects])->render (),
          'pagination' => $links->toHtml (),
        ]);
      }
        // dd($prospects);
      return view('back.downloads.index', compact ('prospects'));
    }

    /**
     * Show the form for creating a new sliderr.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
      $file_type = array('' => '--Select--','Brochure' => 'Brochure');

      $facility_menu_id = ParentMenu::select('id')->where('slug','services')->first();
      $mha_menu_id = ParentMenu::select('id')->where('slug','hospital-administration-program')->first();
      $nri_menu_id = ParentMenu::select('id')->where('slug','nri-patients')->first();

      $product_list = Post::where('parent_menu_id','=',@$facility_menu_id->id)->orWhere('parent_menu_id','=',@$nri_menu_id->id)->orWhere('parent_menu_id','=',@$mha_menu_id->id)->orderBy('sub_menu_id', 'asc')->whereNull('deleted_at')->pluck('title','id')->prepend('--Select--','');

      return view('back.downloads.create', compact('file_type','product_list'));
    }

    /**
     * Store a newly created slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DownloadRequest $request)
    {
    // dd($request->all());

        /*$file_path = 'storage/prospects/';

        $thumb_image = $request->prospect;
        $filename=null;
        $filename = $thumb_image->getClientOriginalName();
        $info = pathinfo($filename);
        $file_name =  basename($filename,'.'.$info['extension']);
        $filename = $file_name. '.' . $thumb_image->guessClientExtension();
        $destinationPath = $file_path;
        $thumb_image->move($destinationPath, $filename);
        $request->merge(['prospect_path' => $filename]);*/

        $record_exists = DownloadProspect::where('post_id','=',$request->post_id)->first();

        if($record_exists == null)
        {

          $request->merge(['slug' => Str::slug($request->title)]);
          $request->merge(['active' => $request->has('active')]);
          $request->merge(['user_id' => auth()->id()]);
          DownloadProspect::create($request->all());

          return redirect(route('prospects.index'))->with('post-ok', __('The prospect has been uploaded successfully'));
        }
        else
        {        
          return redirect(route('prospects.index'))->with('post-danger', __('The prospect already exist'));
        }


      }

      public function edit(DownloadProspect $prospect)
      {      
       $prospects = $prospect;

       $file_type = array('' => '--Select--','Brochure' => 'Brochure');

       $facility_menu_id = ParentMenu::select('id')->where('slug','services')->first();

       $product_list = Post::where('parent_menu_id','=',@$facility_menu_id->id)->orWhere('parent_menu_id','=',@$nri_menu_id->id)->orWhere('parent_menu_id','=',@$mha_menu_id->id)->orderBy('parent_menu_id', 'asc')->whereNull('deleted_at')->pluck('title','id')->prepend('--Select--','');

       $actual_file_type = $prospects->title;

       return view('back.downloads.edit', compact ('prospects','file_type','product_list','actual_file_type'));
     }

     /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

     public function update(DownloadRequest $request, DownloadProspect $prospect)
     {
      $prospect = DownloadProspect::Find($prospect->id);
      $prospect->title =  $request->title;
      $prospect->slug =  Str::slug($request->title);
      $prospect->active =  $request->has('active');
      $prospect->post_id =  $request->post_id;
      $prospect->prospect_path = $request->prospect_path;
      $prospect->file_title = $request->file_title;

      $prospect->update();

      return redirect(route('prospects.index'))->with('post-ok', __('The prospect details has been successfully updated'));


    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
     public function updateActive(DownloadProspect $prospect, $status = false)
     {
      $prospect->active = $status;
      $prospect->save();

      return response ()->json ();
    }

    /**
     * Remove the specified file from storage.
     *
     * @param  \App\Models\DownloadProspect  $downloadprospect
     * @return \Illuminate\Http\Response
     */
    public function destroy(DownloadProspect $prospect)
    {
      $prospect->delete ();
      return response ()->json ();
    }

    // Alumni Register

    public function viewGraduationRegister(Request $request)
    {
     $search = ($request['search'])?$request['search']:null;

     $registered_forms = GraduationRegister::orderBy('id','desc')->paginate(10);

     if(isset($search))
     {
      $registered_forms =  GraduationRegister::where('name', 'like', "%".$search."%")->paginate(10);
    }
    $links = $registered_forms->appends ($request->all())->links ('back.pagination');

    if ($request->ajax ()) {

      return response ()->json ([
        'table' => view ("back.downloads.graduation-table", ['registered_forms' => $registered_forms])->render (),
        'pagination' => $links->toHtml (),
      ]);
    }

    return view('back.downloads.graduation-index', compact ('registered_forms'));
  }

  public function viewFullRegister($id)
  {
   $graduation_details = GraduationRegister::where('id',$id)->first();

   return view('back.downloads.graduation-detailView', compact ('graduation_details'));

 }

 public function getExportGraduationReport(Request $request)
 {
       //dd($request->all());

  if(!empty($request->from_date) && !empty($request->to_date))
  {
    $from_date = $request->from_date . ' ' . '01:00:00';
    $to_date = $request->to_date . ' ' . '23:59:59';

    $from_dates = Carbon::createFromFormat('d/m/Y H:i:s', $from_date)->format('Y-m-d H:i:s');
    $to_dates = Carbon::createFromFormat('d/m/Y H:i:s', $to_date)->format('Y-m-d H:i:s');

    $student_details = GraduationRegister::where('created_at','>=',$from_dates)->where('created_at','<=',$to_dates)->whereNull('deleted_at')->orderBy('id','desc')->get();

  }

  else if(!empty($request->from_date)){

    $from_date = $request->from_date . ' ' . '01:00:00';

    $from_dates = Carbon::createFromFormat('d/m/Y H:i:s', $from_date)->format('Y-m-d H:i:s');

    $student_details = GraduationRegister::where('created_at','>=',$from_dates)->whereNull('deleted_at')->orderBy('id','desc')->get();

  }

  else if(!empty($request->to_date)){

    $to_date = $request->to_date . ' ' . '23:59:59';

    $to_dates = Carbon::createFromFormat('d/m/Y H:i:s', $to_date)->format('Y-m-d H:i:s');

    $student_details = GraduationRegister::where('created_at','<=',$to_dates)->whereNull('deleted_at')->orderBy('id','desc')->get();

  }

  else
  {
    $student_details = GraduationRegister::orderBy('id','desc')->get();
  }

  $dataHeader = array('Name','Contact No','Email');

  set_time_limit(0);

  $data = array();

  $student_report_details = array();
  $i = 0;

  foreach ($student_details as $student_report_key => $student_report_value) {

    $student_report_details[$i][] = $student_report_value->name;
    $student_report_details[$i][] = $student_report_value->mobile;
    $student_report_details[$i][] = $student_report_value->email;
    $i++;
  }


  return Excel::create('Alumni Register', function ($excel) use ($data, $student_report_details, $dataHeader) {

    $excel->sheet('Sheetname', function ($sheet) use ($data, $student_report_details, $dataHeader) {

      $sheet->setColumnFormat(array(
        'S' => '0',
        'T' => '0',
      ));

      $sheet->row(1, $dataHeader);

                    // Append multiple rows
      $sheet->rows($student_report_details);

    });

  })->export('xls');

  return view('back.downloads.graduation-index');
}

public function deleteGraduationForm(GraduationRegister $destroy_id)
{
 $destroy_id->delete ();
 return response ()->json ();
}


// Online Application

public function getPosts(Request $request)
{
  if($request->clear)
  {
    $request->merge(['from_date' => '','to_date' => '','post_id' => '','faculty_id' => '','type' => '','status' => '']);
  }
  $registered_forms = GraduationRegister::query();

  if(!empty($_GET["from_date"]) && !empty($_GET["to_date"]))
  {
    $from_date = $_GET["from_date"] . ' ' . '00:00:00';
    $to_date = $_GET["to_date"] . ' ' . '23:59:59';

    $from_dates = Carbon::createFromFormat('d/m/Y H:i:s', $from_date)->format('Y-m-d H:i:s');
    $to_dates = Carbon::createFromFormat('d/m/Y H:i:s', $to_date)->format('Y-m-d H:i:s');

    $registered_forms = $registered_forms->where('date','>=',$from_dates)->where('date','<=',$to_dates)->whereNull('deleted_at');
  }
  else if(!empty($_GET["from_date"])){

    $from_date = $_GET["from_date"] . ' ' . '00:00:00';

    $from_dates = Carbon::createFromFormat('d/m/Y H:i:s', $from_date)->format('Y-m-d H:i:s');

    $registered_forms = $registered_forms->where('date','>=',$from_dates)->whereNull('deleted_at');
  }
  else if(!empty($_GET["to_date"])){

    $to_date = $_GET["to_date"] . ' ' . '23:59:59';

    $to_dates = Carbon::createFromFormat('d/m/Y H:i:s', $to_date)->format('Y-m-d H:i:s');

    $registered_forms = $registered_forms->where('date','<=',$to_dates)->whereNull('deleted_at');
  }
  else
  {
    $registered_forms = $registered_forms->whereNull('deleted_at');
  }

  if($_GET["post_id"] && $_GET["faculty_id"])
  {
    $registered_forms =  $registered_forms->where('post_id', $_GET["post_id"])->where('faculty_id', $_GET["faculty_id"]);
  }
  else if($_GET["post_id"])
  {
    $registered_forms =  $registered_forms->where('post_id', $_GET["post_id"]);
  }
  else if($_GET["faculty_id"])
  {
    $registered_forms =  $registered_forms->where('faculty_id', $_GET["faculty_id"]);
  }
  else
  {
    $registered_forms =  $registered_forms->whereNull('deleted_at');
  }

  if($_GET["type"])
  {
    if($_GET["type"] == '1')
    {
      $registered_forms = $registered_forms->where('patient_id', '<>', NULL);
    }
    else
    {
      $registered_forms = $registered_forms->whereNull('patient_id');
    }
  }
  else
  {
   $registered_forms = $registered_forms->whereNull('deleted_at');
 }

 if($_GET["status"])
 {
  if($_GET["status"] == '1')
  {
    $registered_forms = $registered_forms->where('status', 'Accepted');
  }
  else if($_GET["status"] == '2')
  {
    $registered_forms = $registered_forms->where('status', 'Confirmed');
  }
  else
  {
    $registered_forms = $registered_forms->where('status', 'Reviewed');
  }
}
else
{
 $registered_forms = $registered_forms->whereNull('deleted_at');
}

// return $registered_forms->count();
$users = $registered_forms->select(\DB::raw("CONCAT(first_name, ' ', last_name) as full_name"),'id','first_name','last_name','patient_id','phone','email','date','time','post_id','faculty_id');

//Search
$searchterm = request()->input('search');
$filtered = $users;   

if ($searchterm['value']) {
  $filtered->where(\DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%" . $searchterm['value'] . "%");
  $filtered->orwhere('patient_id', 'like', "%" . $searchterm['value'] . "%");
  $filtered->orwhere('phone', 'like', "%" . $searchterm['value'] . "%");
  $filtered->orwhere('email', 'like', "%" . $searchterm['value'] . "%");
}

return DataTables::of($users)
->addColumn('checkbox', function ($row) {
  return '<input type="checkbox" class="id" name="id[]" value="'.$row->id.'" />';
})
->addColumn('date', function ($row) {
  return $row->date->format('d/m/Y');
})
->addColumn('post', function ($row) {
  return @$row->post->title;
})
->addColumn('faculty', function ($row) {
  return @$row->faculty->name;
})
->addColumn('action', function ($row) {
  return '<a href="prospects/application-view/'. $row->id .'" title="View" class="btn btn-info btn-sm"><span class="fa fa-eye"></span></a> &nbsp; <a href="prospects/application-destroy/'. $row->id .'" title="Destroy" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span></a>';
})       
->rawColumns(['checkbox'=>'checkbox','date'=>'date','post'=>'post','faculty'=>'faculty','action'=>'action'])

->filter(function ($query) { 
      //Search
      // $searchterm = request()->input('search');   

      // if ($searchterm['value']) {
      //     $query->where(\DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%" . $searchterm['value'] . "%");
      //     $query->orwhere('patient_id', 'like', "%" . $searchterm['value'] . "%");
      //     $query->orwhere('phone', 'like', "%" . $searchterm['value'] . "%");
      //     $query->orwhere('email', 'like', "%" . $searchterm['value'] . "%");
      // }

      //Sort order
  $columns=[
    0 => 'id',
    1 => 'full_name',
    2 => 'patient_id',
    3 => 'phone',
    4 => 'email',
    5 => 'date',
    6 => 'time',
    7 => 'post_id',
    8 => 'faculty_id'];

    $limit = request()->input('length');
    $start = request()->input('start');
    $order = $columns[request()->input('order.0.column')];
    $dir = request()->input('order.0.dir');

    $query->offset($start)
    ->limit($limit)
    ->orderBy($order,$dir);
  })
->with([
  "recordsTotal" => $users->count(),
  "recordsFiltered" =>$filtered->count(),
])
->make(true);
}

public function viewApplication(Request $request)
{
   //  GraduationRegister::whereDate('date', '<', Carbon::today())->each(function ($item) {
   //     $item->delete();
   // });

  $search = ($request['search'])?$request['search']:null;

  $registered_forms = GraduationRegister::orderBy('id','desc')->get();

    // if(isset($search))
    // {
    //     $registered_forms =  GraduationRegister::where('first_name', 'like', "%".$search."%")->orWhere('last_name', 'like', "%".$search."%")->orWhere('patient_id', 'like', "%".$search."%")->get();
    // }
    // $links = $registered_forms->appends ($request->all())->links ('back.pagination');

    // if ($request->ajax ()) {

    //     return response ()->json ([
    //         'table' => view ("back.downloads.application-table", ['registered_forms' => $registered_forms])->render (),
    //         'pagination' => $links->toHtml (),
    //     ]);
    // }

  $array_select = array('' => '-- All --');

  $dept_menu_id = ParentMenu::select('id')->where('slug','=','departments')->first();

  $post_pages = Post::where('parent_menu_id',$dept_menu_id->id)->orderBy('sub_menu_id')->orderBy('title')->pluck('title','id');

  foreach ($post_pages as $key => $value) 
  {
    $array_select[$key] = $value;
  }

  $post_pages = $array_select;

  $faculty_select = array('' => '-- All --');

  $faculty_names = FacultyDetail::all()->where('type','doctor')->where('appointment', '1')->pluck('full_name','id');

  foreach($faculty_names as $key => $value)
  {
    $faculty_select[$key] =$value;
  }

  $faculty_names = $faculty_select;

  $report_type = array(''=>'-- All --','1'=>'Registered','2'=>'New Register');

  $status_list = array(''=>'-- All --','1'=>'Accepted','2'=>'Confirmed','3'=>'Reviewed');

  $actual_post_page = null;
  $actual_faculty_name = null;  
  $actual_report_type = null;
  $actual_status = null;


  return view('back.downloads.application-index', compact ('registered_forms','post_pages','faculty_names','actual_post_page','actual_faculty_name','report_type','actual_report_type','status_list','actual_status'));
}

public function getExportApplicationReport(Request $request)
{     
    // dd($request->all());

  if($request->clear)
  {
    $request->merge(['from_date' => '','to_date' => '','post_id' => '','faculty_id' => '','type' => '','status' => '']);
  }

  if(!empty($request->from_date) && !empty($request->to_date))
  {
    $from_date = $request->from_date . ' ' . '00:00:00';
    $to_date = $request->to_date . ' ' . '23:59:59';

    $from_dates = Carbon::createFromFormat('d/m/Y H:i:s', $from_date)->format('Y-m-d H:i:s');
    $to_dates = Carbon::createFromFormat('d/m/Y H:i:s', $to_date)->format('Y-m-d H:i:s');

    $registered_forms = GraduationRegister::where('date','>=',$from_dates)->where('date','<=',$to_dates)->whereNull('deleted_at')->orderBy('id','desc');
  }
  else if(!empty($request->from_date)){

    $from_date = $request->from_date . ' ' . '00:00:00';

    $from_dates = Carbon::createFromFormat('d/m/Y H:i:s', $from_date)->format('Y-m-d H:i:s');

    $registered_forms = GraduationRegister::where('date','>=',$from_dates)->whereNull('deleted_at')->orderBy('id','desc');
  }
  else if(!empty($request->to_date)){

    $to_date = $request->to_date . ' ' . '23:59:59';

    $to_dates = Carbon::createFromFormat('d/m/Y H:i:s', $to_date)->format('Y-m-d H:i:s');

    $registered_forms = GraduationRegister::where('date','<=',$to_dates)->whereNull('deleted_at')->orderBy('id','desc');
  }
  else
  {
    $registered_forms = GraduationRegister::orderBy('id','desc');
  }


  if($request->post_id && $request->faculty_id)
  {
    $registered_forms =  $registered_forms->where('post_id', $request->post_id)->where('faculty_id', $request->faculty_id);
  }
  else if($request->post_id)
  {
    $registered_forms =  $registered_forms->where('post_id', $request->post_id);
  }
  else if($request->faculty_id)
  {
    $registered_forms =  $registered_forms->where('faculty_id', $request->faculty_id);
  }
  else
  {
    $registered_forms =  $registered_forms->orderBy('id','desc');
  }

  if($request->type)
  {
    if($request->type == '1')
    {
      $registered_forms = $registered_forms->where('patient_id', '<>', NULL);
    }
    else
    {
      $registered_forms = $registered_forms->whereNull('patient_id');
    }
  }
  else
  {
   $registered_forms = $registered_forms->orderBy('id','desc');
 }

 if($request->status)
 {
  if($request->status == '1')
  {
    $registered_forms = $registered_forms->where('status', 'Accepted');
  }
  else if($request->status == '2')
  {
    $registered_forms = $registered_forms->where('status', 'Confirmed');
  }
  else
  {
    $registered_forms = $registered_forms->where('status', 'Reviewed');
  }
}
else
{
 $registered_forms = $registered_forms->orderBy('id','desc');
}


if($request->exportData)
{
  $registered_forms = $registered_forms->get();

  $dataHeader = array('Name','MR No','Contact No','Email','Date','Time','Department','Doctor');

  set_time_limit(0);

  $data = array();

  $student_report_details = array();
  $i = 0;

  foreach ($registered_forms as $student_report_key => $student_report_value) {

    $student_report_details[$i][] = $student_report_value->full_name ? $student_report_value->full_name : '';
    $student_report_details[$i][] = $student_report_value->patient_id ? $student_report_value->patient_id : '';
    $student_report_details[$i][] = $student_report_value->phone;
    $student_report_details[$i][] = $student_report_value->email;
    $student_report_details[$i][] = $student_report_value->date->format('d/m/Y');
    $student_report_details[$i][] = $student_report_value['time'];
    $student_report_details[$i][] = @$student_report_value->post->title;
    $student_report_details[$i][] = @$student_report_value->faculty->full_name;
    $i++;
  }

  Excel::create('Doctor_Appointment_Report', function ($excel) use ($data, $student_report_details, $dataHeader) {

    $excel->sheet('Sheetname', function ($sheet) use ($data, $student_report_details, $dataHeader){

      $sheet->setColumnFormat(array(
       'F' => '00.00'
     ));

            // $sheet->setWidth('A', 5);
      $sheet->getDefaultRowDimension()->setRowHeight(20);

      $sheet->getRowDimension(1)->setRowHeight(25);
      $styleArray = array(
        'font'  => array(
          'bold'  => true,
        ));

      $sheet->getStyle('A1:H1')->applyFromArray($styleArray);

      $sheet->row(1, $dataHeader);

                    // Append multiple rows
      $sheet->rows($student_report_details);

    });

  })
    // ->export('xls');
  ->store('xls', storage_path('app/public/reports/'), true);
  $path="/storage/reports/Doctor_Appointment_Report.xls";
  return \Response::json(['status'=>'success','url'=>url('/').$path]); 
}

$registered_forms = $registered_forms->get();

$array_select = array('' => '-- All --');

$dept_menu_id = ParentMenu::select('id')->where('slug','=','departments')->first();

$post_pages = Post::where('parent_menu_id',$dept_menu_id->id)->orderBy('sub_menu_id')->orderBy('title')->pluck('title','id');

foreach ($post_pages as $key => $value) 
{
  $array_select[$key] = $value;
}

$post_pages = $array_select;

$faculty_select = array('' => '-- All --');

$faculty_names = FacultyDetail::all()->where('type','doctor')->where('appointment', '1')->pluck('full_name','id');

foreach($faculty_names as $key => $value)
{
  $faculty_select[$key] =$value;
}

$faculty_names = $faculty_select;

$report_type = array(''=>'-- All --','1'=>'Registered','2'=>'New Register');

$status_list = array(''=>'-- All --','1'=>'Accepted','2'=>'Confirmed','3'=>'Reviewed');

$actual_post_page = $request->post_id;
$actual_faculty_name  = $request->faculty_id;
$actual_report_type = $request->type;
$actual_status = $request->status;

return view('back.downloads.application-index', compact('registered_forms','post_pages','faculty_names','actual_post_page','actual_faculty_name','report_type','actual_report_type','status_list','actual_status'));
}

public function getDoctor(Request $request)
{      
  if($request->id == null)
  {
    $team_detail = FacultyDetail::all()->where('type','doctor')->where('appointment', '1')->pluck('full_name','id');       
  }
  else{
    $team_detail = FacultyDetail::join('link_faculties', function($link_faculties){
      $link_faculties->on('link_faculties.faculty_id','=','faculty_details.id');
    })->join('posts', function($posts){
      $posts->on('posts.id','link_faculties.post_id');
    })->select(\DB::raw("CONCAT(faculty_details.name, ' ', faculty_details.last_name) as name"),"faculty_details.id")->where('faculty_details.appointment', '1')->where('link_faculties.post_id', $request->id)->whereNull('faculty_details.deleted_at')->whereNull('link_faculties.deleted_at')->orderBy('faculty_details.appointment','desc')->orderBY('posts.id')->pluck('name','id');
  }

  return $team_detail;
}

public function viewFullApplication($id)
{
  $application_details = GraduationRegister::where('id',$id)->first();

  $timings = array('9.00 - 10.00'=>'9.00 - 10.00','10.00 - 11.00'=>'10.00 - 11.00','11.00 - 12.00'=>'11.00 - 12.00','12.00 - 13.00'=>'12.00 - 13.00','13.00 - 14.00'=>'13.00 - 14.00','14.00 - 15.00'=>'14.00 - 15.00','15.00 - 16.00'=>'15.00 - 16.00','16.00 - 17.00'=>'16.00 - 17.00' );

  return view('back.downloads.application-detailView', compact ('application_details','timings'));

}

public function updateAppointment(Request $request)
{
  $application_details = GraduationRegister::where('id',$request->id)->first();

  $application_details->time = $request->time;

  $application_details->update();

  $doctor = FacultyDetail::where('id', $application_details->faculty_id)->first();

  $request = 
  [ 
     // 'User' => 'assisi',
     // 'passwd' => 'atcdemo#10/19',
     // 'sid'=>'AJHOSP',
     // 'mobilenumber'=>$application_details->phone,
     // 'message'=>'Hi '.@$application_details->full_name.', 
     // Your Appointment with '.@$application_details->faculty->full_name.' on '. $application_details->date->format('d/m/Y').' at '.$application_details->time.' is confirmed. Please visit Appointment Desk, OPD Block, Ground Floor, AJHRC. Rescheduling or Cancellation please call us at 0824-6613282 or 07846802333. Thank you. Regards AJHRC.', 
     //       // 'sid'=>'ATCONL',
     // 'SMS_Job_NO'=>'123',
     // 'mtype'=>null,
     // 'DR'=>'Y'
  ];

  $response = curlSMSRequest($request);

  if($response){
    $application_details->status = 'Confirmed';
    $application_details->update();
    return redirect()->route('prospects.application-index')->with('success', 'Confirmation Message Sent.');
  }
  else{
    return redirect()->back()->with('danger', 'Message not Sent.');
  } 
}


public function confirmAppointment($id)
{
  $application_details = GraduationRegister::where('id',$id)->first();

  $doctor = FacultyDetail::where('id', $application_details->faculty_id)->first();

//     if($application_details->patient_id)
//     {

//     $request = 
//         [
//            'User' => 'assisi',
//            'passwd' => 'atcdemo#10/19',
//            'sid'=>'AJHOSP',
//            'mobilenumber'=>$application_details->phone,
//            'message'=>'MR No : '.$application_details->patient_id.', 
// Your Appointment with '.$application_details->faculty->full_name.' on '. $application_details->date->format('d/m/Y').' at '.$application_details->time.' is confirmed. Please visit Appointment Desk, OPD Block, Ground Floor, AJHRC. Rescheduling or Cancellation please call us at 0824-6613282 or 07846802333. Thank you. Regards AJHRC.',
//            // 'sid'=>'ATCONL',
//            'SMS_Job_NO'=>'123',
//            'mtype'=>null,
//            'DR'=>'Y'
//         ];
//     }
//     else
//     {
    //      $conference_type = 'Appointment'; 

    // $data = array('name' => $request->name, 'mobile' =>$payment->contact,'email'=>$payment->email,'amount'=>$amount->amount,'type'=>'Online','conference_type'=>$conference_type,'id'=>$application_details,'doctor'=>$doctor);

    //   Mail::send('front.send-payment-mail', $data, function( $details ) use ($data)
    //     {
    //         $details->to($data['email'])->from('rakshiths@atconline.biz', 'AJ Hospital')->subject('Doctor Appointment');
    //     });            

  $request = 
  [ 
     // 'User' => 'assisi',
     // 'passwd' => 'atcdemo#10/19',
     // 'sid'=>'AJHOSP',
     // 'mobilenumber'=>$application_details->phone,
     // 'message'=>'Hi '.$application_details->full_name.', 
     // Your Appointment with '.@$application_details->faculty->full_name.' on '. $application_details->date->format('d/m/Y').' at '.$application_details->time.' is confirmed. Please visit Appointment Desk, OPD Block, Ground Floor, AJHRC. Rescheduling or Cancellation please call us at 0824-6613282 or 07846802333. Thank you. Regards AJHRC.', 
     //       // 'sid'=>'ATCONL',
     // 'SMS_Job_NO'=>'123',
     // 'mtype'=>null,
     // 'DR'=>'Y'
  ];

  $response = curlSMSRequest($request);

  if($response){
    $application_details->status = 'Confirmed';
    $application_details->update();
    return redirect()->back()->with('success', 'Confirmation Message Sent.');
  }
  else{
    return redirect()->back()->with('danger', 'Message not Sent.');
  }   

  return view('back.downloads.application-detailView', compact ('application_details'));

}

public function reviewAppointment(Request $request, $id = null)
{
    // dd($request->id);
  if(is_array($request->id)){
    $application_details = GraduationRegister::whereIn('id',$request->id)->get(); 
  }
  else{
    $application_details = GraduationRegister::where('id',$request->id)->get();
  }

    // dd($application_details);
  foreach ($application_details as $app) {

    $request = 
    [
         // 'User' => 'assisi',
         // 'passwd' => 'atcdemo#10/19',
         // 'sid'=>'AJHOSP',
         // 'mobilenumber'=>$app->phone,
         // 'message'=>'Hi '.$app->full_name.', 
         // Thank You for Visiting AJ Hospital. Regards AJHRC.',
         //       // 'sid'=>'ATCONL',
         // 'SMS_Job_NO'=>'123',
         // 'mtype'=>null,
         // 'DR'=>'Y'
    ];    

    $response = curlSMSRequest($request);

    if($response){
      $app->status = 'Reviewed';
      $app->update();
    }
  }

  if($response){
    return redirect()->back()->with('success', 'Review Message Sent.');
  }
  else{
    return redirect()->back()->with('danger', 'Message not Sent.');
  }  

  return view('back.downloads.application-detailView', compact ('application_details'));

}

public function deleteApplicationForm(GraduationRegister $destroy_id)
{
  $destroy_id->delete ();
  return redirect()->back()->with('success', 'Deleted successfully.');
}

// SMS Report

public function viewSMSReport(Request $request)
{
  $search = ($request['search'])?$request['search']:null;

  $status_list = array(''=>'-- All --',
    '4'=> 'Delivered',
    '7'=> 'Message Sent',
    '3'=> 'Un Delivered',
    '1'=> 'Message In Queue',
    '2'=> 'Submitted To Carrier',
    '5'=> 'Expired',
    '6'=> 'Rejected',
    '8' => 'Opted Out Mobile Number',
    '9' => 'Invalid Mobile Number');

  $actual_status = null;

  return view('back.downloads.sms-index', compact ('status_list','actual_status'));
}

public function getSMSReport(Request $request)
{
  if($request->clear)
  {
    $request->merge(['from_date' => '','to_date' => '','status' => '']);
  }

  if(!empty($_GET["from_date"]) && !empty($_GET["to_date"]))
  {
    // $fromdate = Carbon::parse($_GET["from_date"])->format('m/d/Y') . ' 00:00:00';
    // $todate = Carbon::parse($_GET["to_date"])->format('d/m/Y') . ' 23:59:59';
    $fromdate = $_GET["from_date"] . ' 00:00:00';
    $todate = $_GET["from_date"] . ' 23:59:59';
  }
  else
  {
    $fromdate = Carbon::now()->format('d/m/Y') . ' 00:00:00';
    $todate = Carbon::now()->format('d/m/Y') . ' 23:59:59';
  }

  $user = urlencode('thinkpace');
  $passwd = urlencode('thinkP#17');
  $fromdate = urlencode($fromdate);
  $todate = urlencode($todate);

  $res = file_get_contents('http://api.smscountry.com/smscwebservices_bulk_reports.aspx?user='.$user.'&passwd='.$passwd.'&fromdate='.$fromdate.'&todate='.$todate.'');

  // return($res);

  $response = $res;

  if(trim($response) === 'From date And To date must be within the same month and year.') {
    throw new \Exception('SMS Country > ' . $response);
  }

  if(trim($response) === 'Please Retrieve One Week Data at a Time.') {
    throw new \Exception('SMS Country > ' . $response);
  }

  $rows = explode('#', html_entity_decode($response));

  $data = [];

  $statusCodes = [
    '0'=> 'Message In Queue',
    '1'=> 'Submitted To Carrier',
    '2'=> 'Un Delivered',
    '3'=> 'Delivered',
    '4'=> 'Expired',
    '8'=> 'Rejected',
    '9'=> 'Message Sent',
    '10' => 'Opted Out Mobile Number',
    '11' => 'Invalid Mobile Number'
  ];

  foreach($rows as $row) {
    $columns = explode('~', $row);
    $data[] = [
      'job_id' => $columns[0],
      'mobile_number' => isset($columns[1]) ? substr($columns[1], 2) : null,
      'message' => isset($columns[5]) ? $columns[5] : null,
      'status' => isset($columns[2]) ? $statusCodes[$columns[2]] : null,
      'cost' => isset($columns[4]) ? $columns[4] : null,
      'done_timestamp' => isset($columns[3]) ? $columns[3] : null,
    ];
  }

  // return $data;

  if($request->status)
  {
    if($request->status == '1')
    {
      $fdata = array_filter($data, function ($item) {
        return $item['status'] == 'Message In Queue';
      });
    }
    else if($request->status == '2')
    {
     $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Submitted To Carrier';
    });
   }
   else if($request->status == '3')
   {
     $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Un Delivered';
    });
   }
   else if($request->status == '4')
   {
    $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Delivered';
    });
  }
  else if($request->status == '5')
  {
    $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Expired';
    });
  }
  else if($request->status == '6')
  {
    $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Rejected';
    });
  }
  else if($request->status == '7')
  {
    $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Message Sent';
    });
  }
  else if($request->status == '8')
  {
    $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Opted Out Mobile Number';
    });
  }
  else if($request->status == '9')
  {
    $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Invalid Mobile Number';
    });
  }
  else
  {
    $fdata = array_filter($data, function ($item) {
      return $item;
    });
  }
}
else
{
  $fdata = $data;
}

$datas = $fdata;
//Search

$searchterm = request()->input('search');
$filtered = $datas;   

    //   if ($searchterm['value']) {
    //     $filtered->where('job_title', 'like', "%" . $searchterm['value'] . "%");
    //   }

// return $datas;

return DataTables::of($datas)
->addIndexColumn()

->filter(function ($instance) use ($request) {

  $this->sr = request()->input('search');   

  if (!empty($this->sr['value'])) {
    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
      if (Str::contains(Str::lower($row['mobile_number']), Str::lower($this->sr['value']))){
        return true;
      // }else if (Str::contains(Str::lower($row['job_id']), Str::lower($this->sr['value']))) {
      //   return true;
      }else if (Str::contains(Str::lower($row['message']), Str::lower($this->sr['value']))) {
        return true;
      }else if (Str::contains(Str::lower($row['status']), Str::lower($this->sr['value']))) {
        return true;
      }

      return false;
    });
  }

})

->addColumn('id', function ($row) {
  return $this->i++;
}) 

->addColumn('checkbox', function ($row) {
  return '<input type="checkbox" class="id" name="id[]" value="'.$row['mobile_number'].'" />';
})

->addColumn('action', function ($row) {
  return '<a href="javascript:void(0)" title="View" class="btn btn-info btn-sm"><span class="fa fa-eye"></span></a> ';
})       
->rawColumns(['id'=>'id','checkbox'=>'checkbox','action'=>'action'])


->with([
  "recordsTotal" => count($datas),
  "recordsFiltered" => count($filtered),
])
->make(true);
}


public function getExportSMSReport(Request $request)
{     
    // dd($request->all());

 if($request->clear)
 {
  $request->merge(['from_date' => '','to_date' => '','status' => '']);
}

if(!empty($request->from_date) && !empty($request->to_date))
{
    // $fromdate = Carbon::parse($_GET["from_date"])->format('m/d/Y') . ' 00:00:00';
    // $todate = Carbon::parse($_GET["to_date"])->format('d/m/Y') . ' 23:59:59';
  $fromdate = $request->from_date . ' 00:00:00';
  $todate = $request->to_date . ' 23:59:59';
}
else
{
  $fromdate = Carbon::now()->format('d/m/Y') . ' 00:00:00';
  $todate = Carbon::now()->format('d/m/Y') . ' 23:59:59';
}

$user = urlencode('thinkpace');
$passwd = urlencode('thinkP#17');
$fromdate = urlencode($fromdate);
$todate = urlencode($todate);

$res = file_get_contents('http://api.smscountry.com/smscwebservices_bulk_reports.aspx?user='.$user.'&passwd='.$passwd.'&fromdate='.$fromdate.'&todate='.$todate.'');

  // return($res);

$response = $res;

if(trim($response) === 'From date And To date must be within the same month and year.') {
  throw new \Exception('SMS Country > ' . $response);
}

if(trim($response) === 'Please Retrieve One Week Data at a Time.') {
  throw new \Exception('SMS Country > ' . $response);
}

$rows = explode('#', html_entity_decode($response));

$data = [];

$statusCodes = [
  '0'=> 'Message In Queue',
  '1'=> 'Submitted To Carrier',
  '2'=> 'Un Delivered',
  '3'=> 'Delivered',
  '4'=> 'Expired',
  '8'=> 'Rejected',
  '9'=> 'Message Sent',
  '10' => 'Opted Out Mobile Number',
  '11' => 'Invalid Mobile Number'
];

foreach($rows as $row) {
  $columns = explode('~', $row);
  $data[] = [
    'job_id' => $columns[0],
    'mobile_number' => isset($columns[1]) ? substr($columns[1], 2) : null,
    'message' => isset($columns[5]) ? $columns[5] : null,
    'status' => isset($columns[2]) ? $statusCodes[$columns[2]] : null,
    'done_timestamp' => isset($columns[3]) ? $columns[3] : null,
  ];
}

  // return $data;

if($request->status)
{
  if($request->status == '1')
  {
    $fdata = array_filter($data, function ($item) {
      return $item['status'] == 'Message In Queue';
    });
  }
  else if($request->status == '2')
  {
   $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Submitted To Carrier';
  });
 }
 else if($request->status == '3')
 {
   $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Un Delivered';
  });
 }
 else if($request->status == '4')
 {
  $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Delivered';
  });
}
else if($request->status == '5')
{
  $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Expired';
  });
}
else if($request->status == '6')
{
  $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Rejected';
  });
}
else if($request->status == '7')
{
  $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Message Sent';
  });
}
else if($request->status == '8')
{
  $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Opted Out Mobile Number';
  });
}
else if($request->status == '9')
{
  $fdata = array_filter($data, function ($item) {
    return $item['status'] == 'Invalid Mobile Number';
  });
}
else
{
  $fdata = array_filter($data, function ($item) {
    return $item;
  });
}
}
else
{
  $fdata = $data;
}

$datas = $fdata;

if($request->exportData)
{
  // $registered_forms = $registered_forms->get();

  $dataHeader = array('Job Id','Mobile No','Message','Status','Time');

  set_time_limit(0);


  $report_details = array();
  $i = 0;

  $report_details = $datas;

  // foreach ($datas as $d_value) {

  //   $report_details->job_id = $d_value->job_id;
  //   $report_details->mobile_number = $d_value->mobile_number;
  //   $report_details->message = $d_value->message;
  //   $report_details->status = $d_value->status;
  //   $report_details->done_timestamp = $d_value->done_timestamp;
  //   $i++;
  // }


  Excel::create('SMS_Report', function ($excel) use ($report_details, $dataHeader) {

    $excel->sheet('Sheetname', function ($sheet) use ($report_details, $dataHeader){

            // $sheet->setWidth('A', 5);
      $sheet->getDefaultRowDimension()->setRowHeight(20);

      $sheet->getRowDimension(1)->setRowHeight(25);

      $styleArray = array(
        'font'  => array(
          'bold'  => true,
        ));

      $sheet->getStyle('A1:F1')->applyFromArray($styleArray);

      $sheet->row(1, $dataHeader);

                    // Append multiple rows
      $sheet->rows($report_details);

    });

  })
    // ->export('xls');
  ->store('xls', storage_path('app/public/reports/'), true);
  $path="/storage/reports/SMS_Report.xls";
  return \Response::json(['status'=>'success','url'=>url('/').$path]); 
}

$search = ($request['search'])?$request['search']:null;

$status_list = array(''=>'-- All --',
  '4'=> 'Delivered',
  '7'=> 'Message Sent',
  '3'=> 'Un Delivered',
  '1'=> 'Message In Queue',
  '2'=> 'Submitted To Carrier',
  '5'=> 'Expired',
  '6'=> 'Rejected',
  '8' => 'Opted Out Mobile Number',
  '9' => 'Invalid Mobile Number');

$actual_status = null;

return view('back.downloads.sms-index', compact ('status_list','actual_status'));
}

}



