<?php

class courses{
    public $id, $grades, $prefix;

    public function __construct($id = NULL, $prefix = NULL){
    if($id){
      $this->id = $id;
      $this->prefix = $prefix;
      
      /*$db = DB::getInstance();

      $id = $db->real_escape_string($id); 
      $query = "SELECT person_nr, grades, course_id FROM student_grades WHERE course_id='$id'";
      $result = $db->query($query);
      $user = $result->fetch_assoc();


      $this->grades = $user['course_id'];*/
    }
  }

  public function get($data){
  $db = DB::getInstance();

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
         $query = "SELECT DISTINCT course_id FROM student_grades";

          $result = $db->query($query);
          while($item = $result->fetch_assoc()){
           $gradeitems[] = $item;
    }
    echo json_encode($gradeitems);
    }
    
  elseif($this->id){
    $query = "SELECT * FROM student_grades
          where course_id = $this->id";

          $result = $db->query($query);
          while($item = $result->fetch_assoc()){
          $gradeitems[] = $item;
  }
       echo json_encode($gradeitems);
}
    else{

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
  
    $grades = $db->real_escape_string($data['grades']); 
    $user_id = $db->real_escape_string($data['user_id']); 
    $course_id = $db->real_escape_string($data['course_id']); 

   

    $query = "
      UPDATE student_grades 
      SET grades = '$grades'
      WHERE user_id = $user_id AND course_id = $course_id
      ";

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