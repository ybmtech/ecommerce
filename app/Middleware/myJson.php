<?php
namespace App\Middleware;
class myJson{
         //encode data to json
         public function encode_json($data){
            $data=json_encode($data);
            return $data;
           }
            //decode data from json $type(true or false)
            public function decode_json($data,$type){
             $data=json_decode($data,$type);
             return $data;
            }
            //check whether it's json
     public function isJson($string){
       $json_array = json_decode($string,true);
     if( $json_array == NULL ){
      return false;
     }
     else{
       return true;
     }
     
     }
}