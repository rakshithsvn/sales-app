<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\{
    Http\Controllers\Controller,
    Models\Category,
    Models\Dealer,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Models\SubChildMenu,
    Models\ChooseNo,
    Models\DealerTab,
    Models\DealerLogin,

    Repositories\DealerRepository
};
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Hash;

class DealerController extends Controller
{
    use Indexable;

    /**
     * Create a new DealerController instance.
     *
     * @param  \App\Repositories\DealerRepository $repository
     */
    public function __construct(DealerRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'dealers';
    }

    /**
     * Update "new" field for Dealer.
     *
     * @param  \App\Models\Dealer $dealer
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Dealer $dealer)
    {
        $dealer->ingoing->delete();

        return response()->json();
    }

    /**
     * Update "active" field for Dealer.
     *
     * @param  \App\Models\Dealer $dealer
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Dealer $dealer, $status = false)
    {
        $dealer->active = $status;
        $dealer->save();

        return response()->json();
    }

    /**
     * Show the form for creating a new Dealer.
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
        $actual_dealer_from_date = null;
        $actual_dealer_to_date = null;
        $dealer_tabs = null;
        $title1 = null;
        $title2 = null;
        $selected_gallery_images = null;

        $actual_brochure = 'N';

        return view('back.dealers.create', compact('actual_parent_slug', 'actual_sub_slug', 'parent_menus', 'actual_parent_menu', 'actual_sub_menu', 'actual_child_menu', 'actual_sub_child_menu', 'actual_dealer_from_date', 'dealer_tabs', 'actual_dealer_to_date', 'actual_brochure', 'categories', 'actual_category', 'title1', 'title2', 'selected_gallery_images'));
    }

    /**
     * Store a newly created Dealer in storage.
     *
     * @param  \App\Http\Requests\DealerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        //    $result = $this->repository->store($request);

        if (!empty($request->dealer_from_date) && !empty($request->dealer_to_date)) {
            $dealer_from_Date = Carbon::createFromFormat('d/m/Y', $request->dealer_from_date)->format('Y-m-d');
            $dealer_to_Date = Carbon::createFromFormat('d/m/Y', $request->dealer_to_date)->format('Y-m-d');

            $range = CarbonPeriod::create($dealer_from_Date, $dealer_to_Date);

            $dates = $range->toArray();
        } else {
            $dealer_from_Date = null;
            $dealer_to_Date = null;
            $dates = null;
        }

        if (isset($request->gallery_images)) {
            $filepath = "storage/files/dealer_gallery";
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
        $request->merge(['dealer_gallery' => $gallery_images]);

        if ($dates) {
            $request->merge(['user_id' => auth()->id()]);
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($request->name)]);
            $request->merge(['dealer_from_date' => $dealer_from_Date]);
            $request->merge(['dealer_to_date' => $dealer_to_Date]);
            $request->merge(['body' => $request->body]);
            $request->merge(['tab_section' => 'N']);
            $dealer = Dealer::create($request->all());

            foreach ($dates as $key => $value) {
                $dealer_tab = new DealerTab();
                $dealer_tab->dealer_id = $dealer->id;
                $dealer_tab->tab_title = $value->format('d/m/Y');
                $dealer_tab->tab_image = null;
                $dealer_tab->tab_body = null;
                $dealer_tab->user_id = auth()->id();
                $dealer_tab->save();
            }
        }

        if (isset($request->tab_section)) {
            // $request->merge(['user_id' => auth()->id()]);
            // $request->merge(['active' => $request->has('active')]);
            // $request->merge(['slug' => Str::slug($request->name)]);           
            // $request->merge(['dealer_from_date' => $dealer_from_Date]);
            // $request->merge(['dealer_to_date' => $dealer_to_Date]);
            // $request->merge(['body' => $request->body]);
            // $request->merge(['tab_section' => $request->has('tab_section')]);
            // $dealer = Dealer::create($request->all());

            // foreach ($request->tab_title as $key => $value) {

            //     $dealer_tab = new DealerTab();
            //     $dealer_tab->dealer_id = $dealer->id;
            //     $dealer_tab->tab_title = $request->tab_title[$key];
            //     $dealer_tab->tab_image = $request->tab_image[$key];
            //     $dealer_tab->tab_body = $request->tab_body[$key];
            //     $dealer_tab->user_id = auth()->id();
            //     $dealer_tab->save();
            // }
        } else {
            $request->merge(['user_id' => auth()->id()]);
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['is_verified' => $request->has('is_verified')]);
            $request->merge(['slug' => Str::slug($request->name)]);

            $request->merge(['tab_section' => 'N']);

            $dealer = Dealer::create($request->all());
        }


        $result = 'success';

        if ($result == 'success') {
            return redirect(route('dealers.index'))->with('Dealer-ok', __('The Dealer has been successfully created'));
        } else {
            return redirect(route('dealers.index'))->with('Dealer-danger', __('The Dealer already exist'));
        }
    }


    /**
     * Display the Dealer.
     *
     * @param  \App\Models\Dealer $dealer
     * @return \Illuminate\Http\Response
     */
    public function show(Dealer $dealer)
    {
        return view('back.dealers.show', compact('Dealer'));
    }

