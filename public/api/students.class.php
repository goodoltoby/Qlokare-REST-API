<?php

class students{
		public $id, $grades;

		public function __construct($id = NULL){
		if($id){
			$this->id = $id;
			
			
			$db = DB::getInstance();

			$id = $db->real_escape_string($id); 
			$query = "SELECT person_nr, grades FROM student_grades WHERE id=$id";
			$result = $db->query($query);
			$user = $result->fetch_assoc();

			//$this->username = $user['person_nr'];
			$this->grades = $user['grades'];

		}
	}

  public function get($data, $prefix){
  	$data=$this->id;
  	$db = DB::getInstance();

		if($prefix == 'grades'){
	  		$query = "SELECT grades FROM student_grades
			where id = '$data'";

			$result = $db->query($query);
			while($item = $result->fetch_assoc()){
				$helplist[] = $item;
			}
			deliver_respone(200,"grades yao", $helplist);
		}
		elseif(!$data){
			 $query = "SELECT DISTINCT person_nr FROM student_grades";

			$result = $db->query($query);
			while($item = $result->fetch_assoc()){
				$helplist[] = $item;
			}
			deliver_respone(200,"grades yao", $helplist);
		}
		
		else{
	  		 $query = "SELECT person_nr, grades, course_id FROM student_grades
			where id = '$data'";

			$result = $db->query($query);
			while($item = $result->fetch_assoc()){
				$helplist[] = $item;
			}
			deliver_respone(200,"grades yao", $helplist);
}
}

	public function post($data){
		$db = DB::getInstance();

		$id = $db->real_escape_string($data['id']);
		$person_nr = $db->real_escape_string($data['person_nr']);
		$course_id = $db->real_escape_string($data['course_id']);
		$grades = $db->real_escape_string($data['grades']);
		$query = "INSERT INTO student_grades
			(person_nr,course_id, grades) 
			VALUES ('$person_nr','$course_id','$grades')";

		$db->query($query);

		$student = new students($db->insert_id);
		$student->get(1);
	}

  public function put($data){
        	$db = DB::getInstance();
		$fields = ['grades'];
		foreach($fields as $field){

			if(isset($data[$field])){
				$sql_parts[] = $field . " = "."'".$db->real_escape_string($data[$field])."'";
			}
		} 	

		$update_fields = implode(',',$sql_parts);	
		$id = $db->real_escape_string($this->id); 

		$query = "
			UPDATE student_grades 
			SET $update_fields
			WHERE id = $id
			";

		if($db->query($query)){
			$respons = ['status' => 'ok'];
		}else{
			$respons = ['status' => 'fail'];
		}

		echo json_encode($respons);
  }

  }
