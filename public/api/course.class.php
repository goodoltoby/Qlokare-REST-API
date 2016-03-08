<?php

class course{
		public $id, $grades, $prefix;
		public function __construct($id = NULL){
		if($id){
			$this->id = $id;

			$db = DB::getInstance();

			$id = $db->real_escape_string($id); 
			$query = "SELECT person_nr, grades, course_id FROM student_grades WHERE course_id='$id'";
			$result = $db->query($query);
			$user = $result->fetch_assoc();


			$this->grades = $user['course_id'];
		}
	}

  public function get($data,$prefix = NULL){
  	$data=$this->id;
	$db = DB::getInstance();

  	if($prefix == 'grades'){
  		    $query = "SELECT grades FROM student_grades
		where course_id = '$data'";

		$result = $db->query($query);
		while($item = $result->fetch_assoc()){
			$helplist[] = $item;
		}
		deliver_respone(200,"grades yao", $helplist);
		}
		elseif(!$data){
			 $query = "SELECT DISTINCT course_id FROM student_grades";

		$result = $db->query($query);
		while($item = $result->fetch_assoc()){
			$helplist[] = $item;
		}
		deliver_respone(200,"grades yao", $helplist);
		}
		
	else{

    $query = "SELECT person_nr, grades, course_id FROM student_grades
		where course_id = '$data'";

		$result = $db->query($query);
		while($item = $result->fetch_assoc()){
			$helplist[] = $item;
		}
		deliver_respone(200,"grades yao", $helplist);
}


  }
}