    /**
     * 
     * Show the form for editing the Dealer.
     *
     * @param  \App\Models\Dealer $dealer
     * @return \Illuminate\Http\Response
     */
    public function edit(Dealer $dealer)
    {

        // dd($dealer);
        // $this->authorize('manage', $dealer);

        $categories = Category::all()->pluck('title', 'id');

        $parent_menus = ParentMenu::where('status', 'Active')->where('post_entry', 'Y')->pluck('name', 'id')->prepend('--Select--', '');

        $actual_parent_slug = @$dealer->mainMenu->slug;

        $actual_sub_slug = @$dealer->subMenu->slug;

        $actual_parent_menu = $dealer->parent_menu_id;

        $actual_category = $dealer->category_id;

        $actual_sub_menu = $dealer->sub_menu_id;

        $actual_child_menu = $dealer->child_menu_id;

        $actual_sub_child_menu = $dealer->sub_child_menu_id;

        if (!empty($dealer->dealer_from_date) && !empty($dealer->dealer_to_date)) {

            $actual_dealer_from_date = $dealer->dealer_from_date->format('d/m/Y');
            $actual_dealer_to_date = $dealer->dealer_to_date->format('d/m/Y');
        } else {
            $actual_dealer_from_date = null;
            $actual_dealer_to_date = null;
        }

        if ($dealer->tab_section == 'Y') {
            $dealer_tabs = DealerTab::where('dealer_id', '=', $dealer->id)->get();
            $tab_id = $dealer_tabs->pluck('id');
        } else {
            $dealer_tabs = null;
            $tab_id = null;
        }

        $actual_brochure = null;

        $title1 = null;
        $title2 = null;

        $selected_gallery_images = array_values(array_filter(explode(',', $dealer->dealer_gallery)));

        // $dealer_login = DealerLogin::where('dealer_id', '=', $dealer->id)->first();

        //    dd($dealer_login);
        return view('back.dealers.edit', compact('dealer', 'parent_menus', 'actual_parent_slug', 'actual_sub_slug', 'actual_parent_menu', 'actual_sub_menu', 'actual_child_menu', 'actual_sub_child_menu', 'actual_dealer_from_date', 'actual_dealer_to_date', 'dealer_tabs', 'tab_id', 'actual_brochure', 'categories', 'actual_category', 'title1', 'title2', 'selected_gallery_images'));
    }

