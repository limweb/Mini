<?php 

return array(
    /* example
        'name'=> array(
            'path'=>'',
            'method'=>'',
            'controller'=>'',
            'middleware'=>''
        ),
    */
    
    'index'=> array(
        'path'=>'/',
        'method'=>'GET',
        'controller'=>'Controller\indexController@index',
        'middleware'=>'Middleware\sessionMiddleware'
    ),
    'indexAdd'=> array(
        'path'=>'/',
        'method'=>'POST',
        'controller'=>'Controller\indexController@add',
        'middleware'=>'Middleware\sessionMiddleware'
    ),
    

);