<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\{
    Http\Controllers\Controller,
    Models\Event,
    Models\EventLogin,
    Models\EventUser,
    Models\LinkUser,
    Models\EventTab,
    Models\GalleryTab,
    Models\FacultyDetail,
    Models\FacultyTab,
    Models\LinkFaculty,
    Models\Notification
};
use \App\Repositories\EventUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Validator;
use Carbon\Carbon;
use Hash;
use Session;

class APIController extends Controller
{
    /**
     * Create a new APIController instance.
     *
     * @param  \App\Repositories\PostRepository $postRepository
     * @return void
     */
    public function __construct()
    {
    }

    public function register(Request $request)
    {
        $exist = EventUser::where('email', @$request->email)->first();
        if ($exist) {
            return $this->create400Error([
                'message' => 'Already registered. Please login.',
                'status' => false
            ]);
        }
        $user = EventUserRepository::create($request);
        $linkResult = LinkUser::create(['event_user_id' => $user->id, 'event_id' => 1]);

        foreach (@$request->consumption_details as $item) {
            $request->replace(['user_id' => $user->id, 'product_id' => $item['product_id'], 'quantity' => $item['quantity']]);
            $user_consumptions = DB::table('user_consumptions')->insert($request->all());
        }

        // $request->replace(['user_id' => $user->id,'target_reward' => 0,'user_reward' => 0]);
        // $user_rewards = DB::table('user_rewards')->insert($request->all());

        $result = [
            'message' => 'Registration done Successfully',
            'data' => [
                'token' => $this->generateEventLoginToken($user->id, 1),
                'user_details' => [
                    'isAccountActive' => $user->is_verified,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'mob_number' => $user->mobile_number,
                    'street_address' => $user->address,
                    'state' => $user->state,
                    'district' => $user->district,
                    'pin' => $user->pin_code,
                    'lab_name' => $user->lab_name
                ]
            ]
        ];

        return response()->json([$result], 200);
    }

    private function create400Error($array)
    {
        return response(array_merge($array, [
            'status_code' => 400
        ]), 400);
    }

    private function validateUser($user_email, $id, $verified = false)
    {
        $user_email = trim($user_email);
        $user = EventUser::where('email', $user_email)->first();

        $response = null;

        if (!$user) {
            $response = $this->create400Error([
                'message' => 'User not found',
                'status' => false
            ]);
            return [$response, null];
        }

        if ($user->is_verified == 0) {
            $response = $this->create400Error([
                'message' => 'User not Verified',
                'status' => false
            ]);
            return [$response, null];
        }
        return [null, $user];
    }

    private function generateEventLoginToken($userId, $eventId)
    {
        $eventLogin = LinkUser::where('event_user_id', $userId)->first();

        $token = bin2hex(random_bytes(64)) . '_' . @$eventId;

        $eventLogin->forceFill([
            'access_token' => $token,
            'expires_on' => Carbon::now()->addWeeks(10)
        ])->save();

        return $token;
    }

    public function login(Request $request)
    {
        [$response, $user] = $this->validateUser($request->user_email, 1, true);

        if ($response) {
            return $response;
        }
        // return $request->password . ' ' . $user->password;
        $passwordMatches = Hash::check($request->password, $user->password);
        // return $passwordMatches;
        if (!$passwordMatches) {
            return $this->create400Error([
                'message' => 'Invalid credentials',
                'status' => false
            ]);
        }

        $result = [
            'message' => 'Logged in Successfully',
            'data' => [
                'refreshed_token' => $this->generateEventLoginToken($user->id, 1),
                'user_details' => [
                    'isAccountActive' => true,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'mob_number' => $user->mobile_number,
                    'street_address' => $user->address,
                    'state' => $user->state,
                    'district' => $user->district,
                    'pin' => $user->pin_code,
                    'lab_name' => $user->lab_name
                ]
            ]
        ];

        return response()->json([$result], 200);
    }

    public function getUsers()
    {
        $result = [];
        $users = EventUser::whereNotNull('email')->get();

        foreach ($users as $key => $user) {
            $result[$key]['user_id'] = $user->id;
            $result[$key]['user_name'] = $user->name;
            $result[$key]['user_email'] = $user->email;
            $result[$key]['mob_number'] = $user->mobile_number;
            $result[$key]['street address'] = $user->address;
            $result[$key]['lab_name'] = $user->lab_name;
        }

        return response()->json($result, 200);
    }

