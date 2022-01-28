<?php
$controller='main_';
$function='Homepage';
$parameter='';

if(isset($_GET['controller']) && $_GET['controller'] !=''){
    $controller= $_GET['controller'];
}

if(isset($_GET['function']) && $_GET['function'] !=''){
    $function= $_GET['function'];
}

if(isset($_GET['parameter']) && $_GET['parameter'] !=''){
    $parameter= $_GET['parameter'];
}

if(file_exists('controllers/'.$controller.'controller.php')){
    include('controllers/'.$controller.'controller.php');
    $class = $controller.'controller';
    $obj = new $class();
    if(method_exists($class,$function)){
        if($parameter){
            $obj->$function($parameter);
          }else{
           $obj->$function();
          }
    }else{
        echo '<h1>Function not found</h1>';
    }
}else{
    echo '<h1>Controller Not Found</h1>';
}

?> 