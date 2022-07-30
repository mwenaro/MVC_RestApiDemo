<?php
$app = new Router();


// var_dump($app);
?>
<?php
class Router {
  protected $routes = [];
  private $path;
  private $request_method;
  private $custom_method;
  private $ctrl = null;
  


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

  function __construct (){
    
  }
  

  function getPath(){
    $path = $_SERVER['REQUEST_URI']?? : '/';
     
  }

  function getMethod (){
    
  }
  
  function getBody(){
    
  }
  
}