<?php
namespace App\Controller;
use \PDO;
class DbQuery extends ConnectDb{
 //counter without parameter
 public function row_count_without_parameter($table){
    $table = $this->filterValue($table);
  $query="SELECT * FROM $table";
  $stmt=$this->con->prepare($query);
$stmt->execute();
if($stmt->rowCount()>0){
$data=$stmt->rowCount();
      return $data;
      $this->con=null;
  }
  else{
      return "0";
  }
  }
  //counter with parameter
  public function row_count_one_parameter($table,$param,$value){
    $table = $this->filterValue($table);
    $param = $this->filterValue($param);
    $value= $this->filterValue($value);
    $query="SELECT * FROM $table WHERE $param=:parameter";
    $stmt=$this->con->prepare($query);
    $stmt->bindValue(':parameter',$value);
  $stmt->execute();
  if($stmt->rowCount()>0){
  $data=$stmt->rowCount();
        return $data;
        $this->con=null;
    }
    else{
        return "0";
    }
    }
	  public function row_count_two_parameter($table,$param,$value,$param2,$value2){
    $table = $this->filterValue($table);
    $param = $this->filterValue($param);
    $value= $this->filterValue($value);
    $param2= $this->filterValue($param2);
    $value2= $this->filterValue($value2);
    $query="SELECT * FROM $table WHERE $param=:parameter AND $param2=:parameter2";
    $stmt=$this->con->prepare($query);
    $stmt->bindValue(':parameter',$value);
    $stmt->bindValue(':parameter2',$value2);
  $stmt->execute();
  if($stmt->rowCount()>0){
  $data=$stmt->rowCount();
        return $data;
        $this->con=null;
    }
    else{
        return "0";
    }
    }
   
    public function row_count_one_parameter_like($table,$param,$value){
      $table = $this->filterValue($table);
      $param = $this->filterValue($param);
      $value= $this->filterValue($value);
       
        $query="SELECT * FROM $table WHERE $param LIKE :parameter";
        $stmt=$this->con->prepare($query);
        $stmt->bindValue(':parameter','%'.$value.'%');
       $stmt->execute();
      
    if($stmt->rowCount()>0){
    $data=$stmt->rowCount();
          return $data;
          $this->con=null;
      }
      else{
          return "0";
      }
      }
    
