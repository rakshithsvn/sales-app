<?php

if (!function_exists('currentRoute')) {
    function currentRoute($route)
    {
        return request()->url() == route($route) ? ' class=current' : '';
    }
}

if (!function_exists('currentRouteBootstrap')) {
    function currentRouteBootstrap($route)
    {
        return request()->url() == route($route) ? ' class=active' : '';
    }
}

if (!function_exists('user')) {
    function user($id)
    {
        return \App\Models\User::findOrFail($id);
    }
}

if (!function_exists('locales')) {
    function locales()
    {
        $file = resolve (\Illuminate\Filesystem\Filesystem::class);
        $locales = [];
        $results = $file->directories(resource_path ('lang'));
        foreach ($results as $result) {
            $name = $file->name($result);
            if($name !== 'vendor') {
                $locales[$name] = $name;
            }
        }
        return $locales;
    }
}

if (!function_exists('timezones')) {
    function timezones()
    {
        $zones_array = [];
        $timestamp = time();
        foreach(timezone_identifiers_list() as $zone) {
            date_default_timezone_set($zone);
            $zones_array[$zone] = 'UTC' . date('P', $timestamp);
        }
        return $zones_array;
    }
}

if (!function_exists('setTabActive')) {
    function setTabActive()
    {
        return request ()->has('page') ? request ('page') : 1;
    }
}

if (!function_exists('thumb')) {
    function thumb($url)
    {
        return \App\Services\Thumb::makeThumbPath ($url);
    }
}

function removeExtraChar($content){
    if($content){
        $order   = array("\\r\\n", "\\n", "\\r", "\r\n", "\n", "\r", "<p>&nbsp;</p>", "&quot;");
        $replace = array(" ", " ", " ", " ", " ", " ", "","");
        $content = str_replace($order, $replace, $content); 
        return $content;
    }
   return '';
}

function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'ab1257980';
    $secret_iv = '20255se22322';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function checkEmail($email){
  return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}

function capitalize($textString){
  return ucwords($textString);
}

function curlSMSRequest($request_data)
{

 if (!empty($request_data)) {

   $request_url = 'http://www.smscountry.com/SMSCwebservice_Bulk.aspx';
   
   $ch = curl_init();

   if (!$ch) {
     die("Couldn't initialize a cURL handle");
   }
   $ret = curl_setopt($ch, CURLOPT_URL, $request_url);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
   $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $curlresponse = curl_exec($ch); // execute

   if (curl_errno($ch))
     echo 'curl error : ' . curl_error($ch);
   if (empty($ret)) {
     // some kind of an error happened
     die(curl_error($ch));
     curl_close($ch); // close cURL handler
   } else {
     $info = curl_getinfo($ch);

     curl_close($ch); // close cURL handler

     return $curlresponse;
   }
 }
}





