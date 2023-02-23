<?php
namespace App\Middleware;
class Filter{
    public $filterData;
  //fiter input data
  public function filterValue($data){
          $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         $this->filterData=$data;
          return $this->filterData;
      }
  public function unique_id_generator()
  {
    $data = md5(uniqid() . time() . rand(11111, 99999) . mt_rand(11111, 99999));
    return $data;
  }
}