    public function getProducts()
    {
        $result = [];
        $products = DB::table('products')->where('active', '1')->get();

        foreach ($products as $key => $product) {
            $result[$key]['product_id'] = $product->id;
            $result[$key]['product_name'] = $product->name;
            $result[$key]['min_purchase_qty'] = $product->min_purchase_qty;
            $result[$key]['price'] = $product->price;
            $result[$key]['reward_points'] = $product->reward_points;
            $result[$key]['product_img'] = 'https://sales-app.com/' . $product->image;
        }

        return response()->json($result, 200);
    }

    public function getDealers(Request $request)
    {
        $result = [];
        $dealers = DB::table('dealers')->where('active', '1')->where('is_verified', '1')
            ->where(function ($q) use ($request) {
                $q->where('user_id', $request->user_id)->orWhere('user_id', 0);
            })->get();

        foreach ($dealers as $key => $dealer) {
            $result[$key]['dealer_id'] = $dealer->id;
            $result[$key]['dealer_name'] = $dealer->name;
            $result[$key]['dealer_address'] = $dealer->address;
            $result[$key]['mob_number'] = $dealer->mobile_number;
            $result[$key]['isVerified'] = $dealer->is_verified;
        }

        return response()->json($result, 200);
    }

    public function getPurchaseList(Request $request)
    {
        $result = [];
        $purchases = DB::table('user_purchases')->where('user_id', $request->user_id)->get();

        foreach ($purchases as $key => $purchase) {
            $product = DB::table('products')->find($purchase->product_id);
            $dealer =  DB::table('dealers')->find($purchase->product_id);
            $result[$key]['purchase_id'] = $purchase->id;
            $result[$key]['product_name'] = $product->name;
            $result[$key]['qty'] = $purchase->quantity;
            $result[$key]['dealer_name'] = $dealer->name;
            $result[$key]['invoice_url'] = 'https://sales-app.com/' . $purchase->invoice_url;
        }

        return response()->json($result, 200);
    }

    public function getRewardPoints(Request $request)
    {
        $result = [];
        $rewards = DB::table('user_rewards')->where('user_id', $request->user_id)->get();

        foreach ($rewards as $key => $reward) {

            $result[$key]['target_reward'] = $reward->target_reward;
            $result[$key]['user_reward'] = $reward->user_reward;
        }

        return response()->json($result, 200);
    }

    public function getHelpMessages()
    {
        $result = [];
        $messages = DB::table('help_messages')->where('active', '1')->get();

        foreach ($messages as $key => $help) {
            $result[$key]['help_id'] = $help->id;
            $result[$key]['title'] = $help->title;
            $result[$key]['description'] = $help->description;
        }

        return response()->json($result, 200);
    }

    public function postAddProduct(Request $request)
    {
        $request->replace(['name' => $request->product_name, 'min_purchase_qty' => $request->min_purchase_qty, 'price' => $request->price, 'reward_points' => $request->reward_points, 'image' => $request->product_img, 'active' => 1]);

        $exist = DB::table('products')->where('name', @$request->name)->first();
        if ($exist) {
            return $this->create400Error([
                'message' => 'Already Exists. Please try with other Product.',
                'status' => false
            ]);
        }
        $res = DB::table('products')->insert($request->all());

        if ($res) {
            $product = DB::table('products')->latest()->first();
            $result = [
                'message' => 'Product added Successfully',
                'data' => [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'min_purchase_qty' => $product->min_purchase_qty,
                    'price' => $product->price,
                    'reward_points' => $product->reward_points,
                    'product_img' => 'https://sales-app.com/' . $product->image,
                ]
            ];

            return response()->json([$result], 200);
        }
    }

