<?php

class Controller
{
    protected $f3;
    protected $db;
    protected $mapper;

    function __construct()
    {

        $f3 = Base::instance();
        $db = new \DB\Jig ( 'db/', \DB\Jig::FORMAT_JSON );
        $mapper = new \DB\Jig\Mapper($db, $f3->db_filename);
        $this->f3 = $f3;
        $this->db = $db;
        $this->mapper = $mapper;
    }

}