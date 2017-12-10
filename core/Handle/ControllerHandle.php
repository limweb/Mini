<?php

namespace Core\Handle;

class ControllerHandle
{
    public $request;
    public $response;
    public $service;
    public $app;

    public function __construct($request, $response, $service, $app)
    {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        $this->app = $app;
    }


    public function render($name,$array=array())
    {
        $this->service->render('views/'.$name.'.phtml', $array);
    }
}