<?php

class grades{
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

  public function get($data){
  	$data=$this->id;
  	$db = DB::getInstance();
    $query = "SELECT person_nr, grades FROM student_grades
		where id = $data";

		$result = $db->query($query);
		while($item = $result->fetch_assoc()){
			$helplist[] = $item;
		}
		deliver_respone(200,"grades yao", $helplist);
}


  public function post(){
   $db = DB::getInstance();

	$query = "
		SELECT * FROM student_grades
		";

		$result = $db->query($query);
		while($item = $result->fetch_assoc()){
			$helplist[] = $item;
		}
		
		var_dump($helplist);
  }

  public function put(){
        	$db = DB::getInstance();
		var_dump($data);
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
			SET 'grades'='g'
			WHERE id = 1
			";

		if($db->query($query)){
			$respons = ['status' => 'ok'];
		}else{
			$respons = ['status' => 'fail'];
		}

		echo json_encode($respons);
  }

  public function delete(){

  }

  }
