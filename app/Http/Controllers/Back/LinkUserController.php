<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\EventUser,
    Models\userTab,
    Models\LinkUser,
    Models\Event,
    Models\ParentMenu,
    Repositories\LinkUserRepository
};
use DB;
use Illuminate\Support\Str;

class LinkUserController extends Controller
{

    use Indexable;

    /**
     * Create a new EventController instance.
     *
     * @param  \App\Repositories\EventRepository $repository
     */
    public function __construct(LinkUserRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'link_users';
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
        $link_users = LinkUser::orderBy('id','desc')->paginate(10);

        if(isset($search))
        {
            $link_users = LinkUser::join('event_users', function($event_users){
                $event_users->on('event_users.id','=','link_users.event_user_id');
            })->select('link_users.*','event_users.id as event_user_id')->where('event_users.name', 'like', "%".$search."%")->paginate(10);

            // $link_users =   LinkUser::join('Events', function($Events){
            //     $Events->on('Events.id','=','link_users.Event_id');
            // })->select('link_users.*','Events.id as Event_id')->where('title', 'like', "%".$search."%")->paginate(10);
        }
        $links = $link_users->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.link-users.table", ['link_users' => $link_users])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.link-users.index', compact ('link_users'));
    }

    /**
     * Show the form for creating a new user.
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
        $actual_user_name = null;
        $actual_post_tab = null;

        $user_select = array('' => '--Select--');

        $user_names = EventUser::all()->pluck('username','id');

        foreach($user_names as $key => $value)
        {
        	$user_select[$key] =$value;
        }

        $user_names = $user_select;
       // $user_tabs = null;

        //dd($event_list);

        return view('back.link-users.create',compact('event_list','actual_event','user_names','actual_user_name','actual_post_tab'));
    }

    
    public function store(Request $request)
    {
        //dd($request->all());

     $result = $this->repository->store($request);

     if($result == 'success')
     {
        return redirect(route('link-users.index'))->with('category-ok', __('User details linked to event successfully'));
    }
    else
    {
       return redirect(route('link-users.index'))->with('category-danger', __('The link is already exist'));
   }


}

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(LinkUser $link_user)
    {
      // dd($link_user);

        $link_users = $link_user;

        $dept_menu_id = ParentMenu::select('id')->where('slug','=','services')->first();

        $event_list = Event::orderBy('name')->pluck('name','id');

        foreach ($event_list as $key => $value) 
        {
            $array_select[$key] = $value;
        }

        $event_list = $array_select;

        // $user_select = array('' => '--Select--');

        $user_names = EventUser::all()->pluck('username','id');
        
        foreach($user_names as $key => $value)
        {
        	$user_select[$key] = $value;
        }

        $user_names = $user_select; 

        $actual_event = $link_user->event_id;
        $actual_post_tab = $link_user->post_tab_id;
        $actual_user_name =$link_user->event_user_id;

        return view('back.link-users.edit', compact ('actual_event','link_users','actual_post_tab','actual_user_name','event_list','user_names'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, LinkUser $link_user)
    {
        $result = $this->repository->update($link_user, $request);

        if($result == 'success')
        {
           return redirect(route('link-users.index'))->with('category-ok', __('The link details has been successfully updated'));
       }
       else
       {
           return redirect(route('link-users.index'))->with('category-danger', __('The link already exist. Cannot update'));
       }

   }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
     public function updateActive(LinkUser $link_user, $status = false)
     {
        $link_user->active = $status;
        $link_user->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(LinkUser $link_user)
    {
        $link_user->delete ();
        return response ()->json ();
    }


}
