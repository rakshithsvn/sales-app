<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Firebase
{

    public  function firebaseNotification($fcmNotification){

        $fcmUrl = config('firebase.fcm_url');
        $apiKey = config('firebase.fcm_api_key');

        $http=Http::withOptions(['verify' => false])->withHeaders([
            'Authorization:key'=>$apiKey,
            'Content-Type'=>'application/json'
        ])  ->post($fcmUrl,$fcmNotification);

        return $http;
    }
}
?>