    public function postAddDealer(Request $request)
    {
        $request->replace(['user_id' => $request->user_id, 'name' => $request->dealer_name, 'address' => $request->dealer_address, 'mobile_number' => $request->mob_number, 'is_verified' => $request->isVerified == true ? 1 : 0, 'active' => 1]);

        $exist = DB::table('dealers')->where('user_id', $request->user_id)->where('name', $request->name)->first();
        if ($exist) {
            return $this->create400Error([
                'message' => 'Already Exists. Please try with other Dealer.',
                'status' => false
            ]);
        }

        $res = DB::table('dealers')->insert($request->all());

        if ($res) {
            $dealer = DB::table('dealers')->latest()->first();
            $result = [
                'message' => 'Dealer added Successfully',
                'data' => [
                    'dealer_id' => $dealer->id,
                    'dealer_name' => $dealer->name,
                    'dealer_address' => $dealer->address,
                    'mob_number' => $dealer->mobile_number,
                    'isVerified' => $dealer->is_verified,
                ]
            ];

            return response()->json([$result], 200);
        }
    }

    public function addPurchaseEntry(Request $request)
    {
        $request->replace(['user_id' => $request->user_id, 'product_id' => $request->product_id, 'dealer_id' => $request->dealer_id, 'quantity' => $request->quantity, 'invoice_url' => $request->invoice_url]);

        $res = DB::table('user_purchases')->insert($request->all());

        if ($res) {
            $purchase = DB::table('user_purchases')->latest()->first();
            $product = DB::table('products')->find($purchase->product_id);
            $reward = DB::table('user_rewards')->where('user_id', $purchase->user_id)->get();
            $total_reward = ($reward->user_reward * $purchase->quantity) + $product->reward_points;
            $reward->insert('user_reward', $total_reward);

            $result = [
                'message' => 'Purchase added Successfully',
                'data' => [
                    'purchase_id' => $purchase->id,
                    'purchase_name' => $purchase->name,
                    'purchase_address' => $purchase->address,
                    'mob_number' => $purchase->mobile_number,
                    'isVerified' => $purchase->is_verified,
                ]
            ];

            return response()->json([$result], 200);
        }
    }

    public function claimRewards(Request $request)
    {

        $reward = DB::table('user_rewards')->where('user_id', $request->user_id)->get();
        $pending_reward = $reward->user_reward-$request->total_rewards;

        $reward->insert('user_reward', $pending_reward);

            $result = [
                'message' => 'Reward Claimed Successfully',
                'data' => [
                    'claimed_reward' => $request->total_rewards,
                    'pending_reward' => $pending_reward
                ]
            ];

        return response()->json([$result], 200);
    }

    public function uploadMedia(Request $request)
    {
        $uploadedFile = $request->file('file');
        if (@$uploadedFile) {
            $filename = Carbon::now()->format('YmdHs') . $uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'files/uploads/',
                $uploadedFile,
                $filename
            );
        }

        // $upload = new Upload;
        // $upload->filename = $filename;
        // $upload->save();

