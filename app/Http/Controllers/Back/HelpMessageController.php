<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\{
    Http\Controllers\Controller,
    Models\Category,
    Models\HelpMessage,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Models\SubChildMenu,
    Models\ChooseNo,
    Models\HelpMessageTab,
    Models\HelpMessageLogin,

    Repositories\HelpMessageRepository
};
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Hash;

class HelpMessageController extends Controller
{
    use Indexable;

    /**
     * Create a new HelpMessageController instance.
     *
     * @param  \App\Repositories\HelpMessageRepository $repository
     */
    public function __construct(HelpMessageRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'help_messages';
    }

    /**
     * Update "new" field for HelpMessage.
     *
     * @param  \App\Models\HelpMessage $help_message
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(HelpMessage $help_message)
    {
        $help_message->ingoing->delete();

        return response()->json();
    }

    /**
     * Update "active" field for HelpMessage.
     *
     * @param  \App\Models\HelpMessage $help_message
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(HelpMessage $help_message, $status = false)
    {
        $help_message->active = $status;
        $help_message->save();

        return response()->json();
    }

    /**
     * Show the form for creating a new HelpMessage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  $parent_menus = ParentMenu::all()->pluck('name','id')->prepend('--Select--');

        $parent_menus = ParentMenu::where('status', 'Active')->where('post_entry', 'Y')->pluck('name', 'id')->prepend('--Select--', '');

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
        $actual_help_message_from_date = null;
        $actual_help_message_to_date = null;
        $help_message_tabs = null;
        $title1 = null;
        $title2 = null;
        $selected_gallery_images = null;

        $actual_brochure = 'N';

        return view('back.help_messages.create', compact('actual_parent_slug', 'actual_sub_slug', 'parent_menus', 'actual_parent_menu', 'actual_sub_menu', 'actual_child_menu', 'actual_sub_child_menu', 'actual_help_message_from_date', 'help_message_tabs', 'actual_help_message_to_date', 'actual_brochure', 'categories', 'actual_category', 'title1', 'title2', 'selected_gallery_images'));
    }

    /**
     * Store a newly created HelpMessage in storage.
     *
     * @param  \App\Http\Requests\HelpMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        //    $result = $this->repository->store($request);

        if (!empty($request->help_message_from_date) && !empty($request->help_message_to_date)) {
            $help_message_from_Date = Carbon::createFromFormat('d/m/Y', $request->help_message_from_date)->format('Y-m-d');
            $help_message_to_Date = Carbon::createFromFormat('d/m/Y', $request->help_message_to_date)->format('Y-m-d');

            $range = CarbonPeriod::create($help_message_from_Date, $help_message_to_Date);

            $dates = $range->toArray();
        } else {
            $help_message_from_Date = null;
            $help_message_to_Date = null;
            $dates = null;
        }

        if (isset($request->gallery_images)) {
            $filepath = "storage/files/help_message_gallery";
            $gallery_image_name = null;

            foreach ($request->file('gallery_images') as $gallery_image) {
                $imagename = time() . '_' . $gallery_image->getClientOriginalName();
                $imagename = str_replace(' ', '', $imagename);
                $destinationPath = public_path($filepath);
                $gallery_image->move($destinationPath, $imagename);
                $gallery_image_name =  $gallery_image_name . ',/' . $filepath . "/" . $imagename;
            }

            $gallery_images = $gallery_image_name;
        } else {
            $gallery_images = null;
        }

        // $request->gallery_images = $gallery_images;
        $request->merge(['help_message_gallery' => $gallery_images]);

        if ($dates) {
            $request->merge(['user_id' => auth()->id()]);
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($request->name)]);
            $request->merge(['help_message_from_date' => $help_message_from_Date]);
            $request->merge(['help_message_to_date' => $help_message_to_Date]);
            $request->merge(['body' => $request->body]);
            $request->merge(['tab_section' => 'N']);
            $help_message = HelpMessage::create($request->all());

            foreach ($dates as $key => $value) {
                $help_message_tab = new HelpMessageTab();
                $help_message_tab->help_message_id = $help_message->id;
                $help_message_tab->tab_title = $value->format('d/m/Y');
                $help_message_tab->tab_image = null;
                $help_message_tab->tab_body = null;
                $help_message_tab->user_id = auth()->id();
                $help_message_tab->save();
            }
        }

        if (isset($request->tab_section)) {
            // $request->merge(['user_id' => auth()->id()]);
            // $request->merge(['active' => $request->has('active')]);
            // $request->merge(['slug' => Str::slug($request->name)]);           
            // $request->merge(['help_message_from_date' => $help_message_from_Date]);
            // $request->merge(['help_message_to_date' => $help_message_to_Date]);
            // $request->merge(['body' => $request->body]);
            // $request->merge(['tab_section' => $request->has('tab_section')]);
            // $help_message = HelpMessage::create($request->all());

            // foreach ($request->tab_title as $key => $value) {

            //     $help_message_tab = new HelpMessageTab();
            //     $help_message_tab->help_message_id = $help_message->id;
            //     $help_message_tab->tab_title = $request->tab_title[$key];
            //     $help_message_tab->tab_image = $request->tab_image[$key];
            //     $help_message_tab->tab_body = $request->tab_body[$key];
            //     $help_message_tab->user_id = auth()->id();
            //     $help_message_tab->save();
            // }
        } else {
            $request->merge(['user_id' => auth()->id()]);
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($request->name)]);
           
            $request->merge(['tab_section' => 'N']);

            $help_message = HelpMessage::create($request->all());
        }

      
        $result = 'success';

        if ($result == 'success') {
            return redirect(route('help-messages.index'))->with('HelpMessage-ok', __('The HelpMessage has been successfully created'));
        } else {
            return redirect(route('help-messages.index'))->with('HelpMessage-danger', __('The HelpMessage already exist'));
        }
    }


    /**
     * Display the HelpMessage.
     *
     * @param  \App\Models\HelpMessage $help_message
     * @return \Illuminate\Http\Response
     */
    public function show(HelpMessage $help_message)
    {
        return view('back.help_messages.show', compact('HelpMessage'));
    }

