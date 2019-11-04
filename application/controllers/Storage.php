<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storage extends CI_Controller {

    public function index(){

    }
    public function image($id=null)
    {
            $filename=APPPATH."/storage/$id.jpg"; //<-- specify the image  file
            if(file_exists($filename)){ 
                $mime = mime_content_type($filename); //<-- detect file type
                header('Content-Length: '.filesize($filename)); //<-- sends filesize header
                header("Content-Type: $mime"); //<-- send mime-type header
                header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
                readfile($filename); //<--reads and outputs the file onto the output buffer
                die(); //<--cleanup
                exit; //and exit
            }
    }

}

/* End of file Storage.php */
