<?php

namespace VyconsultingGroup;


class PushNotification
{
    private $url = 'https://fcm.googleapis.com/fcm/send';
    private $key = null;
    private $message = null;
    private $fields=null;
    private  $header = null;
    private $data = array();
    public function __construct($apiKey)
    {
        $this->key = $apiKey;
        $this->header =  array(
            'Authorization: key='.$this->key,
            'Content-Type: application/json'
        );
    }

    public function setMessage($title, $body, $vibration, $sound,$priority){

        $this->message = array(
            'title'=>$title,
            'body'=>$body,
            'vibrate'=>$vibration,
            'sound'=>$sound,
            'priority'=>$priority
        );
    }
   public function setData($data){
        $this->data = $data;
   }
    public function setField($token){
        $this->fields = array(
            'to'=>$token,
            'notification'=>$this->message,
            'data'=>array('payload'=>json_encode($this->data,JSON_FORCE_OBJECT))
        );

    }

    public function setFields($tokens){
        $this->fields = array(
            'registration_ids'=>$tokens,
            'notification'=>$this->message,
            'data'=>array('payload'=>json_encode($this->data,JSON_FORCE_OBJECT))
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
        return $result;
    }

}
