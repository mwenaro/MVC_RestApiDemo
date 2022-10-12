<?php
class Router {
    protected $routes = [];
    private $path;
    private $request_method;
    private $custom_method;
    protected $request;
    protected $response;
    
    
  
  
    function __construct ($req, $res){
      $this->request = $req;
      $this->response = $res;
      
    }
  
    function get($path, $callback = null){
     
  if ($path == $this->request->getFormatedPath() && $this->request->getRequestMethod() == 'GET'){
    $callback($this->request, $this->response);
    exit(); 
  }
  
  
       
  
    }
  
  function post($path, $path_value){
    if ($path == $this->request->getFormatedPath() && $this->request->getRequestMethod() == 'POST'){
      exit();
    }  
  
    }
  function put($path, $path_value){
    if ($path == $this->request->getFormatedPath() && $this->request->getRequestMethod() == 'PUT'){
      exit();
    }  
    
    }
  function delete($path, $path_value){
        if ($path == $this->request->getFormatedPath() && $this->request->getRequestMethod() == 'DELETE'){
          exit();
    }
    exit();
    }
  function any(){
   $this->response->status(404)->json(['message' => 'Invalid api  endpoint']); 
   return;  
    }
  function register_route($path, $path_value){
      
    }
  
    function resolve(){
      
    }
  
    // private function validate_path($path, $request_method){
    //   if ($path == $this->request->getFormatedPath() && $this->request->getRequestMethod() == 'GET'){
    // }
  }
