<?php

class HomeController extends Controller
{
    public function index()
    {
        $apeal_types = [
            "0" => 'Жалоба',
            "1" => 'Предложение',
            "2" => 'Заявление'
        ];
        $this->f3->set('types', $apeal_types);
        echo Template::instance()->render('index.html');
    }
}