    //sum function
  public function row_sum_with_parameter($table,$sum,$param,$value){
    $table = $this->filterValue($table);
    $sum= $this->filterValue($sum);
    $param = $this->filterValue($param);
    $value = $this->filterValue($value);
    $query="SELECT SUM($sum) as total FROM $table WHERE $param=:parameter";
    $stmt=$this->con->prepare($query);
    $stmt->bindValue(':parameter',$value);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data['total'];
        $this->con=null;
    }
    else{
        return "0";
    }
    }
     //fetch single data from table with one column
  public function row_with_one_parameter($table,$parameter,$value){
  $table=$this->filterValue($table);
  $parameter=$this->filterValue($parameter);
  $value=$this->filterValue($value);
    $query="SELECT * FROM $table WHERE $parameter=:parameter";
    $stmt=$this->con->prepare($query);
$stmt->bindValue(':parameter',$value);
$stmt->execute();
if($stmt->rowCount()>0){
  $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
        $this->con=null;
    }
    else{
        return false;
    }
    }
    
     public function row_with_one_parameter_limit($table,$parameter,$value,$orderby,$sort,$limit){
    
  $table=$this->filterValue($table);
  $parameter=$this->filterValue($parameter);
  $value=$this->filterValue($value);
    $orderby = $this->filterValue($orderby);
    $sort = $this->filterValue($sort);
    $limit = $this->filterValue($limit);
    $query="SELECT * FROM $table WHERE $parameter=:parameter ORDER BY $orderby $sort LIMIT $limit";
    $stmt=$this->con->prepare($query);
$stmt->bindValue(':parameter',$value);
$stmt->execute();
if($stmt->rowCount()>0){
  $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
        $this->con=null;
    }
    else{
        return false;
    }
    }
    //fetch single data from table with one  column and one column not equal to
    public function row_with_two_parameter_not_equal($table,$parameter,$value,$parameter2,$value2){
    $table=$this->filterValue($table);
    $parameter=$this->filterValue($parameter);
    $parameter2=$this->filterValue($parameter2);
    $value=$this->filterValue($value);
    $value2=$this->filterValue($value2);
      $query="SELECT * FROM $table WHERE $parameter=:parameter AND $parameter2!=:parameter2";
      $stmt=$this->con->prepare($query);
  $stmt->bindValue(':parameter',$value);
  $stmt->bindValue(':parameter2',$value2);
  $stmt->execute();
  if($stmt->rowCount()>0){
          return true;
          $this->con=null;
      }
      else{
          return false;
      }
      }
	    public function row_with_three_parameter($table,$parameter,$value,$parameter2,$value2,$parameter3,$value3){
    $table=$this->filterValue($table);
    $parameter=$this->filterValue($parameter);
    $parameter2=$this->filterValue($parameter2);
    $value=$this->filterValue($value);
    $value2=$this->filterValue($value2);
      $query="SELECT * FROM $table WHERE $parameter=:parameter AND $parameter2=:parameter2 AND $parameter3=:parameter3";
      $stmt=$this->con->prepare($query);
  $stmt->bindValue(':parameter',$value);
  $stmt->bindValue(':parameter2',$value2);
  $stmt->bindValue(':parameter3',$value3);
  $stmt->execute();
  if($stmt->rowCount()>0){
          return true;
          $this->con=null;
      }
      else{
          return false;
      }
      }
      //delete from a table 
    public function delete_with_one_parameter($table,$parameter,$value){
      
    $table=$this->filterValue($table);
    $parameter=$this->filterValue($parameter);
    $value=$this->filterValue($value);
      $query="DELETE FROM $table WHERE $parameter=:parameter";
      $stmt=$this->con->prepare($query);
  $stmt->bindValue(':parameter',$value);
  $sql=$stmt->execute();
  if($sql){
          return true;
          $this->con=null;
      }
      else{
          return false;
      }
      }

       //delete from a table without parameter
    public function delete_without_parameter($table){
      
      $table=$this->filterValue($table);
        $query="DELETE FROM $table";
        $stmt=$this->con->prepare($query);
    $sql=$stmt->execute();
    if($sql){
            return true;
            $this->con=null;
        }
        else{
            return false;
        }
        }
      //fetch multiple data from table with two column and operator(AND or OR) to compare
    public function row_with_two_parameter($table,$parameter1,$value1,$parameter2,$value2,$operator){
    $table=$this->filterValue($table);
    $parameter1=$this->filterValue($parameter1);
    $parameter2=$this->filterValue($parameter2);
    $value1=$this->filterValue($value1);
    $value2=$this->filterValue($value2);
    $operator=$this->filterValue($operator);
      $query="SELECT * FROM $table WHERE $parameter1=:parameter1 $operator $parameter2=:parameter2";
      $stmt=$this->con->prepare($query);
  $stmt->bindValue(':parameter1',$value1);
  $stmt->bindValue(':parameter2',$value2);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
          return $data;
          $this->con=null;
      }
      else{
          return false;
      }
      }

      //fetch multiple data from table with one column compare and orderby with sorting(ASC or DESC)
      public function multiple_row_with_one_parameter($table,$parameter,$value,$orderby,$sort){
        $table=$this->filterValue($table);
        $parameter=$this->filterValue($parameter);
        $value=$this->filterValue($value);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);

        $query="SELECT * FROM $table WHERE $parameter=:parameter ORDER BY $orderby $sort";
        $stmt=$this->con->prepare($query);
    $stmt->bindValue(':parameter',$value);
    $stmt->execute();
    if($stmt->rowCount()>0){
      while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
     return $data;
     $this->con=null;
    }
        else{
            return false;
        }
        }