    /**
     * Update the Dealer in storage.
     *
     * @param  \App\Http\Requests\DealerRequest  $request
     * @param  \App\Models\Dealer $dealer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dealer $dealer)
    {
        // dd($request->all());
        // $this->authorize('manage', $dealer);

        // $result = $this->repository->update($dealer, $request);

        if (!empty($request->dealer_from_date) && !empty($request->dealer_to_date)) {
            $dealer_from_Date = Carbon::createFromFormat('d/m/Y', $request->dealer_from_date)->format('Y-m-d');
            $dealer_to_Date = Carbon::createFromFormat('d/m/Y', $request->dealer_to_date)->format('Y-m-d');

            $range = CarbonPeriod::create($dealer_from_Date, $dealer_to_Date);

            $dates = $range->toArray();
        } else {
            $dealer_from_Date = null;
            $dealer_to_Date = null;
            $dates = null;
        }

        if ($request->hasFile('gallery_images')) {
            $filepath = "storage/files/dealer_gallery";
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

        $gallery_images = ($dealer->gallery_images != NULL) ? $dealer->gallery_images . ',/' . $gallery_image_name : $gallery_image_name;

        //  dd($gallery_images);
        // $request->gallery_images = $gallery_images;
        $request->merge(['dealer_gallery' => $gallery_images]);

        // $dealer_login = DealerLogin::where('dealer_id', $dealer->id)->first();

        // if ($dealer_login !== null) {
        //     $dealer_login->update(['username' => $request->username, 'password' => Hash::make($request->password), 'user_id' => auth()->id()]);
        // } else {
        //     $dealer_login = new DealerLogin();
        //     $dealer_login->dealer_id = $dealer->id;
        //     $dealer_login->username = $request->username;
        //     $dealer_login->password = Hash::make($request->password);
        //     $dealer_login->user_id = auth()->id();
        //     $dealer_login->save();
        // }

        if ($dates) {
            foreach ($dates as $key => $value) {
                $dealer_tab = DealerTab::where('dealer_id', $dealer->id)->where('tab_title', $value->format('d/m/Y'))->first();
                if (!$dealer_tab) {
                    $dealer_tab = new DealerTab();
                    $dealer_tab->dealer_id = $dealer->id;
                    $dealer_tab->tab_title = $value->format('d/m/Y');
                    $dealer_tab->tab_image = null;
                    $dealer_tab->tab_body = null;
                    $dealer_tab->user_id = auth()->id();
                    $dealer_tab->save();
                }
            }
        }

        //$parent_news_id = ParentMenu::where('slug','=','atc-catalog')->first();

        //$sub_news_id = SubMenu::where('parent_menu_id','=',$parent_news_id->id)->where('constant','=','news')->whereNull('deleted_at')->first();

        if (isset($request->tab_section)) {
            // $request->merge(['active' => $request->has('active')]);
            // $request->merge(['slug' => Str::slug($request->name)]);                  
            // $request->merge(['dealer_from_date' => $dealer_from_Date]);
            // $request->merge(['dealer_to_date' => $dealer_to_Date]);                   
            // $request->merge(['body' => $request->body]);
            // $request->merge(['tab_section' => $request->has('tab_section')]);

            // $dealer->update($request->all());

            //     // dd($request->tab_title);
            //     foreach ($request->tab_title as $key => $value) {

            //     if (is_array($value)){
            //         foreach ($value as $tab_key => $tab_value) {

            //             DealerTab::where('id', $key)->update(['tab_title' => $tab_value,'tab_image'=>$request->tab_image[$key][$tab_key],'tab_body' => $request->tab_body[$key][$tab_key] ]);
            //         }
            //     }
            //     else
            //     {
            //         $dealer_tab = new DealerTab();
            //         $dealer_tab->dealer_id = $dealer->id;
            //         $dealer_tab->tab_title = $request->tab_title[$key];
            //         $dealer_tab->tab_image = $request->tab_image[$key];
            //         $dealer_tab->tab_body = $request->tab_body[$key];
            //         $dealer_tab->user_id = auth()->id();
            //         $dealer_tab->save();
            //     }
            // }
        } else {
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['is_verified' => $request->has('is_verified')]);
            $request->merge(['slug' => Str::slug($request->name)]);
            $request->merge(['dealer_from_date' => $dealer_from_Date]);
            $request->merge(['dealer_to_date' => $dealer_to_Date]);
            $request->merge(['tab_section' => 'N']);

            $dealer->update($request->all());
        }

        $result = 'success';

        if ($result == 'success') {
            return redirect(route('dealers.index'))->with('Dealer-ok', __('The Dealer has been successfully updated'));
        } else {
            return redirect(route('dealers.index'))->with('Dealer-danger', __('The Dealer already exist. Cannot update'));
        }
    }

    /**
     * Remove the Dealer from storage.
     *
     * @param Dealer $dealer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dealer $dealer)
    {
        // $this->authorize('manage', $dealer);

        //dd($dealer);

        $dealer->delete();

        DealerTab::where('dealer_id', $dealer->id)->delete();

        return response()->json();
    }

    public function deleteDealerTabSection(Request $request)
    {
        //dd($request->all());
        //$content = DealerTab::where('id',$request->id)->first();

        DealerTab::where('id',   $request->id)->delete();

        return 'true';
    }

    public function removeGalleryPhoto(Request $request)
    {
        // dd($request->all());
        //return false;
        $dealer_content = Dealer::find($request->id);
        $updates_file_names = str_replace($request->filename, '', $dealer_content->dealer_gallery);
        $dealer_content->dealer_gallery = $updates_file_names;
        $dealer_content->save();
        return $updates_file_names;
    }
}
