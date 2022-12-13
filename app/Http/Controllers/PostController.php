<?php

namespace App\Http\Controllers;

use App;
use App\{
  Http\Controllers\Controller,
  Repositories\PostRepository,
  Models\Tag,
  Models\Category,
  Models\ParentMenu,
  Models\Slider,
  Models\ChooseNo,
  Models\MediaAlbum,
  Models\MediaAlbumContent,
  Models\Post,
  Models\DownloadProspect,
  Models\SubMenu,
  Models\ChildMenu,
  Models\SubChildMenu,
  Models\PostTab,

  Models\PostLinkPage,
  Models\PostLinkPageTab,
  Models\GraduationRegister,
  Models\ApplicationRegister,
  Models\UploadedResume,
  Models\Career,
  Models\Address,
  Models\Testimonial,
  Models\Feature,
  Models\AcademicYear,
  Models\Placement,
  Models\GalleryTab,
  Models\RazorPaymentCredential,
  Models\RazorPaymentTransactionLog
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Validator;
use URL;
use Mail;
use Carbon\Carbon;
use Hash;
use Session;
use Excel;
use DataTables;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Redirect;


class PostController extends Controller
{
  /**
   * The PostRepository instance.
   *
   * @var \App\Repositories\PostRepository
   */
  protected $postRepository;

  /**
   * The pagination number.
   *
   * @var int
   */
  protected $nbrPages;

  /**
   * Create a new PostController instance.
   *
   * @param  \App\Repositories\PostRepository $postRepository
   * @return void
   */
  public function __construct()
  {

    // $this->postRepository = $postRepository;
    $this->nbrPages = config('app.nbrPages.front.posts');
    $parent_menu = ParentMenu::orderBy('hierarchy', 'ASC')->get();
    $sub_menu = SubMenu::orderBy('hierarchy', 'ASC')->get();
    $child_menu = ChildMenu::orderBy('hierarchy', 'ASC')->get();
    $address = Address::first();
    $about_menu_id = ParentMenu::select('id')->where('slug', '=', 'about-us')->first();
    $about_content = Post::where('parent_menu_id', '=', @$about_menu_id->id)->first();

    View::share('parent_menu', $parent_menu);

    View::share('child_menu', $child_menu);

    View::share('address', $address);

    View::share('about_content', $about_content);

    View::share('current_route', Route::currentRouteName());

    View::share('route_path', \Request::path());
  }

  /**
   * Display a listing of the posts.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $home = Route::currentRouteName();

    $sliders = Slider::where('active', '=', 1)->orderBy('hierarchy', 'asc')->whereNull('deleted_at')->limit(10)->get();

    $dynamic_contents = Post::where('active', '=', 1)->whereNull('deleted_at')->get();

    $sub_menu = SubMenu::orderBy('hierarchy', 'ASC')->get();

    $news_menu_id = SubMenu::select('id', 'name', 'slug')->where('slug', '=', 'blogs')->first();

    $recent_news = Post::where('sub_menu_id', '=', @$news_menu_id->id)->orderBy('event_date', 'desc')->whereNull('deleted_at')->paginate(3);

    $service_menu_id = ParentMenu::select('id')->where('slug', '=', 'services')->first();
    $product_menu_id = ParentMenu::select('id')->where('slug', '=', 'products')->first();

    // $services = Post::where('parent_menu_id','=',@$service_menu_id->id)->get();

    $services = Post::join('sub_menus', function ($sub_menus) {
      $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
    })->select('posts.*')->where('posts.parent_menu_id', '=', @$service_menu_id->id)->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();

    $products = Post::join('sub_menus', function ($sub_menus) {
      $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
    })->select('posts.*')->where('posts.parent_menu_id', '=', @$product_menu_id->id)->whereNull('child_menu_id')->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();

    $albums = MediaAlbum::where('category', '=', 'TOUR')->limit(6)->get();

    $media_album_id = MediaAlbum::select('id')->where('category', '=', 'PLACEMENTS')->first();

    $all_images = MediaAlbumContent::join('media_albums', 'media_albums.id', '=', 'media_album_contents.media_album_id')->where('media_album_id', '!=', @$media_album_id->id)->get();

    $all_media_images = [];

    foreach ($all_images as $key => $value) {

      $images = [];

      $all_image = explode(",", @$value->filename);

      $all_image = array_filter($all_image);

      $all_image = array_values($all_image);

      array_push($images, ['slug' => $value->slug, 'images' => $all_image]);

      array_push($all_media_images, $images);
    }

    $campus_images = MediaAlbumContent::where('media_album_id', '=', @$media_album_id->id)->first();

    $clients = explode(",", @$campus_images->filename);

    // $clients = array_reverse($clients);

    $clients = array_filter($clients);

    $clients = array_values($clients);

    // dd(@$services);

    return view('front.index', compact('home', 'dynamic_contents', 'sub_menu', 'albums', 'all_media_images', 'sliders',  'recent_news',  'clients', 'services', 'products'));
  }


  public function getDynamicContent($parent_slug = null, $sub_slug = null, $child_slug = null, $sub_child_slug = null)
  {
    try {
      if ($parent_slug == 'service') {
        $parent_menu_id = ParentMenu::where('slug', '=', $parent_slug)->first();

        if ($parent_menu_id != null) {
          $contents = Post::join('sub_menus', function ($sub_menus) {
            $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
          })->select('posts.*')->where('posts.parent_menu_id', '=', $parent_menu_id->id)->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();
        }

        $content_type = "dynamic";

        return view('front.dynamic-content', compact('contents', 'parent_menu_id'));
      } else {
        if ($sub_slug == null) {

          $parent_menu_id = ParentMenu::where('slug', '=', $parent_slug)->first();


          if ($parent_menu_id != null) {

            $dynamic_contents = Post::where('parent_menu_id', $parent_menu_id->id)->first();
          } else {

            $dynamic_contents = PostLinkPage::where('slug', $parent_slug)->first();

            if (is_null($dynamic_contents)) {
              return redirect('errorpage');
            }

            if (@$dynamic_contents->tab_section == 'Y') {
              $post_tabs = PostLinkPageTab::where('post_link_page_id', '=', @$dynamic_contents->id)->get();
            } else {
              $post_tabs = null;
            }


            return view('front.link-page', compact('dynamic_contents', 'post_tabs'));
          }
        } else {

          if ($child_slug == null) {

            $sub_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

              $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
            })->select('sub_menus.id as id', 'sub_menus.parent_menu_id as parent_menu_id', 'sub_menus.name as name')->where('parent_menus.slug', '=', $parent_slug)->where('sub_menus.slug', '=', $sub_slug)->first();

            $dynamic_contents = Post::where('parent_menu_id', $sub_menu_id->parent_menu_id)->where('sub_menu_id', $sub_menu_id->id)->whereNull('child_menu_id')->first();

            // dd($sub_menu_id);
            // if( $sub_menu_id != null)
            // {

            //     $dynamic_contents = Post::where('sub_menu_id', $sub_menu_id->id)->first();

            // }
          } else {
            if ($sub_child_slug == null) {
              $parent_menu_id = ParentMenu::where('slug', '=', $parent_slug)->first();

              $sub_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

                $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
              })->select('sub_menus.name as name', 'sub_menus.slug as slug', 'sub_menus.id as id')->where('parent_menus.slug', '=', $parent_slug)->where('sub_menus.slug', '=', $sub_slug)->first();

              $child_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

                $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
              })->join('child_menus', function ($child_menus) {

                $child_menus->on('child_menus.sub_menu_id', '=', 'sub_menus.id');
              })->select('child_menus.id as id', 'child_menus.sub_menu_id as sub_menu_id', 'sub_menus.parent_menu_id as parent_menu_id', 'child_menus.name as name')->where('sub_menus.slug', '=', $sub_slug)->where('child_menus.slug', '=', $child_slug)->first();


              $dynamic_contents = Post::where('parent_menu_id', $child_menu_id->parent_menu_id)->where('sub_menu_id', $child_menu_id->sub_menu_id)->where('child_menu_id', $child_menu_id->id)->first();

              // dd($sub_menu_id);

              return view('front.dynamic-content', compact('dynamic_contents', 'child_menu_id', 'parent_menu_id', 'sub_menu_id'));
            } else {
              $parent_menu_id = ParentMenu::where('slug', '=', $parent_slug)->first();

              $sub_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

                $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
              })->select('sub_menus.name as name', 'sub_menus.slug as slug', 'sub_menus.id as id')->where('parent_menus.slug', '=', $parent_slug)->where('sub_menus.slug', '=', $sub_slug)->first();

              $child_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

                $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
              })->join('child_menus', function ($child_menus) {

                $child_menus->on('child_menus.sub_menu_id', '=', 'sub_menus.id');
              })->select('child_menus.id as id', 'child_menus.name as name', 'child_menus.slug as slug')->where('sub_menus.slug', '=', $sub_slug)->where('child_menus.slug', '=', $child_slug)->first();

              $sub_child_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

                $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
              })->join('child_menus', function ($child_menus) {

                $child_menus->on('child_menus.sub_menu_id', '=', 'sub_menus.id');
              })->join('sub_child_menus', function ($sub_child_menus) {
                $sub_child_menus->on('sub_child_menus.child_menu_id', '=', 'child_menus.id');
              })
                ->select('sub_child_menus.id as id', 'sub_child_menus.child_menu_id as child_menu_id', 'child_menus.sub_menu_id as sub_menu_id', 'sub_menus.parent_menu_id as parent_menu_id', 'sub_child_menus.name as name')->where('sub_menus.slug', '=', $sub_slug)->where('child_menus.slug', '=', $child_slug)->where('sub_child_menus.slug', '=', $sub_child_slug)->first();


              $dynamic_contents = Post::where('parent_menu_id', $sub_child_menu_id->parent_menu_id)->where('sub_menu_id', $sub_child_menu_id->sub_menu_id)->where('child_menu_id', $sub_child_menu_id->child_menu_id)->where('sub_child_menu_id', $sub_child_menu_id->id)->first();

              // dd($sub_menu_id);

              return view('front.dynamic-content', compact('dynamic_contents', 'sub_child_menu_id', 'child_menu_id', 'parent_menu_id', 'sub_menu_id'));
            }
          }
        }
      }

      $parent_menu_id = ParentMenu::where('slug', '=', $parent_slug)->first();

      $sub_menu = SubMenu::all();

      if ($sub_slug != null) {
        if ($child_slug != null) {

          if ($sub_child_slug != null) {
            $sub_child_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

              $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
            })->join('child_menus', function ($child_menus) {

              $child_menus->on('child_menus.sub_menu_id', '=', 'sub_menus.id');
            })->join('sub_child_menus', function ($sub_child_menus) {
              $sub_child_menus->on('sub_child_menus.child_menu_id', '=', 'child_menus.id');
            })
              ->select('sub_child_menus.id as id', 'sub_child_menus.name as name')->where('sub_menus.slug', '=', $sub_slug)->where('child_menus.slug', '=', $child_slug)->where('sub_child_menus.slug', '=', $sub_child_slug)->first();
          } else {

            $child_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

              $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
            })->join('child_menus', function ($child_menus) {

              $child_menus->on('child_menus.sub_menu_id', '=', 'sub_menus.id');
            })->select('child_menus.id as id', 'child_menus.name as child_menu')->where('sub_menus.slug', '=', $sub_slug)->where('child_menus.slug', '=', $child_slug)->first();

            $sub_child_menu_id = null;
          }
        } else {
          $sub_menu_id = ParentMenu::join('sub_menus', function ($sub_menus) {

            $sub_menus->on('sub_menus.parent_menu_id', '=', 'parent_menus.id');
          })->select('sub_menus.name as name', 'sub_menus.slug as slug', 'sub_menus.id as id')->where('parent_menus.slug', '=', $parent_slug)->where('sub_menus.slug', '=', $sub_slug)->first();

          $child_menu_id = null;
          $sub_child_menu_id = null;
        }
      } else {
        $sub_menu_id = null;
        $child_menu_id = null;
        $sub_child_menu_id = null;
      }

      $content_type = "dynamic";

      $team_details = FacultyDetail::get();

      $team_tabs = FacultyTab::get();

      $prospects = DownloadProspect::all();

      $counts = ChooseNo::all();

      $gallery = GalleryTab::where('post_id', @$dynamic_contents->id)->get();

      if (@$dynamic_contents->tab_section == 'Y') {
        $post_tabs = PostTab::where('post_id', '=', @$dynamic_contents->id)->get();
      } else {
        $post_tabs = null;
      }

      if ($parent_menu_id != null) {
        $side_bar_menu =  $parent_menu_id->submenus;
      } else {
        $side_bar_menu =  null;
      }

      $content_list = Post::where('parent_menu_id', '=', $parent_menu_id->id)->orderBy('title')->get();

      $service_menu_id = ParentMenu::select('id')->where('slug', '=', 'services')->first();
      $product_menu_id = ParentMenu::select('id')->where('slug', '=', 'products')->first();

      // $services = Post::where('parent_menu_id','=',@$service_menu_id->id)->get();

      $services = Post::join('sub_menus', function ($sub_menus) {
        $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
      })->select('posts.*')->where('posts.parent_menu_id', '=', @$service_menu_id->id)->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();

      $products = Post::join('sub_menus', function ($sub_menus) {
        $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
      })->select('posts.*')->where('posts.parent_menu_id', '=', @$product_menu_id->id)->whereNull('child_menu_id')->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();

      $product_list = Post::join('sub_menus', function ($sub_menus) {
        $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
      })->select('posts.*')->where('posts.parent_menu_id', '=', @$parent_menu_id->id)->where('posts.sub_menu_id', '=', @$sub_menu_id->id)->whereNotNull('child_menu_id')->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();


      $news_menu_id = SubMenu::select('id', 'name', 'slug')->where('slug', '=', 'blogs')->first();

      $recent_news = Post::where('sub_menu_id', '=', @$news_menu_id->id)->orderBy('event_date', 'desc')->whereNull('deleted_at')->paginate(3);


      // dd($gallery);

      return view('front.dynamic-content', compact('dynamic_contents', 'parent_menu_id', 'content_type', 'sub_menu_id', 'child_menu_id', 'sub_menu', 'side_bar_menu', 'team_details', 'team_tabs', 'prospects', 'post_tabs', 'counts', 'content_list', 'gallery', 'product_list', 'products', 'services', 'recent_news'));
    } catch (\Exception $e) {
      return redirect('errorpage');
    }
  }

  // News and Events

  public function getAllNews()
  {
    $slug = Route::currentRouteName();

    $sub_menu_id = SubMenu::select('id', 'name', 'slug')->where('slug', '=', $slug)->first();

    $recent_news = Post::where('sub_menu_id', '=', @$sub_menu_id->id)->orderBy('event_date', 'desc')->whereNull('deleted_at')->paginate(3);

    return view('front.all-news', compact('recent_news', 'sub_menu_id'));
  }

  public function getNewsInDetail($news_slug = null)
  {
    $dynamic_content = Post::where('slug', $news_slug)->first();

    $sub_menu_id = SubMenu::select('id', 'name', 'slug')->where('id', '=', $dynamic_content->sub_menu_id)->first();

    $recent_news = Post::where('sub_menu_id', '=', $sub_menu_id->id)->orderBy('event_date', 'desc')->get();

    $categories = Category::join('posts', function ($posts) {
      $posts->on('posts.category_id', '=', 'categories.id');
    })->select('categories.id as id', 'categories.title as title')
      ->where('posts.sub_menu_id', $sub_menu_id->id)->whereNull('deleted_at')
      ->pluck('title', 'id');

    return view('front.news-in-detail', compact('dynamic_content', 'recent_news', 'sub_menu_id', 'categories'));
  }

  public function getAllNewsFilter($category_id = null)
  {

    $sub_menu_id = SubMenu::select('id', 'name', 'slug')->where('slug', '=', 'blogs')->first();

    $recent_news = Post::where('sub_menu_id', '=', $sub_menu_id->id)->where('category_id', '=', $category_id)->orderBy('event_date', 'desc')->whereNull('deleted_at')->paginate(3);

    $latest_news = Post::where('sub_menu_id', '=', $sub_menu_id->id)->where('category_id', '=', $category_id)->orderBy('event_date', 'desc')->whereNull('deleted_at')->limit(8)->get();

    $categories = Category::join('posts', function ($posts) {
      $posts->on('posts.category_id', '=', 'categories.id');
    })->select('categories.id as id', 'categories.title as title')
      ->where('posts.sub_menu_id', $sub_menu_id->id)->whereNull('deleted_at')
      ->pluck('title', 'id');

    return view('front.all-news', compact('recent_news', 'latest_news', 'sub_menu_id', 'categories'));
  }

  public function getCaseInDetail($slug = null)
  {
    $dynamic_content = Post::where('slug', $slug)->first();

    $sub_menu_id = SubMenu::select('id', 'name', 'slug')->where('id', '=', $dynamic_content->sub_menu_id)->first();

    $recent_news = Post::where('sub_menu_id', '=', $sub_menu_id->id)->orderBy('created_at', 'desc')->get();

    return view('front.case-in-detail', compact('dynamic_content', 'recent_news', 'sub_menu_id'));
  }

  // Course Details

  public function getServiceDetail($parent_menu = null)
  {
    // dd($parent_menu);

    $parent_menu_id = ParentMenu::select('slug', 'id', 'name')->where('slug', 'services')->first();

    $services = Post::join('sub_menus', function ($sub_menus) {
      $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
    })->select('posts.*')->where('posts.parent_menu_id', '=', @$parent_menu_id->id)->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();


    return view('front.service-detail', compact('parent_menu_id', 'services'));
  }

  public function getProductDetail($parent_menu = null)
  {
    // dd($parent_menu);

    $parent_menu_id = ParentMenu::select('slug', 'id', 'name')->where('slug', 'products')->first();

    $services = Post::join('sub_menus', function ($sub_menus) {
      $sub_menus->on('sub_menus.id', 'posts.sub_menu_id');
    })->select('posts.*')->where('posts.parent_menu_id', '=', @$parent_menu_id->id)->whereNull('child_menu_id')->orderBy('sub_menus.hierarchy')->orderBy('sub_menus.hierarchy')->whereNull('posts.deleted_at')->get();


    return view('front.service-detail', compact('parent_menu_id', 'services'));
  }

  // Faculty Details

  public function getFaculty()
  {
    $course_menu_id = SubMenu::select('id')->where('slug', '=', 'courses')->first();

    $courses = Post::where('parent_menu_id', '=', @$course_menu_id->id)->orderBy('sub_menu_id')->orderBy('title')->get();

    $team_detail = FacultyDetail::join('link_faculties', function ($link_faculties) {
      $link_faculties->on('link_faculties.faculty_id', '=', 'faculty_details.id');
    })->join('posts', function ($posts) {
      $posts->on('posts.id', 'link_faculties.post_id');
    })->select('faculty_details.*', 'posts.sub_menu_id')->where('faculty_details.type', 'faculty')->whereNull('faculty_details.deleted_at')->whereNull('link_faculties.deleted_at')->orderBy('faculty_details.appointment', 'desc')->orderBY('posts.id')->get();

    return view('front.faculty-list', compact('team_detail', 'courses'));
  }

  public function getTeamDetails($team_slug = null)
  {
    $team_detail = FacultyDetail::where('slug', $team_slug)->first();

    $schedules = FacultySchedule::where('faculty_id', $team_detail->id)->get();

    $department_id = LinkFaculty::where('faculty_id', $team_detail->id)->first();

    $department = Post::where('id', $department_id->post_id)->first();

    return view('front.faculty-detail', compact('team_detail', 'department', 'schedules'));
  }

  public function getFacilityDetail($sub_slug = null)
  {
    // dd($child_slug);

    $parent_menu_id = ParentMenu::select('slug', 'id')->where('slug', 'facilities')->first();

    $dynamic_contents = Post::where('slug', $sub_slug)->first();

    $sub_menu_id = SubMenu::select('slug', 'id')->where('id', $dynamic_contents->sub_menu_id)->first();

    $facilities = Post::where('parent_menu_id', '=', $parent_menu_id->id)->orderBy('id', 'asc')->where('title', '!=', @$dynamic_contents->title)->whereNotNull('sub_menu_id')->get();

    $dept_address = Address::where('post_id', $dynamic_contents->id)->first();

    if (@$dynamic_contents->tab_section == 'Y') {
      $post_tabs = PostTab::where('post_id', '=', @$dynamic_contents->id)->get();
    } else {
      $post_tabs = null;
    }

    $gallery = GalleryTab::where('post_id', @$dynamic_contents->id)->get();

    $prospect = DownloadProspect::where('post_id', @$dynamic_contents->id)->first();

    // dd($gallery);
    // dd($dynamic_contents);
    // dd($dynamic_contents->LinkFaculty[0]->facultyDetails);
    return view('front.facility-detail', compact('dynamic_contents', 'facilities', 'sub_menu_id', 'post_tabs', 'gallery', 'prospect', 'dept_address'));
  }

  // Testimonial

  public function testimonial()
  {
    $parent_menu_id = ParentMenu::select('id', 'name', 'slug')->where('slug', '=', 'testimonials')->first();

    $testimonial = Testimonial::paginate(4);

    return view('front.testmonials', compact('testimonial', 'parent_menu_id'));
  }

  public function getTestimonial(Request $request)
  {
    // dd($request->input('text'));
    $testimonial = Testimonial::where('title', 'LIKE', '%' . $request->input('text') . '%')->get();

    return response()->json($testimonial);
  }

  public function getTestimonialDetail($slug = null)
  {
    $testimonial = Testimonial::where('slug', $slug)->first();
    return view('front.testimonial-indetail', compact('testimonial'));
  }

  // Contact Us

  public function contactUs()
  {
    $address_list = Address::get();

    // dd($address);

    return view('front.contact-us', compact('address_list'));
  }


  public function getQuote($id = null)
  {
    $package = '';
    $timings = '';

    $address_list = Address::get();

    return view('front.get-quote', compact('address_list', 'package', 'timings'));
  }


  public function postContact(Request $request)
  {
    // dd($request->all());

    $this->validate($request, [
      'g-recaptcha-response' => 'required|captcha',
    ]);

    $prev_route = basename(url()->previous());

    if ($prev_route == 'contact-us') {

      $data = array('name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'subject' => $request->subject, 'city' => @$request->city, 'country' => @$request->country, 'message_content' => @$request->message);

      Mail::send('front.mail-send', $data, function ($details) use ($data) {
        $details->to('info@falcontrackers.com')->from($data['email'], $data['name'])->replyTo($data['email'], $data['name'])->subject('Enquiry Details');
      });

      Mail::send('front.mail-reply', $data, function ($details) use ($data) {
        // dd($details);
        $details->to($data['email'])->from('info@falcontrackers.com', 'Sales App')->subject('Sales App - Thank you');
      });

      return redirect()->back()->with('success', 'Thank you for contacting Sales App. Our relationship with you will be smooth and productive, and it will be an honor to serve you.<br/>We have recorded your inquiry in our CRM. While our representative contacts you soon, explore our resources to learn more about Fleet Management Solutions.');
    }
  }

  public function postCalculate(Request $request)
  {
    //   dd($request->all());

    $this->validate($request, [
      'g-recaptcha-response' => 'required|captcha',
    ]);

    $no_vehicle = $request->no_vehicle;
    $fuel_cost_month = $request->fuel_cost_month;
    $avg_hours = $request->avg_hours;
    $distance = $request->distance;
    $avg_salary = $request->avg_salary;

    $admin_input = DB::table('roi_creds')->first();

    // $OTI = 305;
    // $recurring_payment = 27;
    // $fuel_saving = 29.3;
    // $maintenance_saving = 5.1;
    // $labour_saving = 2.5;
    // $fuel_cost = 2.45;
    // $AMM = 0.075;
    // $TWD = 26;
    // $CO2E = 2.372;

    $TDS = ($admin_input->fuel_saving / 100) * $no_vehicle * ($distance * $admin_input->TWD);
    $mileage = ($distance * $admin_input->TWD) / ($fuel_cost_month / $admin_input->fuel_cost);
    $TFS = $TDS / $mileage;
    $TCO2E = ($admin_input->CO2E * $TFS) / 1000;
    $TCFS = $TFS * $admin_input->fuel_cost;

    $TMMC = ($distance * $admin_input->TWD) * $admin_input->AMM;
    $MCS = ($admin_input->maintenance_saving / 100) * $TMMC * $no_vehicle;

    $THS = ($admin_input->labour_saving / 100) * $no_vehicle * $avg_hours * $admin_input->TWD;
    $TVLS = $THS * ($avg_salary / ($admin_input->TWD * $avg_hours));

    $ADS_12 = $TDS * 12;
    $CO2ER_12 = $TCO2E * 12;
    $FROI_12 = ($TCFS * 12) / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 12));
    $MROI_12 = ($MCS * 12) / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 12));
    $AOHR_12 = $THS * 12;
    $LROI_12 = ($TVLS * 12) / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 12));
    $MBE = ($admin_input->OTI * $no_vehicle) / ((($TVLS + $MCS + $TCFS)) - ($admin_input->recurring_payment * $no_vehicle));
    $ATS_12 = ($TVLS + $MCS + $TCFS) * 12;
    $TROI_12 = $ATS_12 / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 12));

    $ADS_36 = $TDS * 36;
    $CO2ER_36 = $TCO2E * 36;
    $FROI_36 = ($TCFS * 36) / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 36));
    $MROI_36 = ($MCS * 36) / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 36));
    $AOHR_36 = $THS * 36;
    $LROI_36 = ($TVLS * 36) / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 36));
    $ATS_36 = ($TVLS + $MCS + $TCFS) * 36;
    $TROI_36 = $ATS_36 / (($admin_input->OTI * $no_vehicle) + ($admin_input->recurring_payment * $no_vehicle * 36));

    // dd($TVLS);
    $input = ['no_vehicle' => $no_vehicle, 'fuel_cost_month' => $fuel_cost_month, 'avg_hours' => $avg_hours, 'distance' => $distance, 'avg_salary' => $avg_salary];
    $calculate = ['TDS' => $TDS, 'mileage' => $mileage, 'TFS' => $TFS, 'TCO2E' => $TCO2E, 'TCFS' => $TCFS, 'TMMC' => $TMMC, 'MCS' => $MCS, 'THS' => $THS, 'TVLS' => $TVLS];
    $output = ['ADS_12' => $ADS_12, 'CO2ER_12' => $CO2ER_12, 'FROI_12' => $FROI_12, 'MROI_12' => $MROI_12, 'AOHR_12' => $AOHR_12, 'LROI_12' => $LROI_12, 'ATS_12' => $ATS_12, 'TROI_12' => $TROI_12, 'ADS_36' => $ADS_36, 'CO2ER_36' => $CO2ER_36, 'FROI_36' => $FROI_36, 'MROI_36' => $MROI_36, 'AOHR_36' => $AOHR_36, 'LROI_36' => $LROI_36, 'ATS_36' => $ATS_36, 'TROI_36' => $TROI_36, 'MBE' => $MBE];
    // dd($output);

    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView('front.saving-calculator', compact('input', 'admin_input', 'calculate', 'output'));
    $pdf->setPaper('a4', 'portrait');
    // return @$pdf->stream();
    $pdfFile = @$pdf->output();

    //     $view = view('front.saving-calculator', compact('input','admin_input','calculate','output'));
    //     $pdfFileName = 'savings-calculator.pdf';
    //     header('Content-type:application/pdf');
    //     header('Content-disposition: inline; filename="' . $pdfFileName . '"');
    //     $pdf = Browsershot::html($view->render())->format('A4')->noSandbox()->pdf();

    // echo $pdf;

    $data = array('name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'website' => $request->website, 'subject' => $request->subject, 'message_content' => @$request->message);

    Mail::send('front.saving-mail', $data, function ($details) use ($data, $pdfFile) {
      $details->to($data['email'])->bcc('info@falcontrackers.com')->from('info@falcontrackers.com', 'Sales App')->subject('Sales App - Savings Calculator')->attachData($pdfFile, 'saving-calculator.pdf');
    });

    return redirect()->back()->with('success', 'Thank you for contacting Sales App. <br/>Results of the Savings Calculator have been mailed to you. Please check your mail.');
  }

  public function postApplication(Request $request)
  {
    // dd($request->all());

    $appointment = GraduationRegister::create($request->all());

    $data = array('name' => $appointment->name, 'email' => $appointment->email, 'mobile' => $appointment->mobile, 'subject' => $appointment->subject, 'message_content' => $appointment->message);

    Mail::send('front.mail-send', $data, function ($details) use ($data) {
      $details->to($data['email'])->from('supportmlr@Sales App.com')->subject('Alumni Registration');
    });

    return back()->with('success', 'Thank You for Registration');
  }

  public function thankYou()
  {
    return view('front.thanks');
  }

  public function samplePayment()
  {
    $type = "pay-online";
    return view('front.payment', compact('type'));
  }

  public function samplePaymentPost(Request $request)
  {
    $this->validate($request, [
      'g-recaptcha-response' => 'required|captcha',
    ]);

    $amount = $request->amount;
    $email = $request->email;
    $firstName = $request->firstName;
    $lastName = $request->lastName;
    $address1 = $request->address1;
    $city = $request->city;
    $countryCode = $request->countryCode;
    // $apikey = "MTQ3ZjMxZTMtMmVjMy00ZGQwLTkxN2UtNzZjZjg4NzUxNGQ5OjRmYTUxMzc1LWEwMmUtNGE0ZS05NWVkLTJjOGI5ODM1NzQwZg==";     // enter your API key here - this is test-api-key
    $apikey = "MzU0YTM0ZDMtNzVlYS00MjdlLTllYmYtMmFmODczYjUxM2Y3OjA5YjFhNmZmLWE1MjYtNGJmYy1iYTU4LWYzNDc2YmU1YWUyZg==";     // Live API Key

    $outletRef   = "2cff2cb6-3f39-4fa1-bd6d-6939bf607e95"; // Live Outlet Reference

    //Live
    $idServiceURL = "https://identity.ngenius-payments.com/auth/realms/NetworkInternational/protocol/openid-connect/token";

    //Demo
    // $idServiceURL  = "https://identity-uat.ngenius-payments.com/auth/realms/ni/protocol/openid-connect/token";           // set the identity service URL (example only)

    //Live
    $txnServiceURL = "https://api-gateway.ngenius-payments.com/transactions/outlets/" . $outletRef . "/orders";

    //Demo
    // $txnServiceURL = "https://api-gateway-uat.ngenius-payments.com/transactions/outlets/".$outletRef."/orders";             // set the transaction service URL (example only)

    $tokenHeaders  = array("Authorization: Basic " . $apikey, "Content-Type: application/x-www-form-urlencoded");
    $tokenResponse = $this->invokeCurlRequest("POST", $idServiceURL, $tokenHeaders, http_build_query(array('grant_type' => 'client_credentials')));
    $tokenResponse = json_decode($tokenResponse);

    $access_token = $tokenResponse->access_token;

    $order = new \stdClass();

    $order->action = "PURCHASE";

    $order->amount = new \stdClass();
    $order->amount->currencyCode = ($request->currency) ? $request->currency : "AED";
    $order->amount->value = $amount * 100;

    $order->billingAddress = new \stdClass();
    $order->billingAddress->firstName = $firstName;
    $order->billingAddress->lastName = $lastName;
    $order->billingAddress->address1 = $address1;
    $order->billingAddress->city = $city;
    $order->billingAddress->countryCode = $countryCode;

    $token = $access_token;
    $order->language = "en";
    $order->merchantOrderReference = time();
    $order->emailAddress = $email;
    // $order->merchantAttributes['redirectUrl'] = "http:localhost/api/get-payment-response";
    $order = json_encode($order);
    $orderCreateHeaders  = array("Authorization: Bearer " . $access_token, "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");
    $orderCreateResponse = $this->invokeCurlRequest("POST", $txnServiceURL, $orderCreateHeaders, $order);

    $orderCreateResponse = json_decode($orderCreateResponse);

    if (isset($orderCreateResponse->message)) {
      if (@$orderCreateResponse->errors[0]->message != null) {
        $message = $orderCreateResponse->errors[0]->message;
      } else {
        $message = $orderCreateResponse->message;
      }
      return redirect()->back()->with('danger', $message);
    }

    $paymentLink           = $orderCreateResponse->_links->payment->href;     // the link to the payment page for redirection (either full-page redirect or iframe)
    $orderReference      = $orderCreateResponse->reference;              // the reference to the order, which you should store in your records for future interaction with this order

    if ($request->type == 'generate-link') {
      return redirect()->back()->with('success', 'Please note down the payment link - ' . $paymentLink);
    } else {
      return Redirect::to($paymentLink);
    }
  }

  public function generateSamplePaymentLink()
  {
    $type = "generate-link";
    return view('front.payment', compact('type'));
  }

  public function invokeCurlRequest($type, $url, $headers, $post)
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($type == "POST") {

      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    $server_output = curl_exec($ch);
    // print_r($server_output);
    // exit();
    curl_close($ch);

    return $server_output;
  }
}
