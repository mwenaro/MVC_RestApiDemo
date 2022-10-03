<?php
require_once './functions.php';

$app = new Router();

// var_dump($app);

$app->get('/teachers/:fname/:age/',function($req,$res){
  echo json_encode(['msg'=>'hello from get']);
  print_r($req->getBody());
});

$app->get('/path', function(){
  echo json_encode(['msg'=>'hello from get']);
});

$app->get('/', function(){
  echo json_encode(['msg'=>'hello from get']);
});



// $con = file_get_contents("php://input");
// print_r($con);
// $con = json_decode(file_get_contents("php://input"));
// print_r($con);
// $con = is_array($con)?$con:json_decode(file_get_contents("php://input"),true);
// print_r($con);

// exit();
// var_dump($app);
?>
<?php
class Router {
  protected $routes = [];
  private $path;
  private $request_method;
  private $custom_method;
  protected $request;
  protected $response;
  
  


  function __construct (){
    $this->request = new Request();
    
  }

  function get($path, $callback = null){
   
if ($path == $this->request->getFormatedPath() && $this->request->getRequestMethod() == 'GET'){
$callback($this->request, $this->response);
     
    }
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
  private $formated_path = null;
  private $path_params = [];
  public $url = null;
  private $ctrl = null;
  private $query_string = null;
  public $controller = null;
  
	
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

//students/form/2?order=adm&limit=20
   $this->url = $url = $_SERVER['REQUEST_URI']?? '/';
   //Check if query_string and set the modifiers
   $url_parts_v0 = [];
   if(strpos($url,'?') !== -1){
      $url_parts_v0 = explode("?",$url);
      $url = $url_parts_v0[0]; /* /students/form/2 */
      $q_string = $url_parts_v0[1];

      //Set query string values
      $this->setQStringVars($q_string);
   }

   //Extract the main path  from i.e   
    $url_parts_v1 = explode("/", trim($url, "/"));
   $this->controller = count($url_parts_v1) > 0 ? $url_parts_v1[0]:'index';
   
 
 //set ctrl or path
 // /students/form/2 => /students/:form
    $this->path = $url;
    $this->setFormatedPath($url_parts_v1);
    array_shift($url_parts_v1);

    //Set the remaining parts to path parameters
    if(count($url_parts_v1) > 0){
      $this->setPathParams($url_parts_v1);
    }
      
  }


function setFormatedPath($url_parts){
  $main_path = array_shift($url_parts);
  $f_path= "/{$main_path}/";
   $len = count($url_parts);

   //Pair the remaining such way that [ [0] => [[1], [2]] => [3]]
 
    for($i = 0; $i < count($url_parts); $i+=2){
        if($i+1 < $len):
            $f_path .=":".$url_parts[$i]."/";
        endif;
        
  }

  $this->formated_path = $f_path;
  
}

function getFormatedPath (){
  return $this->formated_path;
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
