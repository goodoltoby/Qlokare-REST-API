<?php

class students{
  public $id, $grades, $prefix;

  public function __construct($id = NULL, $prefix = NULL){  
    if($id){
      $this->id = $id;
      $this->prefix = $prefix;
    }
  }

  public function get($data){
    $db = DB::getInstance();

    if($this->prefix == 'grades'){
      $query = "SELECT grades, course_id FROM student_grades
      where user_id = '$this->id'";

      $result = $db->query($query);
      while($item = $result->fetch_assoc()){
        $gradeitems[] = $item;
      }
      echo json_encode($gradeitems);
    }

    elseif(!$this->id){
      $query = "SELECT DISTINCT user_id FROM student_grades
      ";

      $result = $db->query($query);
      while($item = $result->fetch_assoc()){
        $gradeitems[] = $item;
      }
      echo json_encode($gradeitems);
    }

    elseif($this->id){
      $query = "SELECT * FROM student_grades
      where user_id = $this->id";

      $result = $db->query($query);
      while($item = $result->fetch_assoc()){
        $gradeitems[] = $item;
      }
      echo json_encode($gradeitems);
    } 
  }

  public function put($data){
  }

  public function post($data){
  }
}