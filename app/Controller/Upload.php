<?php
namespace App\Controller;
class Upload{
  /**
   * file upload 
   * $not_un_folder receive either yes for a folder in the same diretory while other is parent dorectory else same folder with the file helper
   */
    public function upload_file($file,$valid_extensions,$path_to_upload,$size,$not_in_folder=""){
         $file_name  =  $file['name'];
        $tempPath  =  $file['tmp_name'];
        $file_size  =  $file['size'];
         $fileExt = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
         if($file_size>$size){
          return json_encode(['status'=>false,'message'=>'File upload is too large']);
        } 
         if(in_array($fileExt, $valid_extensions))
         {	
	 if($not_in_folder=="yes"){
		 $path="../".$path_to_upload;
	 }
   else if($not_in_folder=="other"){
    $path="../../".$path_to_upload;
  }
	 else{
		 $path=$path_to_upload;
	 }
      $upload_file=$path."/".md5($file_name).time().".".$fileExt;
      $filename_to_server=$_ENV['IMAGE_UPLOAD_URL']."/".$path_to_upload."/".md5($file_name).time().".".$fileExt;
      if(move_uploaded_file($tempPath,$upload_file)){
          return json_encode(['status'=>true,'message'=>'File uploaded','data'=>$filename_to_server]);
      
          }
          else{
            return json_encode(['status'=>false,'message'=>'File upload fail, try again later']);
      
          }
          
          }
          else{
            $support_file=implode(",",$valid_extensions);
            return json_encode(['status'=>false,'message'=>'Only '.$support_file." are allow"]);
          }
        }
   
}