/**
 * to fetch random data from table using two parameter and two value. first parameter is = while second is not equal to
 * @return mixed
 */
        public function multiple_row_with_two_parameter_rand($table,$parameter,$value,$parameter2,$value2,$limit){
          $table=$this->filterValue($table);
          $parameter=$this->filterValue($parameter);
          $value=$this->filterValue($value);
          $parameter2=$this->filterValue($parameter2);
          $value2=$this->filterValue($value2);
          $limit=$this->filterValue($limit);
             
          $query="SELECT * FROM $table WHERE $parameter=:parameter AND $parameter2!=:parameter2 ORDER BY RAND() LIMIT $limit";
          $stmt=$this->con->prepare($query);
      $stmt->bindValue(':parameter',$value);
      $stmt->bindValue(':parameter2',$value2);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }
        
         public function multiple_row_with_one_parameter_distinct($table,$parameter,$value,$distinct,$orderby,$sort){
        $table=$this->filterValue($table);
        $parameter=$this->filterValue($parameter);
        $value=$this->filterValue($value);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);

        $query="SELECT DISTINCT $distinct FROM $table WHERE $parameter=:parameter ORDER BY $orderby $sort";
        $stmt=$this->con->prepare($query);
    $stmt->bindValue(':parameter',$value);
    $stmt->execute();
    if($stmt->rowCount()>0){
      while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
     return $data;
     $this->con=null;
    }
        else{
            return false;
        }
        }
            public function multiple_row_with_two_parameter($table,$parameter1,$value1,$parameter2,$value2,$operator){
        $value1=$this->filterValue($value1);
        $value2=$this->filterValue($value2);
        $query="SELECT * FROM $table WHERE $parameter1=:parameter1 $operator $parameter2=:parameter2";
        $stmt=$this->con->prepare($query);
    $stmt->bindValue(':parameter1',$value1);
    $stmt->bindValue(':parameter2',$value2);
    $stmt->execute();
    if($stmt->rowCount()>0){
      while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
     return $data;
     $this->con=null;
    }
        else{
            return false;
        }
        }

      //fetch multiple data from table and orderby with sorting(ASC or DESC)
        public function multiple_row_without_parameter($table,$orderby,$sort){
          $table=$this->filterValue($table);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
        
          $query="SELECT * FROM $table ORDER BY $orderby $sort";
          $stmt=$this->con->prepare($query);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }
           //fetching multiple row without parameter and joining with other table
        public function multiple_row_without_parameter_join($table1,$table2,$table1_column,$table2_column,$table1_data,$orderby,$sort){
          $table1=$this->filterValue($table1);
          $table1_column=$this->filterValue($table1_column);
          $table2_column=$this->filterValue($table2_column);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
        
             $query="SELECT $table1_data FROM `$table1` INNER JOIN `$table2` ON `$table1`.`$table1_column`=`$table2`.`$table2_column`
           ORDER BY $orderby $sort";
          $stmt=$this->con->prepare($query);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }

           //fetching multiple row without parameter and joining with other table
        public function multiple_row_with_one_parameter_join($table1,$table2,$table1_column,$table2_column,$table1_data,$parameter,$value,$orderby,$sort){
          $table1=$this->filterValue($table1);
          $table1_column=$this->filterValue($table1_column);
          $table2_column=$this->filterValue($table2_column);
          $parameter=$this->filterValue($parameter);
          $value=$this->filterValue($value);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
        
             $query="SELECT $table1_data FROM `$table1` INNER JOIN `$table2` ON `$table1`.`$table1_column`=`$table2`.`$table2_column`
           WHERE $parameter=:parameter ORDER BY $orderby $sort";
          $stmt=$this->con->prepare($query);
          $stmt->bindValue(':parameter',$value);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }

          public function multiple_row_withiout_parameter_limit($table,$orderby,$sort,$limit){
            $table=$this->filterValue($table);
          $orderby=$this->filterValue($orderby);
          $sort=$this->filterValue($sort);
          
            $query="SELECT * FROM $table ORDER BY $orderby $sort LIMIT $limit";
            $stmt=$this->con->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){
          while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
         return $data;
         $this->con=null;
        }
            else{
                return false;
            }
            }
             /**
    * The second parameter use like to search and it only take four parameter as highest parameter
    */
    public function multiple_row_four_below($table,$param,$value,$param2,$value2,$param3,$value3,$param4,$value4){
      $table = $this->filterValue($table);
      $param = $this->filterValue($param);
      $value= $this->filterValue($value);
      $param2= $this->filterValue($param2);
      $value2= $this->filterValue($value2);
      $param3= $this->filterValue($param3);
      $value3= $this->filterValue($value3);
      $param4= $this->filterValue($param4);
      $value4= $this->filterValue($value4);
      if($param3==false && $param4==false){
        $query="SELECT * FROM $table WHERE $param=:parameter AND $param2 LIKE :parameter2";
        $stmt=$this->con->prepare($query);
        $stmt->bindValue(':parameter',$value);
        $stmt->bindValue(':parameter2','%'.$value2.'%');
      $stmt->execute();
      }
      else if($param3==false){
        $query="SELECT * FROM $table WHERE $param=:parameter AND $param2 LIKE :parameter2 AND $param4=:parameter4";
        $stmt=$this->con->prepare($query);
        $stmt->bindValue(':parameter',$value);
        $stmt->bindValue(':parameter2','%'.$value2.'%');
        $stmt->bindValue(':parameter4',$value4);
      $stmt->execute();
      }
      else if($param4==false){
        $query="SELECT * FROM $table WHERE $param=:parameter AND $param2 LIKE :parameter2 AND $param3=:parameter3";
        $stmt=$this->con->prepare($query);
        $stmt->bindValue(':parameter',$value);
        $stmt->bindValue(':parameter2','%'.$value2.'%');
        $stmt->bindValue(':parameter3',$value3);
      $stmt->execute();
      }
      else{
        $query="SELECT * FROM $table WHERE $param=:parameter AND $param2 LIKE :parameter2 AND $param3=:parameter3 AND $param4=:parameter4";
        $stmt=$this->con->prepare($query);
        $stmt->bindValue(':parameter',$value);
        $stmt->bindValue(':parameter2','%'.$value2.'%');
        $stmt->bindValue(':parameter3',$value3);
        $stmt->bindValue(':parameter4',$value4);
      $stmt->execute();
      }
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
      }

		   public function multiple_row_parameter_limit($table,$param,$value,$orderby,$sort,$limit){
          $table=$this->filterValue($table);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
        $limit=$this->filterValue($limit);
        $param=$this->filterValue($param);
        $value=$this->filterValue($value);
        if($param==false){
          $query="SELECT * FROM $table ORDER BY $orderby $sort LIMIT $limit";
          $stmt=$this->con->prepare($query);
      $stmt->execute();
        }
        else{
          $query="SELECT * FROM $table WHERE $param=:param ORDER BY $orderby $sort LIMIT $limit";
          $stmt=$this->con->prepare($query);
          $stmt->bindValue(':param',$value);
      $stmt->execute();
        }
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }
          public function multiple_row_parameter_limit_offset($table,$param,$value,$offset,$limit){
            $table=$this->filterValue($table);
           $offset=$this->filterValue($offset);
          $limit=$this->filterValue($limit);
          $param=$this->filterValue($param);
          $value=$this->filterValue($value);
          if($param==false){
            $query="SELECT * FROM $table LIMIT $offset,$limit";
            $stmt=$this->con->prepare($query);
            $stmt->execute();    
          }
          else{
            $query="SELECT * FROM $table WHERE $param=:param LIMIT $offset,$limit";
            $stmt=$this->con->prepare($query);
            $stmt->bindValue(':param',$value);
            $stmt->execute();    
          }
        if($stmt->rowCount()>0){
          while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
         return $data;
         $this->con=null;
        }
            else{
                return false;
            }
            }
            public function multiple_row_parameter_limit_offset_json($table,$param,$value,$offset,$limit){
              $table=$this->filterValue($table);
             $offset=$this->filterValue($offset);
            $limit=$this->filterValue($limit);
            $param=$this->filterValue($param);
            $value=$this->filterValue($value);
            if($param==false){
              $query="SELECT * FROM $table LIMIT $offset,$limit";
              $stmt=$this->con->prepare($query);
              $stmt->execute();    
            }
            else{
              $query="SELECT * FROM $table WHERE $param=:param LIMIT $offset,$limit";
              $stmt=$this->con->prepare($query);
              $stmt->bindValue(':param',$value);
              $stmt->execute();    
            }
          if($stmt->rowCount()>0){
            while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
              $data[] = $row;
          }
           return json_encode(['count'=>$stmt->rowCount(),'data'=>$data]);
           $this->con=null;
          }
              else{
                  return false;
              }
              }
         public function multiple_row_with_columns_one_parameter($table,$columns,$orderby,$sort){
          $table=$this->filterValue($table);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
        
          $query="SELECT $columns FROM $table ORDER BY $orderby $sort";
          $stmt=$this->con->prepare($query);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }
          public function multiple_row_with_columns_two_parameter($table,$columns,$parameter,$value,$orderby,$sort){
          $table=$this->filterValue($table);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
        
          $query="SELECT $columns FROM $table WHERE $parameter=:parameter ORDER BY $orderby $sort";
          $stmt=$this->con->prepare($query);
          $stmt->bindValue(":parameter",$value);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }
           //fetch multiple data from table and orderby with sorting(ASC or DESC)
        public function multiple_row_withiout_one_parameter($table,$param,$value,$orderby,$sort){
          $table=$this->filterValue($table);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
        
          $query="SELECT * FROM $table  WHERE $param !=:parameter ORDER BY $orderby $sort";
          $stmt=$this->con->prepare($query);
          $stmt->bindValue(':parameter',$value);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }
