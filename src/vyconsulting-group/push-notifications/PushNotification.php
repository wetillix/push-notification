<?php

namespace VyconsultingGroup\PushNotifications;


class PushNotification
{
    private $url = 'https://fcm.googleapis.com/fcm/send';
    private $key = null;
    private $message = null;
    private $fields=null;
    private  $header = null;
    public function __construct($apiKey)
    {
        $this->key = $apiKey;
        $this->header =  array(
            'Authorization: key='.$this->key,
            'Content-Type: application/json'
        );
    }

    public function setMessage($title, $body, $vibration, $sound){

        $this->message = array(
            'title'=>$title,
            'body'=>$body,
            'vibrate'=>$vibration,
            'sound'=>$sound
        );
    }

    public function setField($token){
        $this->fields = array(
            'registration_ids'=>$token,
            'message'=>$this->message
        );

    }

    public function execute(){
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL,$this->url);
        curl_setopt( $ch,CURLOPT_POST,true);
        curl_setopt( $ch,CURLOPT_HTTPHEADER,$this->header);
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($this->fields));
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }

}