    /**
     * 
     * Show the form for editing the HelpMessage.
     *
     * @param  \App\Models\HelpMessage $help_message
     * @return \Illuminate\Http\Response
     */
    public function edit(HelpMessage $help_message)
    {

        // dd($help_message);
        // $this->authorize('manage', $help_message);

        $categories = Category::all()->pluck('title', 'id');

        $parent_menus = ParentMenu::where('status', 'Active')->where('post_entry', 'Y')->pluck('name', 'id')->prepend('--Select--', '');

        $actual_parent_slug = @$help_message->mainMenu->slug;

        $actual_sub_slug = @$help_message->subMenu->slug;

        $actual_parent_menu = $help_message->parent_menu_id;

        $actual_category = $help_message->category_id;

        $actual_sub_menu = $help_message->sub_menu_id;

        $actual_child_menu = $help_message->child_menu_id;

        $actual_sub_child_menu = $help_message->sub_child_menu_id;

        if (!empty($help_message->help_message_from_date) && !empty($help_message->help_message_to_date)) {

            $actual_help_message_from_date = $help_message->help_message_from_date->format('d/m/Y');
            $actual_help_message_to_date = $help_message->help_message_to_date->format('d/m/Y');
        } else {
            $actual_help_message_from_date = null;
            $actual_help_message_to_date = null;
        }

        if ($help_message->tab_section == 'Y') {
            $help_message_tabs = HelpMessageTab::where('help_message_id', '=', $help_message->id)->get();
            $tab_id = $help_message_tabs->pluck('id');
        } else {
            $help_message_tabs = null;
            $tab_id = null;
        }

        $actual_brochure = null;

        $title1 = null;
        $title2 = null;

        $selected_gallery_images = array_values(array_filter(explode(',', $help_message->help_message_gallery)));

        // $help_message_login = HelpMessageLogin::where('help_message_id', '=', $help_message->id)->first();

        //    dd($help_message_login);
        return view('back.help_messages.edit', compact('help_message', 'parent_menus', 'actual_parent_slug', 'actual_sub_slug', 'actual_parent_menu', 'actual_sub_menu', 'actual_child_menu', 'actual_sub_child_menu', 'actual_help_message_from_date', 'actual_help_message_to_date', 'help_message_tabs', 'tab_id', 'actual_brochure', 'categories', 'actual_category', 'title1', 'title2', 'selected_gallery_images'));
    }

