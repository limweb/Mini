<?php 

namespace Core\Handle;

class RouteHandle
{
    public static $route;
    public static $config;
    public $request;
    public $response;
    public $service;
    public $app;
    public function __construct()
    {
        self::$route = new \Klein\Klein();
        self::$config = require 'config/config.php'; 
    }

    public function bootstap()
    {

        $rte = require 'route/web.php' ; 
    
        $base = self::$config['basePath'];
        foreach($rte as $k=>$v)
        {
            
            self::$route->respond($v['method'],$base.''.$v['path'],function ($request, $response, $service, $app) use ($v) {
                $fuc = explode('@',$v['controller']);
                $objController = new $fuc[0]($request, $response, $service, $app);
                return call_user_func(
                    array(
                        $objController,
                        $fuc[1]
                    )
                );
            });
            
            if(isset($v['middleware'])){
                $keith = self::$route;
                self::$route->with($base.''.$v['path'], function() use ($v,$keith){
                    return call_user_func(
                        array(
                            $v['middleware'],
                            'handle'
                        ),
                        $keith
                    );
                });
            }
        }
        
        $this->outPut();
    }

    public function outPut()
    {
        self::$route->dispatch();        
    }
}