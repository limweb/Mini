<?php

namespace Controller;

use Log;
use Models\User;
use DB;

class indexController extends \Controllers
{

    /*
    *   $this->request, $this->response, $this->service, $this->app
    */

    public function index()
    {
        $data = User::get();
       
        return $this->render('index', array('title' => 'My View'));
    }

    public function add()
    {
        
    }

}