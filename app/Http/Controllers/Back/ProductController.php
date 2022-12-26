<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\{
    Http\Controllers\Controller,
    Models\Category,
    Models\Product,
    Models\ParentMenu,
    Models\SubMenu,
    Models\ChildMenu,
    Models\SubChildMenu,
    Models\ChooseNo,
    Models\ProductTab,
    Models\ProductLogin,

    Repositories\ProductRepository
};
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Hash;

class ProductController extends Controller
{
    use Indexable;

    /**
     * Create a new ProductController instance.
     *
     * @param  \App\Repositories\ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'products';
    }

    /**
     * Update "new" field for Product.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Product $product)
    {
        $product->ingoing->delete();

        return response()->json();
    }

    /**
     * Update "active" field for Product.
     *
     * @param  \App\Models\Product $product
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Product $product, $status = false)
    {
        $product->active = $status;
        $product->save();

        return response()->json();
    }

    /**
     * Show the form for creating a new Product.
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
        $actual_product_from_date = null;
        $actual_product_to_date = null;
        $product_tabs = null;
        $title1 = null;
        $title2 = null;
        $selected_gallery_images = null;

        $actual_brochure = 'N';

        return view('back.products.create', compact('actual_parent_slug', 'actual_sub_slug', 'parent_menus', 'actual_parent_menu', 'actual_sub_menu', 'actual_child_menu', 'actual_sub_child_menu', 'actual_product_from_date', 'product_tabs', 'actual_product_to_date', 'actual_brochure', 'categories', 'actual_category', 'title1', 'title2', 'selected_gallery_images'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        //    $result = $this->repository->store($request);
         $record_exist = Product::where('name', $request->name)->first();
        // dd($record_exist);
        if($record_exist) {
            $result = 'failure';
         } else {
            if (!empty($request->product_from_date) && !empty($request->product_to_date)) {
                $product_from_Date = Carbon::createFromFormat('d/m/Y', $request->product_from_date)->format('Y-m-d');
                $product_to_Date = Carbon::createFromFormat('d/m/Y', $request->product_to_date)->format('Y-m-d');

                $range = CarbonPeriod::create($product_from_Date, $product_to_Date);

                $dates = $range->toArray();
            } else {
                $product_from_Date = null;
                $product_to_Date = null;
                $dates = null;
            }

            if (isset($request->gallery_images)) {
                $filepath = "storage/files/product_gallery";
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
            $request->merge(['product_gallery' => $gallery_images]);

            if ($dates) {
                $request->merge(['user_id' => auth()->id()]);
                $request->merge(['active' => $request->has('active')]);
                $request->merge(['slug' => Str::slug($request->name)]);
                $request->merge(['product_from_date' => $product_from_Date]);
                $request->merge(['product_to_date' => $product_to_Date]);
                $request->merge(['body' => $request->body]);
                $request->merge(['tab_section' => 'N']);
                $product = Product::create($request->all());

                foreach ($dates as $key => $value) {
                    $product_tab = new ProductTab();
                    $product_tab->product_id = $product->id;
                    $product_tab->tab_title = $value->format('d/m/Y');
                    $product_tab->tab_image = null;
                    $product_tab->tab_body = null;
                    $product_tab->user_id = auth()->id();
                    $product_tab->save();
                }
            }

            if (isset($request->tab_section)) {
                // $request->merge(['user_id' => auth()->id()]);
                // $request->merge(['active' => $request->has('active')]);
                // $request->merge(['slug' => Str::slug($request->name)]);           
                // $request->merge(['product_from_date' => $product_from_Date]);
                // $request->merge(['product_to_date' => $product_to_Date]);
                // $request->merge(['body' => $request->body]);
                // $request->merge(['tab_section' => $request->has('tab_section')]);
                // $product = Product::create($request->all());

                // foreach ($request->tab_title as $key => $value) {

                //     $product_tab = new ProductTab();
                //     $product_tab->product_id = $product->id;
                //     $product_tab->tab_title = $request->tab_title[$key];
                //     $product_tab->tab_image = $request->tab_image[$key];
                //     $product_tab->tab_body = $request->tab_body[$key];
                //     $product_tab->user_id = auth()->id();
                //     $product_tab->save();
                // }
            } else {
                $request->merge(['user_id' => auth()->id()]);
                $request->merge(['active' => $request->has('active')]);
                $request->merge(['slug' => Str::slug($request->name)]);
            
                $request->merge(['tab_section' => 'N']);

                $product = Product::create($request->all());
            }

            $result = 'success';
        }

        if ($result == 'success') {
            return redirect(route('products.index'))->with('post-ok', __('The Product has been successfully created'));
        } else {
            return redirect(route('products.index'))->with('post-danger', __('The Product already exist'));
        }
    }


    /**
     * Display the Product.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('back.products.index', compact('product'));
    }

    /**
     * 
     * Show the form for editing the Product.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        // dd($product);
        // $this->authorize('manage', $product);

        $categories = Category::all()->pluck('title', 'id');

        $parent_menus = ParentMenu::where('status', 'Active')->where('post_entry', 'Y')->pluck('name', 'id')->prepend('--Select--', '');

        $actual_parent_slug = @$product->mainMenu->slug;

        $actual_sub_slug = @$product->subMenu->slug;

        $actual_parent_menu = $product->parent_menu_id;

        $actual_category = $product->category_id;

        $actual_sub_menu = $product->sub_menu_id;

        $actual_child_menu = $product->child_menu_id;

        $actual_sub_child_menu = $product->sub_child_menu_id;

        if (!empty($product->product_from_date) && !empty($product->product_to_date)) {

            $actual_product_from_date = $product->product_from_date->format('d/m/Y');
            $actual_product_to_date = $product->product_to_date->format('d/m/Y');
        } else {
            $actual_product_from_date = null;
            $actual_product_to_date = null;
        }

        if ($product->tab_section == 'Y') {
            $product_tabs = ProductTab::where('product_id', '=', $product->id)->get();
            $tab_id = $product_tabs->pluck('id');
        } else {
            $product_tabs = null;
            $tab_id = null;
        }

        $actual_brochure = null;

        $title1 = null;
        $title2 = null;

        $selected_gallery_images = array_values(array_filter(explode(',', $product->product_gallery)));

        // $product_login = ProductLogin::where('product_id', '=', $product->id)->first();

        //    dd($product_login);
        return view('back.products.edit', compact('product', 'parent_menus', 'actual_parent_slug', 'actual_sub_slug', 'actual_parent_menu', 'actual_sub_menu', 'actual_child_menu', 'actual_sub_child_menu', 'actual_product_from_date', 'actual_product_to_date', 'product_tabs', 'tab_id', 'actual_brochure', 'categories', 'actual_category', 'title1', 'title2', 'selected_gallery_images'));
    }

    /**
     * Update the Product in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        // $this->authorize('manage', $product);

        // $result = $this->repository->update($product, $request);

        if (!empty($request->product_from_date) && !empty($request->product_to_date)) {
            $product_from_Date = Carbon::createFromFormat('d/m/Y', $request->product_from_date)->format('Y-m-d');
            $product_to_Date = Carbon::createFromFormat('d/m/Y', $request->product_to_date)->format('Y-m-d');

            $range = CarbonPeriod::create($product_from_Date, $product_to_Date);

            $dates = $range->toArray();
        } else {
            $product_from_Date = null;
            $product_to_Date = null;
            $dates = null;
        }

        if ($request->hasFile('gallery_images')) {
            $filepath = "storage/files/product_gallery";
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

        $gallery_images = ($product->gallery_images != NULL) ? $product->gallery_images . ',/' . $gallery_image_name : $gallery_image_name;

        //  dd($gallery_images);
        // $request->gallery_images = $gallery_images;
        $request->merge(['product_gallery' => $gallery_images]);

        if ($dates) {
            foreach ($dates as $key => $value) {
                $product_tab = ProductTab::where('product_id', $product->id)->where('tab_title', $value->format('d/m/Y'))->first();
                if (!$product_tab) {
                    $product_tab = new ProductTab();
                    $product_tab->product_id = $product->id;
                    $product_tab->tab_title = $value->format('d/m/Y');
                    $product_tab->tab_image = null;
                    $product_tab->tab_body = null;
                    $product_tab->user_id = auth()->id();
                    $product_tab->save();
                }
            }
        }

        //$parent_news_id = ParentMenu::where('slug','=','atc-catalog')->first();

        //$sub_news_id = SubMenu::where('parent_menu_id','=',$parent_news_id->id)->where('constant','=','news')->whereNull('deleted_at')->first();

        if (isset($request->tab_section)) {
            // $request->merge(['active' => $request->has('active')]);
            // $request->merge(['slug' => Str::slug($request->name)]);                  
            // $request->merge(['product_from_date' => $product_from_Date]);
            // $request->merge(['product_to_date' => $product_to_Date]);                   
            // $request->merge(['body' => $request->body]);
            // $request->merge(['tab_section' => $request->has('tab_section')]);

            // $product->update($request->all());

            //     // dd($request->tab_title);
            //     foreach ($request->tab_title as $key => $value) {

            //     if (is_array($value)){
            //         foreach ($value as $tab_key => $tab_value) {

            //             ProductTab::where('id', $key)->update(['tab_title' => $tab_value,'tab_image'=>$request->tab_image[$key][$tab_key],'tab_body' => $request->tab_body[$key][$tab_key] ]);
            //         }
            //     }
            //     else
            //     {
            //         $product_tab = new ProductTab();
            //         $product_tab->product_id = $product->id;
            //         $product_tab->tab_title = $request->tab_title[$key];
            //         $product_tab->tab_image = $request->tab_image[$key];
            //         $product_tab->tab_body = $request->tab_body[$key];
            //         $product_tab->user_id = auth()->id();
            //         $product_tab->save();
            //     }
            // }
        } else {
            $request->merge(['active' => $request->has('active')]);
            $request->merge(['slug' => Str::slug($request->name)]);
            $request->merge(['product_from_date' => $product_from_Date]);
            $request->merge(['product_to_date' => $product_to_Date]);
            $request->merge(['tab_section' => 'N']);

            $product->update($request->all());
        }

        $result = 'success';

        if ($result == 'success') {
            return redirect(route('products.index'))->with('post-ok', __('The Product has been successfully updated'));
        } else {
            return redirect(route('products.index'))->with('post-danger', __('The Product already exist. Cannot update'));
        }
    }

    /**
     * Remove the Product from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('manage', $product);

        //dd($id);

        $product = Product::where('id', $id)->delete();

        //ProductTab::where('product_id', $product->id)->delete();

        // return response()->json();
	return redirect(route('products.index'))->with('post-ok', __('The Product deleted successfully'));
    }

    public function deleteProductTabSection(Request $request)
    {
        //dd($request->all());
        //$content = ProductTab::where('id',$request->id)->first();

        ProductTab::where('id',   $request->id)->delete();

        return 'true';
    }

    public function removeGalleryPhoto(Request $request)
    {
        // dd($request->all());
        //return false;
        $product_content = Product::find($request->id);
        $updates_file_names = str_replace($request->filename, '', $product_content->product_gallery);
        $product_content->product_gallery = $updates_file_names;
        $product_content->save();
        return $updates_file_names;
    }
}