        return response()->json([
            'file_url' => 'https://fantasiadev.digitalskyonline.com/storage/files/uploads/' . @$filename
        ]);
    }







    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvents()
    {
        $res = [];
        $events = Event::where('event_from_date', '>=', Carbon::now()->format('Y-m-d'))->get();

        foreach ($events as $key => $event) {
            $event_tabs = EventTab::where('event_id', '=', @$event->id)->get();
            $res[$key]['id'] = $event->id;
            $res[$key]['name'] = $event->name;
            $res[$key]['image'] = 'https://fantasiadev.digitalskyonline.com/' . $event->image;
            $res[$key]['event_date'] = $event->event_from_date->format('d') . '-' . $event->event_to_date->format('d M, Y');
        }

        return response()->json([$res], 200);
    }

    public function getEventUsers(Request $request)
    {
        $res = [];
        $link_users = LinkUser::where('event_id', $request->id)->where('event_user_id', '!=', $request->user_id)->get();

        foreach ($link_users as $key => $user) {
            $user_info = EventUser::where('id', '=', @$user->event_user_id)->first();
            $res[$key]['user_id'] = $user_info->id;
            $res[$key]['user_name'] = $user_info->user_email;
            $res[$key]['profile_img'] = 'https://fantasiadev.digitalskyonline.com/' . $user_info->image;
            $res[$key]['last_active'] = $user_info->last_active;
        }

        return response()->json($res, 200);
    }

    public function getEvent(Request $request)
    {
        $res = [];
        $event_about = Event::select('id', 'banner_image as image', 'body as welcome_page', 'video_path')->where('id', $request->id)->first();
        $event_detail = Event::select('body1 as event_info', 'helpdesk_no', 'address', 'map', 'qr_code', 'p1_number', 'p2_number', 'p3_number', 'p4_number')->where('id', $request->id)->first();

        $res['about'] = $event_about;
        $res['about']['image'] = 'https://fantasiadev.digitalskyonline.com/' . $event_about->image;
        $res['about']['welcome_page'] = removeExtraChar(strip_tags($event_about->welcome_page));
        $res['about']['video_path'] = 'https://fantasiadev.digitalskyonline.com/' . $event_about->video_path;
        $res['event'] = $event_detail;
        $event_info = strip_tags($event_detail->event_info);
        $res['event']['event_info'] = removeExtraChar(explode("\r\n\r\n", $event_info));
        $res['event']['address'] = removeExtraChar(strip_tags($event_detail->address));
        $res['event']['qr_code'] = 'https://fantasiadev.digitalskyonline.com/' . $event_detail->qr_code;
        $res['event']['h_title'] = "DO'S & DON'TS";
        $res['event']['h_number'] = "SOME IMPORTANT NUMBERS";
        $res['event']['p1_title'] = "WhatsApp Hotline";
        $res['event']['p2_title'] = "Hilton Garden Number";
        $res['event']['p3_title'] = "Police";
        $res['event']['p4_title'] = "Ambulance";

        return response()->json([$res], 200);
    }

    public function getEventAgenda(Request $request)
    {
        $res = [];
        $event = Event::select('id')->where('id', $request->id)->first();
        $event_tabs = EventTab::select('id', 'tab_title as event_date')->where('event_id', $event->id)->get();

        $res = $event_tabs;
        foreach ($event_tabs as $key => $event_tab) {
            $res[$key]['event_date'] = Carbon::createFromFormat('d/m/Y', $event_tab->event_date)->format('M d l');
            $agenda = GalleryTab::select('tab_title as title', 'tab_time as time', 'speaker_id')->where('event_tab_id', $event_tab->id)->get();
            $res[$key]['agenda'] = $agenda;
            foreach ($agenda as $key1 => $ag) {
                $sp = FacultyDetail::select('name')->where('id', $ag->speaker_id)->first();
                $res[$key]['agenda'][$key1]['speaker'] = $sp->name;
            }
        }

        return response()->json($res, 200);
    }

    public function getEventSpeakersOld(Request $request)
    {
        $res = [];
        $event = Event::select('id')->where('id', $request->id)->first();
        // $speaker_links1 = LinkFaculty::where('event_id', $event->id)->get();
        $speaker_links = GalleryTab::where('event_id', $event->id)->groupBy('speaker_id')->pluck('speaker_id');

        $speakers = [];
        foreach ($speaker_links as $speaker_id) {
            $speakers[] = FacultyDetail::select('id', 'name as name', 'body as about', 'image')->where('id', $speaker_id)->first();
        }

        $res = @$speakers;
        foreach ($speakers as $key => $speaker) {
            $res[$key]['about'] = removeExtraChar(strip_tags($speaker->about));
            $res[$key]['image'] = 'https://fantasiadev.digitalskyonline.com/' . $speaker->image;
        }

        return response()->json($res, 200);
    }

    public function getEventSpeakers(Request $request)
    {
        $res = [];
        $event = Event::select('id')->where('id', $request->id)->first();
        // $speaker_links1 = LinkFaculty::where('event_id', $event->id)->get();
        $speaker_links = GalleryTab::where('event_id', $event->id)->groupBy('speaker_id')->pluck('speaker_id');

        $speakers = [];
        foreach ($speaker_links as $speaker_id) {
            $speakers[] = FacultyDetail::select('id', 'name as name', 'body as about', 'image')->where('id', $speaker_id)->first();
            // $event_tabs = EventTab::select('id','tab_title as event_date')->where('event_id', $event->id)->get(); 
            // $event_list[] = GalleryTab::where('event_tab_id', $event_tab->id)->where('speaker_id', $speaker_id)->first();   

            $event_lists[] = DB::table('gallery_tabs')->join('event_tabs', function ($event_tabs) {
                $event_tabs->on('event_tabs.id', 'gallery_tabs.event_tab_id');
            })->select('event_tabs.tab_title as event_date', 'gallery_tabs.*')->where('event_tabs.event_id', $event->id)->where('gallery_tabs.speaker_id', $speaker_id)->orderBy('event_tabs.id', 'desc')->first();
        }
        // return($event_lists);
        $res = @$speakers;
        $res1 = @$event_lists;
        foreach ($speakers as $key => $speaker) {
            $res[$key]['about'] = removeExtraChar(strip_tags($speaker->about));
            $res[$key]['image'] = 'https://fantasiadev.digitalskyonline.com/' . $speaker->image;
            foreach ($event_lists as $key1 => $event_list) {
                $res[$key1]['event_date'] = Carbon::createFromFormat('d/m/Y', $event_list->event_date)->format('M d l');
                $res[$key1]['event_time'] = $event_list->tab_time;
                $res[$key1]['event_title'] = $event_list->tab_title;
            }
        }

        return response()->json($res, 200);
    }

    public function getSpeaker(Request $request)
    {
        $res = [];
        $speaker = FacultyDetail::where('id', $request->id)->first();
        $event_list = GalleryTab::where('speaker_id', @$speaker->id)->get();
        $event_attended = FacultyTab::where('faculty_id', @$speaker->id)->get();

        if (@$speaker) {
            // $res = @$speaker;    
            $res['name'] = removeExtraChar(strip_tags(@$speaker->name));
            $res['about'] = removeExtraChar(strip_tags(@$speaker->about));
            $res['image'] = 'https://fantasiadev.digitalskyonline.com/' . @$speaker->image;
            $res['social_media'] = [
                "facebook" => @$speaker->facebook,
                "twitter" => @$speaker->twitter,
                "instagram" => @$speaker->instagram,
            ];

            foreach ($event_attended as $key => $attend) {
                $res['event_attended'][$key] = [
                    "event_date" => $attend->event_date,
                    "event_title" => $attend->event_title,
                    "start_time" => Carbon::createFromFormat('d/m/Y', $attend->event_date)->format('D M d Y') . ' ' . $attend->start_time . ':00 GMT+0530 (India Standard Time)',
                    "end_time" => Carbon::createFromFormat('d/m/Y', $attend->event_date)->format('D M d Y') . ' ' . $attend->end_time . ':00 GMT+0530 (India Standard Time)',
                ];
            }

            foreach ($event_list as $key => $event) {
                $res['event_list'][$key] = [
                    "description" => $event->tab_title,
                    "location" => removeExtraChar(@$event->Event->address),
                    "date" => @$event->EventTab->tab_title,
                ];
            }
        }

        return response()->json($res, 200);
    }

    public function getNotification(Request $request)
    {
        $res = [];

        $notifications = Notification::where('event_date', '>=', Carbon::now()->format('d/m/Y'))->get();

        foreach ($notifications as $key => $notification) {
            $res[$key] = [
                "speaker" => $notification->Speaker->name,
                "time" => $notification->tab_time,
                "talk_on" => $notification->tab_title,
                "date" => $notification->event_date,
            ];
        }

        return response()->json($res, 200);
    }

    public function getGallery(Request $request)
    {
        $res = [];

        $events = Event::select('name as event_name', 'address as location', 'video_path', 'event_from_date', 'event_to_date')->where('event_from_date', '>=', Carbon::now()->format('Y-m-d'))->get();

        $res = $events;
        foreach ($events as $key => $event) {
            $res[$key]['video_path'] = 'https://fantasiadev.digitalskyonline.com/' . $event->video_path;
            $res[$key]['location'] = removeExtraChar($event->location);
            $res[$key]['event_date'] = $event->event_from_date->format('d') . '-' . $event->event_to_date->format('d M, Y');
        }

        return response()->json($res, 200);
    }

    // User Chats
    public function postMessage(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $request->merge(['created_date' => date('Y-m-d')]);
        $request->merge(['created_time' => date('H:i:s')]);

        $result = DB::table('user_chats')->insert($request->all());
        if ($result) {
            return response()->json([
                'message' => 'Message Sent Successfully'
            ], 200);
        }
    }

    public function postGroupMessage(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $request->merge(['created_date' => date('Y-m-d')]);
        $request->merge(['created_time' => date('H:i:s')]);

        $result = DB::table('user_chats')->insert($request->all());
        if ($result) {
            return response()->json([
                'message' => 'Message Sent Successfully'
            ], 200);
        }
    }

    public function postDeviceToken(Request $request)
    {
        $eventUser = EventUser::where('id', $request->user_id)->first();

        $eventUser->forceFill([
            'device_token' => $request->device_token
        ])->save();

        return response()->json([
            'device_token' => $request->device_token
        ]);
    }

    public function getUserChatList(Request $request)
    {
        $res = [];

        $query = DB::table('user_chats')->join('event_users', function ($event_users) {
            $event_users->on('event_users.id', 'user_chats.from_user_id');
        })->select('event_users.*', 'user_chats.*')->where('user_chats.event_id', $request->event_id)->where('user_chats.from_user_id', $request->user_id)->where('user_chats.group_id', 0)->get();
        // dd($query);
        foreach ($query as $key => $chat) {
            $res[$key]['to_user_id'] = $chat->to_user_id;
            $res[$key]['user_name'] = $chat->user_email;
            $res[$key]['profile_img'] = 'https://fantasiadev.digitalskyonline.com/' . $chat->profile_img;
            $res[$key]['last_active'] = $chat->created_at;
            $res[$key]['last_message'] = $chat->message;
        }

        return response()->json($res, 200);
    }

    public function getUserMessages(Request $request)
    {
        $res = [];
        $query = DB::table('user_chats')->join('event_users', function ($event_users) {
            $event_users->on('event_users.id', 'user_chats.from_user_id');
        })->select('event_users.*', 'user_chats.*')
            ->where('group_id', 0)->where('event_id', $request->event_id)
            ->where(function ($q) use ($request) {
                $q->where('from_user_id', $request->user_id)->orWhere('from_user_id', $request->to_user_id);
            })->where(function ($q) use ($request) {
                $q->where('to_user_id', $request->user_id)->orWhere('to_user_id', $request->to_user_id);
            })
            ->get();
        foreach ($query as $key => $chat) {
            $res[$key]['from_user_id'] = $chat->from_user_id;
            $res[$key]['to_user_id'] = $chat->to_user_id;
            $res[$key]['user_name'] = $chat->user_email;
            $res[$key]['profile_img'] = 'https://fantasiadev.digitalskyonline.com/' . $chat->profile_img;
            $res[$key]['last_active'] = $chat->created_at;
            $res[$key]['last_message'] = $chat->message;
        }

        return response()->json($res, 200);
    }

    public function getGroupMessages(Request $request)
    {
        $res = [];
        $query = DB::table('user_chats')->join('event_users', function ($event_users) {
            $event_users->on('event_users.id', 'user_chats.from_user_id');
        })->select('event_users.*', 'user_chats.*')->where('user_chats.event_id', $request->event_id)->where('user_chats.group_id', $request->group_id)->get();
        foreach ($query as $key => $chat) {
            $res[$key]['user_id'] = $chat->from_user_id;
            $res[$key]['user_name'] = $chat->user_email;
            $res[$key]['profile_img'] = 'https://fantasiadev.digitalskyonline.com/' . $chat->profile_img;
            $res[$key]['last_active'] = $chat->created_date . '-' . $chat->created_time;
            $res[$key]['last_message'] = $chat->message;
        }

        return response()->json($res, 200);
    }


    public function oldlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            // 'remember_me' => 'boolean',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = $request->user();

        // $tokenResult = $user->createToken('Personal Access Token ' . Str::random(10));

        $token = Str::random(60);

        $request->user()->forceFill([
            // 'access_token' => hash('sha256', $token),
            'access_token' => $token,
        ])->save();

        // $token = $tokenResult->token;

        // if ($request->remember_me) {
        $expires_at = Carbon::now()->addWeeks(10);
        // }

        // $token->save();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $expires_at
            )
                ->toDateTimeString(),
        ], 200);
    }
}
