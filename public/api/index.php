<?php
header('Content-Type: text/json');


function __autoload($class){
  require_once($class.".class.php");
}

$url_parts = getUrlParts($_GET);

$method = $_SERVER['REQUEST_METHOD']; # innehåller ex: POST, PUT, DELETE, GET
$resource = $url_parts[0];
$data = getHTTPData($method);

$allowed_resources = ['grades'];

if(in_array($resource, $allowed_resources)){
  require_once($resource.".class.php");
  $id = (isset($url_parts[1])) ? $url_parts[1] : NULL;
  $obj = new $resource($id);
  $obj->$method($data); 
}else{
  header("HTTP/1.1 404 Not Found");
}




function getHTTPData($method){
  switch($method){
    case 'GET':
      $data = $_GET;
      break;
    case 'POST':
      $data = $_POST;
      break;
    case 'PUT':
    case 'DELETE':
      parse_str(file_get_contents('php://input', false , null, -1 , $_SERVER['CONTENT_LENGTH'] ), $data);
      break;
  }
  return $data;
}



function getUrlParts($get){
  $get_params = array_keys($get);
  
  $url = $get_params[0];
  $url_parts = explode("/",$url);
  foreach($url_parts as $k => $v){
    if($v) $array[] = $v; # om det finns ett innehåll på platsen vi är på just nu, spara det i $array
  }

  $url_parts = $array;

  return $url_parts; 
}