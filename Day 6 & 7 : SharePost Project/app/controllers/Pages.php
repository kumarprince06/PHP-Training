<?php

class Pages extends Controller
{
    public function __construct() {}


    public function index()
    {

        $data = [
            'title' => 'Sharepost',
            'description' => 'Simple Shop Project on the MVC PHP Framework'
        ];


        $this->view('pages/index', $data);
    }
    public function about()
    {

        $data = [
            'title' => 'ShopMVC',
            'description' => 'Simple Shop Project on the MVC PHP Framework'
        ];


        $this->view('pages/index', $data);
    }
}
