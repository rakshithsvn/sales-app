<?php

namespace App\Http\Controllers\Back;

use App\ {
    Models\User,
    Models\Notification,
    Models\FacultyDetail,
    Http\Controllers\Controller
};
use Illuminate\ {
    Http\Request,
    Notifications\DatabaseNotification,
    Support\Facades\Http
};
use App\Traits\Firebase;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    use Firebase;

    public function index(User $user)
    {
        $post_tabs = Notification::all();
        
        $speakers = FacultyDetail::pluck('name', 'id');
 
        return view('back.notifications.edit', compact('user','post_tabs','speakers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, DatabaseNotification $notification)
    {
        // dd($request->all());
        if(isset($request->tab_section))
        {
            foreach ($request->tab_title as $key => $value) {
                
                if (is_array($value)){
                    foreach ($value as $tab_key => $tab_value) {
                        Notification::where('id', $key)->update(['speaker_id' => $request->speaker_id[$key][$tab_key], 'tab_title' => $request->tab_title[$key][$tab_key],'tab_time' => $request->tab_time[$key][$tab_key], 'event_date' => $request->event_date[$key][$tab_key]]);
                    }                
                }
                else
                {
                    $project_tab = new Notification();
                    $project_tab->speaker_id = $request->speaker_id[$key];
                    $project_tab->tab_title = $request->tab_title[$key];
                    $project_tab->tab_time = $request->tab_time[$key];
                    $project_tab->event_date = $request->event_date[$key];
                    $project_tab->user_id = auth()->id();
                    $project_tab->save();
                }                
            }
        }
      
        $result = 'success';

        if($result == 'success')
        {
            return redirect(route('notifications.index'))->with('category-ok', __('The Notifications detail has been successfully updated'));
        }
        else
        {
            return redirect(route('notifications.index'))->with('category-danger', __('The Notification already exist. Cannot update'));
        }
   
        $notification->markAsRead();

        if($request->user()->unreadNotifications->isEmpty()) {
            return redirect()->route('posts.index');
        }

        return back();
    }

    public function deleteNotification(Request $request)
    {
        $contents = Notification::find($request->id);        
        $contents->delete();
        return 'true';
    }
       
    public  function firebaseNotificationss($fcmNotification){

        $fcmUrl = config('firebase.fcm_url');
        $apiKey = config('firebase.fcm_api_key');
        $http=Http::withOptions(['verify' => false])->withHeaders([
            'Authorization:key'=>$apiKey,
            'Content-Type'=>'application/json'
        ])->post($fcmUrl,$fcmNotification);

        // $http=Http::withOptions(['verify' => false])->acceptJson()->withToken($apiKey)->post(
        //     $fcmUrl,
        //     [
        //         'to' => '1234',
        //         'notification' => 
        //         ['title' => 'your title',
        //         'body' => 'your body'],
        //     ]
        // );

        // return $http->json();
        return $http;
    }

    public function sendNotificationss($tokenList, $message){
        $token="";
        $notification = [
            'title' =>'title',
            'body' => 'body of message.',
            'icon' =>'myIcon',
            'sound' => 'mySound'
        ];
        // $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [            
            // 'to'        => $token, //single token
            'registration_ids' => $tokenList, //multple token array
            'notification' => $message,
            // 'data' => $extraNotificationData
        ];
        
        return $this->firebaseNotification($fcmNotification); 
    }

    public function send(Request $request)
    {
        return $this->sendNotification(array(
          '12345', 
          '23456',
          '34567'
        ), array(
          "title" => "Sample Message", 
          "body" => "This is Test message body"
        ));
    }

    public function sendNotification($device_tokens, $message)
    {
        $fcmUrl = config('firebase.fcm_url');
        $apiKey = config('firebase.fcm_api_key');
  
        // payload data, it will vary according to requirement
        $data = [
            "registration_ids" => $device_tokens, 
            "data" => $message
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
      
        curl_close($ch);
      
        return $response;
    }
}