    /**
     * Update the HelpMessage in storage.
     *
     * @param  \App\Http\Requests\HelpMessageRequest  $request
     * @param  \App\Models\HelpMessage $help_message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HelpMessage $help_message)
    {
        // dd($request->all());
        // $this->authorize('manage', $help_message);

        // $result = $this->repository->update($help_message, $request);

        if (!empty($request->help_message_from_date) && !empty($request->help_message_to_date)) {
            $help_message_from_Date = Carbon::createFromFormat('d/m/Y', $request->help_message_from_date)->format('Y-m-d');
            $help_message_to_Date = Carbon::createFromFormat('d/m/Y', $request->help_message_to_date)->format('Y-m-d');

            $range = CarbonPeriod::create($help_message_from_Date, $help_message_to_Date);

            $dates = $range->toArray();
        } else {
            $help_message_from_Date = null;
            $help_message_to_Date = null;
            $dates = null;
        }

        if ($request->hasFile('gallery_images')) {
            $filepath = "storage/files/help_message_gallery";
            $gallery_image_name = null;

            foreach ($request->file('gallery_images') as $gallery_image) {
                $imagename = time() . '_' . $gallery_image->getClientOriginalName();
                $imagename = str_replace(' ', '', $imagename);
                $destinationPath = public_path($filepath);
                $gallery_image->move($destinationPath, $imagename);
                $gallery_image_name =  $gallery_image_name . ',/' . $filepath . "/" . $imagename;
            }
            //$post_page->gallery_images = $gallery_image_name;
        } else {
            $gallery_image_name = null;
        }

        $gallery_images = ($help_message->gallery_images != NULL) ? $help_message->gallery_images . ',/' . $gallery_image_name : $gallery_image_name;

        //  dd($gallery_images);
        // $request->gallery_images = $gallery_images;
        $request->merge(['help_message_gallery' => $gallery_images]);

        // $help_message_login = HelpMessageLogin::where('help_message_id', $help_message->id)->first();

        // if ($help_message_login !== null) {
        //     $help_message_login->update(['username' => $request->username, 'password' => Hash::make($request->password), 'user_id' => auth()->id()]);
        // } else {
        //     $help_message_login = new HelpMessageLogin();
        //     $help_message_login->help_message_id = $help_message->id;
        //     $help_message_login->username = $request->username;
        //     $help_message_login->password = Hash::make($request->password);
        //     $help_message_login->user_id = auth()->id();
        //     $help_message_login->save();
        // }

        if ($dates) {
            foreach ($dates as $key => $value) {
                $help_message_tab = HelpMessageTab::where('help_message_id', $help_message->id)->where('tab_title', $value->format('d/m/Y'))->first();
                if (!$help_message_tab) {
                    $help_message_tab = new HelpMessageTab();
                    $help_message_tab->help_message_id = $help_message->id;
                    $help_message_tab->tab_title = $value->format('d/m/Y');
                    $help_message_tab->tab_image = null;
                    $help_message_tab->tab_body = null;
                    $help_message_tab->user_id = auth()->id();
                    $help_message_tab->save();
                }
            }
        }

        //$parent_news_id = ParentMenu::where('slug','=','atc-catalog')->first();

        //$sub_news_id = SubMenu::where('parent_menu_id','=',$parent_news_id->id)->where('constant','=','news')->whereNull('deleted_at')->first();

        if (isset($request->tab_section)) {
            // $request->merge(['active' => $request->has('active')]);
            // $request->merge(['slug' => Str::slug($request->name)]);                  
            // $request->merge(['help_message_from_date' => $help_message_from_Date]);
            // $request->merge(['help_message_to_date' => $help_message_to_Date]);                   
            // $request->merge(['body' => $request->body]);
            // $request->merge(['tab_section' => $request->has('tab_section')]);

            // $help_message->update($request->all());

            //     // dd($request->tab_title);
            //     foreach ($request->tab_title as $key => $value) {

            //     if (is_array($value)){
            //         foreach ($value as $tab_key => $tab_value) {

            //             HelpMessageTab::where('id', $key)->update(['tab_title' => $tab_value,'tab_image'=>$request->tab_image[$key][$tab_key],'tab_body' => $request->tab_body[$key][$tab_key] ]);
            //         }
            //     }
            //     else
            //     {
            //         $help_message_tab = new HelpMessageTab();
            //         $help_message_tab->help_message_id = $help_message->id;
            //         $help_message_tab->tab_title = $request->tab_title[$key];
            //         $help_message_tab->tab_image = $request->tab_image[$key];
            //         $help_message_tab->tab_body = $request->tab_body[$key];
            //         $help_message_tab->user_id = auth()->id();
            //         $help_message_tab->save();
            //     }
            // }
        } else {
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($request->name)]);
            $request->merge(['help_message_from_date' => $help_message_from_Date]);
            $request->merge(['help_message_to_date' => $help_message_to_Date]);
            $request->merge(['tab_section' => 'N']);

            $help_message->update($request->all());
        }

        $result = 'success';

        if ($result == 'success') {
            return redirect(route('help-messages.index'))->with('HelpMessage-ok', __('The HelpMessage has been successfully updated'));
        } else {
            return redirect(route('help-messages.index'))->with('HelpMessage-danger', __('The HelpMessage already exist. Cannot update'));
        }
    }

    /**
     * Remove the HelpMessage from storage.
     *
     * @param HelpMessage $help_message
     * @return \Illuminate\Http\Response
     */
    public function destroy(HelpMessage $help_message)
    {
        // $this->authorize('manage', $help_message);

        //dd($help_message);

        $help_message->delete();

        HelpMessageTab::where('help_message_id', $help_message->id)->delete();

        return response()->json();
    }

    public function deleteHelpMessageTabSection(Request $request)
    {
        //dd($request->all());
        //$content = HelpMessageTab::where('id',$request->id)->first();

        HelpMessageTab::where('id',   $request->id)->delete();

        return 'true';
    }

    public function removeGalleryPhoto(Request $request)
    {
        // dd($request->all());
        //return false;
        $help_message_content = HelpMessage::find($request->id);
        $updates_file_names = str_replace($request->filename, '', $help_message_content->help_message_gallery);
        $help_message_content->help_message_gallery = $updates_file_names;
        $help_message_content->save();
        return $updates_file_names;
    }
}
