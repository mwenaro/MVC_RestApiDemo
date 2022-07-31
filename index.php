<?php
//$app = new Router();
$req = new Request();
echo json_encode(
  [
    'rq_method' => $req->getRequestMethod(),
    'url '=>$req->url,
    'body' => $req->getBody(),
    'where' => $req->getPathParams(),
    'modifiers' => $req->getQStringVars()
  ]
);


// $con = file_get_contents("php://input");
// print_r($con);
// $con = json_decode(file_get_contents("php://input"));
// print_r($con);
// $con = is_array($con)?$con:json_decode(file_get_contents("php://input"),true);
// print_r($con);

exit();
// var_dump($app);
?>
<?php
class Router {
  protected $routes = [];
  private $path;
  private $request_method;
  private $custom_method;
  
  


  function __construt (){
    
  }

  function get($path, $callback){
   
  }

function post($path, $path_value){
    
  }
function put($path, $path_value){
    
  }
function delete($path, $path_value){
    
  }
function any($path, $path_value){
    
  }
function register_route($path, $path_value){
    
  }

  function resolve(){
    
  }
}
class Index {
  function index(){
    echo "<h2>Hello from Index/index</h2>";
  }
  function get (){
    echo "<h2>Hello from Idex/get</h2>";
  }
  function post($data = null){
    echo "<h2>Hello from Idex/post</h2>";
  }
}
class Login {
  function index(){
    echo "<h2>Hello from Login/index</h2>";
  }
  function get (){
    echo "<h2>Hello from Login/get</h2>";
  }
  function post($data = null){
    echo "<h2>Hello from Idex/post</h2>";
  }
}

class Request {
	private $custome_req_method = null;
	private $req_condotions = [];
	private $modifiers = []; //this is an array of url vars
  private $body =[];
  private $request_method = null;
  private $path;
  private $path_params = [];
  public $url = null;
  private $ctrl = null;
  private $query_string = null;
	
  function __construct (){
    //Call init to intiolaize the request
    $this->init();
  }
  
  function getCustomReqMethod (){
  	return $this->custome_req_method;
  }

  
  function getPath(){
    return $this->path;
  }

  function init (){
	/*
	   exxaples
	    users/name/mwero => get users with name mwero
	    users/2 => get user with id =>1
	    users?ORDER=name&sort=DES => gt all users order by name , sort desc/asc

	
	*/


   $this->url = $url = $_SERVER['REQUEST_URI']?? '/_index/index/';

    //Check if query_string and set the modifiers
    $has_query_string = strpos($url,'?');
   $url_parts = $has_query_string? explode('?',$url):[$url]; //
   
    //Check if query_string and set the modifiers 
    $qs = $has_query_string && count($url_parts) > 1? array_pop($url_parts): null;
    $this->setQStringVars($qs);

   //Remove '/' on both ends
    $main_path = array_shift($url_parts);

  //check for custome_meth => the one begins with _
$has_custome_method = strpos($main_path, '_');
$url_parts = explode('/', trim($main_path, '/'));
if($has_custome_method){
$this->custom_method = trim($url_parts[0]);
// array_shift($url_parts);
}
    //set ctrl or path
    $this->path = array_shift($url_parts);

    //Set the remaining parts to parameters
    if(count($url_parts) > 0){
      $this->setPathParams($url_parts);
    }
    
  }

  function setPathParams($params = [])
  {
    if (empty($params)) return;

    // $arr = explode('/', trim($q_string, '/'));
    $arr = $params;
    $len = count ($arr);

    if ($len % 2 != 0)
    { 
        if ($len == 1) $this->path_params = ['id'=>$arr[0]];

    }  else{
 for ( $n = 0; $n < $len; $n+=2){
$this->path_params [$arr[$n]] = $arr[$n+1];
 }
      }

  }

  function getPathParams(){
    
    return $this->path_params;
  }

/**
 *  setRequestMethod
 */
  function setRequestMethod ($method = null){
  return $method??$_SERVER['REQUEST_METHOD'];
  }

  function getRequestMethod (){
    return $_SERVER['REQUEST_METHOD'];
  }
  
  function getBody(){
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
      foreach($_GET as $key => $val){
        $this->body[$key] = $val;
      }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      foreach($_POST as $key => $val){
        $this->body[$key] = $val;
      }
    }

    if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == "DELETE"){
      parse_str(file_get_contents("php://input"), $post_vars);

      foreach($post_vars as $key => $val){
        $this->body[$key] = $val;
      }
    }

    return $this->body;
  }

  function setQStringVars($q_string = null){
    if(!$q_string) return [];

    $q_string_array = explode('&', $q_string);
    foreach($q_string_array as $value) {
      $val = explode('=' , $value);
      $this->modifiers [$val[0]] = $val[1];

  }

  }


  function getQStringVars(){
       return $this->modifiers;
  }


  
}
