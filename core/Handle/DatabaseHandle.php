<?php 

namespace Core\Handle;

use Core\SingletonProvider; 
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use DB;

class DatabaseHandle 
{
    protected static $instance;
    public static function getInstance()
    {
        
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }
   
    private static $config;
    
    public function __construct()
    {
        self::$config = require('config/database.php');
    }
    
    public static function boot()
    {
        $capsule = new DB;
        
        
        foreach(self::$config as $k=>$v){
            $capsule->addConnection($v,$k);  
            
        }
        
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        try {
            foreach(self::$config as $k=>$v){
                DB::connection($k)->getPdo() ;
            }
        } catch (\Exception $e) {
            
            echo ("Could not connect to the database.  Please check your configuration.");
        }
        
        
    } 
}