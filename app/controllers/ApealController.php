<?php

class ApealController extends Controller
{
    //! Create apeal record
    public function create()
    {
        $data = $this->f3->get('POST');

        $mapper = $this->mapper;
        $mapper->surname = $this->f3->get('POST.surname');
        $mapper->name = $this->f3->get('POST.name');
        $mapper->last_name = $this->f3->get('POST.last-name');
        $mapper->apeal_text = $this->f3->get('POST.text-apeal');
        $mapper->phone = $this->f3->get('POST.email');
        $mapper->email = $this->f3->get('POST.phone');
        $mapper->type = $this->f3->get('POST.apeal-type');
        $mapper->save();
        $files = $this->f3->get('FILES');
        $this->f3->reroute('/results');

    }

    //! List assets
    function assets()
    {
        // Build list from files in the uploads folder
        $assets = array();
        foreach (glob($this->f3->get('UPLOADS') . '*') as $file)
            $assets[] = array(
                'name' => basename($file),
                'posted' => filemtime($file)
            );
        $this->f3->set('uploads', $assets);
        // Define HTML subtemplate
        $this->f3->set('inc', 'assets.htm');
    }

    //! Process asset upload
    function upload()
    {
        $web = \Web::instance();
        $this->f3->set('UPLOADS','uploads/'); // don't forget to set an Upload directory, and make it writable!

        $overwrite = false; // set to true, to overwrite an existing file; Default: false
        $slug = true; // rename file to filesystem-friendly version

        $files = $web->receive(function($file,$formFieldName){
            var_dump($file);
            /* looks like:
              array(5) {
                  ["name"] =>     string(19) "csshat_quittung.png"
                  ["type"] =>     string(9) "image/png"
                  ["tmp_name"] => string(14) "/tmp/php2YS85Q"
                  ["error"] =>    int(0)
                  ["size"] =>     int(172245)
                }
            */
            // $file['name'] already contains the slugged name now

            // maybe you want to check the file size
            if($file['size'] > (2 * 1024 * 1024)) // if bigger than 2 MB
                return false; // this file is not valid, return false will skip moving it

            // everything went fine, hurray!
            return true; // allows the file to be moved from php tmp dir to your defined upload dir
        },
            $overwrite,
            $slug
        );

        var_dump($files);
    }
}