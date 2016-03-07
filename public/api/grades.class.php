<?php

class grades{

  public function get($data){

  	$db = DB::getInstance();
    $query = "
		SELECT * FROM student_grades
		";

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
      
  }

  public function delete(){

  }

  }
