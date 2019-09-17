<?php
class ResultController extends Controller
{
    public function index()
    {
        $apeal_types = [
            "0" => 'Жалоба',
            "1" => 'Предложение',
            "2" => 'Заявление'
        ];

        $results = $this->db->read('list.json');
        $this->f3->set('types', $apeal_types);
        $this->f3->set('result', $results);
        echo Template::instance()->render('list.html');
    }
}