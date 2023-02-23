<?php
namespace App\Controller;
use App\Middleware\myJson;
class Insert extends ConnectDb{
    //insert data proccessor
    public function insert_data($table,$data){
        $json=new myJson();
        $sql="INSERT INTO `$table`( ";
        $values_bind='';
        $bind_value=[];
        foreach($data as $column=>$value){
            $column=$this->filterValue($column);
            if($json->isJson($value)==false){
              $value=$this->filterValue($value);
            }
            $sql.="`$column`,";
            $values_bind.=":$column,";
           $bind_value[":$column"]=$value;
        }
        $formed_sql=rtrim($sql,',').") VALUES(".rtrim($values_bind,',').")";
        $json_data=[
        'sql'=>$formed_sql,
        'bind_value'=>$bind_value
        ];
        return json_encode($json_data);
    }
    //insert query helper
    public function insert($table,$data){
      $result=$this->insert_data($table,$data);
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