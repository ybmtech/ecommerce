<?php
namespace App\Controller;
use App\Middleware\myJson;
class Update extends ConnectDb{
      //update data proccessor
      public function update_data($table,$data,$param,$param_id){
        $sql="UPDATE `$table` SET ";
        $bind_value=[];
		$json=new myJson();
        foreach($data as $column=>$value){
            $column=$this->filterValue($column);
			if($json->isJson($value)==false){
              $value=$this->filterValue($value);
            }
            $sql.="`$column`=:$column,";
           $bind_value[":$column"]=$value;
        }
        $formed_sql=rtrim($sql,',')." WHERE $param=:$param";
        $bind_value[":$param"]=$param_id;
        $json_data=[
        'sql'=>$formed_sql,
        'bind_value'=>$bind_value
        ];
        return json_encode($json_data);
    }
    //update query helper
    public function update($table,$data,$param,$param_id){
      $result=$this->update_data($table,$data,$param,$param_id);
  $decode_result=json_decode($result,true);
  $query=$decode_result['sql'];
  $stmt=$this->con->prepare($query);
  $sql=$stmt->execute($decode_result['bind_value']);
  if ($sql) {
  return true;
  $this->con=null;
  }
  else{
  return false;
  }
    }
     
}