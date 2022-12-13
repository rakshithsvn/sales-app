<?php

namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ {
    Http\Requests\EventRequest,
    Http\Controllers\Controller,
    Models\Category,
    Models\Event,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Models\SubChildMenu,
    Models\ChooseNo,
    Models\EventTab,
    Models\EventLogin,

    Repositories\EventRepository
};
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Hash;

class EventController extends Controller
{
    use Indexable;

    /**
     * Create a new EventController instance.
     *
     * @param  \App\Repositories\EventRepository $repository
     */
    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'events';
    }

    /**
     * Update "new" field for Event.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Event $event)
    {
        $event->ingoing->delete ();

        return response ()->json ();
    }

    /**
     * Update "active" field for Event.
     *
     * @param  \App\Models\Event $event
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Event $event, $status = false)
    {
        $event->active = $status;
        $event->save();

        return response ()->json ();
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  $parent_menus = ParentMenu::all()->pluck('name','id')->prepend('--Select--');

        $parent_menus = ParentMenu::where('status','Active')->where('post_entry','Y')->pluck('name','id')->prepend('--Select--','');

        $categories = Category::all()->pluck('title', 'id');

       // dd($parent_menus);

        $sub_menus = array('' => '--Select--');
        $actual_parent_slug = null;
        $actual_sub_slug = null;
        $actual_parent_menu = null;
        $actual_category = null;
        $actual_sub_menu = null;
        $actual_child_menu = null;
        $actual_sub_child_menu = null;
        $actual_event_from_date = null;
        $actual_event_to_date = null;        
        $event_tabs = null;
        $title1 = null;
        $title2 = null;
        $selected_gallery_images = null;

        $actual_brochure = 'N';

        return view('back.events.create', compact('actual_parent_slug','actual_sub_slug','parent_menus','actual_parent_menu','actual_sub_menu','actual_child_menu','actual_sub_child_menu','actual_event_from_date','event_tabs','actual_event_to_date','actual_brochure','categories','actual_category','title1','title2','selected_gallery_images'));
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param  \App\Http\Requests\EventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

    //    $result = $this->repository->store($request);

    if (!empty($request->event_from_date) && !empty($request->event_to_date))
    {
        $event_from_Date = Carbon::createFromFormat('d/m/Y', $request->event_from_date)->format('Y-m-d');
        $event_to_Date = Carbon::createFromFormat('d/m/Y', $request->event_to_date)->format('Y-m-d');

        $range = CarbonPeriod::create($event_from_Date, $event_to_Date);

        $dates = $range->toArray();
    }
    else
    {
        $event_from_Date = null;
        $event_to_Date = null;
        $dates = null;
    }

     if(isset($request->gallery_images))
       {
        $filepath = "storage/files/event_gallery";
        $gallery_image_name = null;

        foreach($request->file('gallery_images') as $gallery_image)
        {
            $imagename = time().'_'.$gallery_image->getClientOriginalName();
            $imagename = str_replace(' ','',$imagename);
            $destinationPath = public_path($filepath);
            $gallery_image->move($destinationPath, $imagename);
            $gallery_image_name =  $gallery_image_name . ',/' . $filepath . "/" . $imagename;
        }

        $gallery_images = $gallery_image_name;
    }
    else
    {
        $gallery_images = null;
    }

    // $request->gallery_images = $gallery_images;
    $request->merge(['event_gallery' => $gallery_images]);

    if($dates) {
        $request->merge(['user_id' => auth()->id()]);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['slug' => Str::slug($request->name)]);           
        $request->merge(['event_from_date' => $event_from_Date]);
        $request->merge(['event_to_date' => $event_to_Date]);
        $request->merge(['body' => $request->body]);
        $request->merge(['tab_section' => 'N']);
        $event = Event::create($request->all());

        foreach ($dates as $key => $value) {
            $event_tab = new EventTab();
            $event_tab->event_id = $event->id;
            $event_tab->tab_title = $value->format('d/m/Y');
            $event_tab->tab_image = null;
            $event_tab->tab_body = null;
            $event_tab->user_id = auth()->id();
            $event_tab->save();
        }
    }

    if(isset($request->tab_section))
        {
            // $request->merge(['user_id' => auth()->id()]);
            // $request->merge(['active' => $request->has('active')]);
            // $request->merge(['slug' => Str::slug($request->name)]);           
            // $request->merge(['event_from_date' => $event_from_Date]);
            // $request->merge(['event_to_date' => $event_to_Date]);
            // $request->merge(['body' => $request->body]);
            // $request->merge(['tab_section' => $request->has('tab_section')]);
            // $event = Event::create($request->all());

            // foreach ($request->tab_title as $key => $value) {

            //     $event_tab = new EventTab();
            //     $event_tab->event_id = $event->id;
            //     $event_tab->tab_title = $request->tab_title[$key];
            //     $event_tab->tab_image = $request->tab_image[$key];
            //     $event_tab->tab_body = $request->tab_body[$key];
            //     $event_tab->user_id = auth()->id();
            //     $event_tab->save();
            // }
        }
        else
        {
            $request->merge(['user_id' => auth()->id()]);
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($request->name)]);           
            $request->merge(['event_from_date' => $event_from_Date]);
            $request->merge(['event_to_date' => $event_to_Date]);           
            $request->merge(['tab_section' => 'N']);

            $event = Event::create($request->all());
        }
        
        $record_exists = EventLogin::where('username', $request->username)->first();

        if($record_exists == null)
        {
            $event_login = new EventLogin();
            $event_login->event_id = $event->id;
            $event_login->username = $request->username;
            $event_login->password = Hash::make($request->password);
            $event_login->user_id = auth()->id();
            $event_login->save();
        }
        else
        {
            return 'error';
        }        

        $result = 'success';

        if($result == 'success')
        {
            return redirect(route('events.index'))->with('Event-ok', __('The Event has been successfully created'));
        }
        else
        {
            return redirect(route('events.index'))->with('Event-danger', __('The Event already exist'));
        }
    }


    /**
     * Display the Event.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('back.events.show', compact('Event'));
    }

    /**
     * 
     * Show the form for editing the Event.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        
       // dd($event);
       // $this->authorize('manage', $event);

       $categories = Category::all()->pluck('title', 'id');

       $parent_menus = ParentMenu::where('status','Active')->where('post_entry','Y')->pluck('name','id')->prepend('--Select--','');

       $actual_parent_slug = @$event->mainMenu->slug;

       $actual_sub_slug = @$event->subMenu->slug;

       $actual_parent_menu = $event->parent_menu_id;

       $actual_category = $event->category_id;

       $actual_sub_menu = $event->sub_menu_id;

       $actual_child_menu =$event->child_menu_id;

       $actual_sub_child_menu =$event->sub_child_menu_id;

       if (!empty($event->event_from_date) && !empty($event->event_to_date)) {

        $actual_event_from_date = $event->event_from_date->format('d/m/Y');
        $actual_event_to_date = $event->event_to_date->format('d/m/Y');
    }
    else
    {
        $actual_event_from_date =null;
        $actual_event_to_date =null;
    }

    if($event->tab_section == 'Y')
    {
        $event_tabs = EventTab::where('event_id','=',$event->id)->get();
        $tab_id = $event_tabs->pluck('id');
    }
    else
    {
        $event_tabs = null;
        $tab_id = null;
    }

    $actual_brochure = null;

    $title1 = null;
    $title2 = null;

    $selected_gallery_images = array_values( array_filter(explode(',',$event->event_gallery)));

    $event_login = EventLogin::where('event_id','=',$event->id)->first();

    //    dd($event_login);
    return view('back.events.edit', compact('event', 'parent_menus','actual_parent_slug','actual_sub_slug','actual_parent_menu','actual_sub_menu','actual_child_menu','actual_sub_child_menu','actual_event_from_date','actual_event_to_date','event_tabs','tab_id','actual_brochure','categories','actual_category','title1','title2','selected_gallery_images','event_login'));
}

    /**
     * Update the Event in storage.
     *
     * @param  \App\Http\Requests\EventRequest  $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
         // dd($request->all());
        // $this->authorize('manage', $event);

        // $result = $this->repository->update($event, $request);

        if (!empty($request->event_from_date) && !empty($request->event_to_date))
        {
            $event_from_Date = Carbon::createFromFormat('d/m/Y', $request->event_from_date)->format('Y-m-d');
            $event_to_Date = Carbon::createFromFormat('d/m/Y', $request->event_to_date)->format('Y-m-d');

            $range = CarbonPeriod::create($event_from_Date, $event_to_Date);
    
            $dates = $range->toArray();
        }
        else
        {
            $event_from_Date = null;
            $event_to_Date = null;
            $dates = null;
        }

        if($request->hasFile('gallery_images'))
        {
        $filepath = "storage/files/event_gallery";
        $gallery_image_name = null;

        foreach($request->file('gallery_images') as $gallery_image)
        {
            $imagename = time().'_'.$gallery_image->getClientOriginalName();
            $imagename = str_replace(' ','',$imagename);
            $destinationPath = public_path($filepath);
            $gallery_image->move($destinationPath, $imagename);
            $gallery_image_name =  $gallery_image_name . ',/' . $filepath . "/" . $imagename;
        }
        //$post_page->gallery_images = $gallery_image_name;
    }
    else
    {
        $gallery_image_name = null;
    }

     $gallery_images = ($event->gallery_images!=NULL)?$event->gallery_images.',/'.$gallery_image_name : $gallery_image_name;
     
    //  dd($gallery_images);
    // $request->gallery_images = $gallery_images;
    $request->merge(['event_gallery' => $gallery_images]);

    $event_login = EventLogin::where('event_id',$event->id)->first();

    if($event_login !== null) {
        $event_login->update(['username' => $request->username, 'password' => Hash::make($request->password), 'user_id' => auth()->id()]);
    } else {
        $event_login = new EventLogin();
        $event_login->event_id = $event->id;
        $event_login->username = $request->username;
        $event_login->password = Hash::make($request->password);
        $event_login->user_id = auth()->id();
        $event_login->save();
    }

    if($dates) {
        foreach ($dates as $key => $value) {
            $event_tab = EventTab::where('event_id',$event->id)->where('tab_title',$value->format('d/m/Y'))->first();
            if(!$event_tab) {
                $event_tab = new EventTab();
                $event_tab->event_id = $event->id;
                $event_tab->tab_title = $value->format('d/m/Y');
                $event_tab->tab_image = null;
                $event_tab->tab_body = null;
                $event_tab->user_id = auth()->id();
                $event_tab->save();
            }            
        }
    }

        //$parent_news_id = ParentMenu::where('slug','=','atc-catalog')->first();

        //$sub_news_id = SubMenu::where('parent_menu_id','=',$parent_news_id->id)->where('constant','=','news')->whereNull('deleted_at')->first();

        if(isset($request->tab_section))
        {
            // $request->merge(['active' => $request->has('active')]);
            // $request->merge(['slug' => Str::slug($request->name)]);                  
            // $request->merge(['event_from_date' => $event_from_Date]);
            // $request->merge(['event_to_date' => $event_to_Date]);                   
            // $request->merge(['body' => $request->body]);
            // $request->merge(['tab_section' => $request->has('tab_section')]);

            // $event->update($request->all());

            //     // dd($request->tab_title);
            //     foreach ($request->tab_title as $key => $value) {

            //     if (is_array($value)){
            //         foreach ($value as $tab_key => $tab_value) {

            //             EventTab::where('id', $key)->update(['tab_title' => $tab_value,'tab_image'=>$request->tab_image[$key][$tab_key],'tab_body' => $request->tab_body[$key][$tab_key] ]);
            //         }
            //     }
            //     else
            //     {
            //         $event_tab = new EventTab();
            //         $event_tab->event_id = $event->id;
            //         $event_tab->tab_title = $request->tab_title[$key];
            //         $event_tab->tab_image = $request->tab_image[$key];
            //         $event_tab->tab_body = $request->tab_body[$key];
            //         $event_tab->user_id = auth()->id();
            //         $event_tab->save();
            //     }
            // }
        }
        else
        {
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($request->name)]);                   
            $request->merge(['event_from_date' => $event_from_Date]);
            $request->merge(['event_to_date' => $event_to_Date]);
            $request->merge(['tab_section' => 'N']);

            $event->update($request->all());
        }

        $result = 'success';

        if($result == 'success')
        {
            return redirect(route('events.index'))->with('Event-ok', __('The Event has been successfully updated'));
        }
        else
        {
            return redirect(route('events.index'))->with('Event-danger', __('The Event already exist. Cannot update'));
        }
    }

    /**
     * Remove the Event from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // $this->authorize('manage', $event);

        //dd($event);

        $event->delete ();

        EventTab::where('event_id', $event->id)->delete();

        return response ()->json ();
    }

    public function deleteEventTabSection(Request $request)
    {
        //dd($request->all());
        //$content = EventTab::where('id',$request->id)->first();

        EventTab::where('id',   $request->id)->delete();

        return 'true';

    }

    public function removeGalleryPhoto(Request $request)
    {
        // dd($request->all());
        //return false;
        $event_content = Event::find($request->id);
        $updates_file_names = str_replace($request->filename , '', $event_content->event_gallery);
        $event_content->event_gallery = $updates_file_names;
        $event_content->save();
        return $updates_file_names;
    }

}