public function multiple_row_withiout_two_parameter($table,$param1,$value1,$param2,$value2,$orderby,$sort){
          $table=$this->filterValue($table);
        $orderby=$this->filterValue($orderby);
        $sort=$this->filterValue($sort);
         $query="SELECT * FROM $table  WHERE $param1=:parameter AND $param2 !=:parameter2 ORDER BY $orderby $sort";
          $stmt=$this->con->prepare($query);
          $stmt->bindValue(':parameter',$value1);
          $stmt->bindValue(':parameter2',$value2);
      $stmt->execute();
      if($stmt->rowCount()>0){
        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
       return $data;
       $this->con=null;
      }
          else{
              return false;
          }
          }
          //fetch multiple data from table with compare two date and orderby with sorting(ASC or DESC)
          public function multiple_row_compare_date($table,$orderby,$sort,$param,$value1,$value2){
            $table=$this->filterValue($table);
            $orderby=$this->filterValue($orderby);
            $sort=$this->filterValue($sort);
            $param=$this->filterValue($param);
            $value1=$this->filterValue($value1);
            $value2=$this->filterValue($value2);
            
            $query="SELECT * FROM $table WHERE $param  BETWEEN CAST('$value1' AS DATE) AND CAST('$value2' AS DATE) ORDER BY $orderby $sort";
            $stmt=$this->con->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){
          while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
         return $data;
         $this->con=null;
        }
            else{
                return false;
            }
            }
          }
        

?>