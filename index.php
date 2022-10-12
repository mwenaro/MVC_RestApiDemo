<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:FETCH,POST, GET , OPTIONS, DELETE, PUT ");
header("Access-Control-Allow-Max-Age:3000");

require_once './Router.php';
require_once './Request.php';
require_once './Response.php';

$app = new Router( new Request, new Response);

// var_dump($app);
//students/:form/marks:/examId
$app->get('/teachers/:name/:age/',function($req,$res){
  print_r([
'params'=>$req->params,
'path' => $req->url,
'formated path' =>$req ->getFormatedPath()
]);
 
});
$app ->get('/teachers/:id',function($req, $ers){
   print_r([
'params'=>$req->params,
'path' => $req->url,
'formated path' =>$req ->getFormatedPath()
]);
});

//students/form/2/marks/examId/3
$app->get('/students/:form/marks/:id', function($req, $res){
  echo json_encode([
'path' => '/students/:form/marks/:id',
'body' => $req->getBody(),
'formated' => $rew->getFomatedPath()

]);

});

$app->get('/', function(){
  echo json_encode(['msg'=>'hello from / ']);
});

$app->any();



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

