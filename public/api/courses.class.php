<?php

class courses{
  public $id, $grades, $prefix;

  public function __construct($id = NULL, $prefix = NULL){
    if($id){
      $this->id = $id;
      $this->prefix = $prefix;     
    }
  }

  public function get($data){
    $db = DB::getInstance();
    //gets grades and users
    if($this->prefix == 'grades'){
      $query = "SELECT grades, user_id FROM student_grades
      where course_id = '$this->id'";

      $result = $db->query($query);
      while($item = $result->fetch_assoc()){
        $gradeitems[] = $item;
      }
      echo json_encode($gradeitems);
    }

    elseif(!$this->id){
      //gets all unique courses
      $query = "SELECT DISTINCT course_id FROM student_grades";

      $result = $db->query($query);
      while($item = $result->fetch_assoc()){
        $gradeitems[] = $item;
      }
      echo json_encode($gradeitems);
    }
    
    elseif($this->id){
      //gets user, course and grades
      $query = "SELECT * FROM student_grades
        where course_id = $this->id";

      $result = $db->query($query);
      while($item = $result->fetch_assoc()){
        $gradeitems[] = $item;
      }
      echo json_encode($gradeitems);
    }

    else{
      //gets it all
      $query = "SELECT * FROM student_grades
      ";

      $result = $db->query($query);
      while($item = $result->fetch_assoc()){
        $gradeitems[] = $item;
      }
      echo json_encode($gradeitems);
    }
  }

  public function put($data){
    $db = DB::getInstance();
    
    if($this->prefix == 'grades'){
      $grades = $db->real_escape_string($data['grades']); 
      $user_id = $db->real_escape_string($data['user_id']); 
      //$course_id = $db->real_escape_string($data['course_id']); 

      //puts (updates) grades
      $query = "
        UPDATE student_grades 
        SET grades = '$grades'
        WHERE user_id = $user_id AND course_id = $this->id
        ";
    }

    if($db->query($query)){
      $respons = ['status' => 'ok'];
    }else{
      $respons = ['status' => 'fail'];
    }
    echo json_encode($respons);
  }

public function post($data){
  $db = DB::getInstance();

  $user_id = $db->real_escape_string($data['user_id']);
  $grades = $db->real_escape_string($data['grades']);
  $course_id = $db->real_escape_string($data['course_id']);

  //posts (inserts) user, course and grade
  $query = "
    INSERT INTO student_grades
    (user_id, course_id, grades)
    VALUES
    ('$user_id', '$course_id', '$grades') ";

    
  if($db->query($query)){
      $respons = ['status' => 'ok'];
    }else{
      $respons = ['status' => 'fail'];
    }
  echo json_encode($respons);
  }
}