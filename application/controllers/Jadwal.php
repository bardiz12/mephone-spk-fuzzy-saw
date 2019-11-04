<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Jenssegers\Blade\Blade;
class Jadwal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->blade = new Blade(APPPATH.'/blade_views', APPPATH.'/cache');
        $this->data_path = "/home/bardiz/unnes/data/";
        $this->theList = json_decode(file_get_contents($this->data_path."../list.json"));
        //unset($this->theList[0]);
    }
    
    public function index()
    {


       echo $this->blade->make("jadwal_picker",["data"=>$this->theList]);
        
    }
    
    public function pick(){
    	$prodi = $this->input->post("prodi");
    	if(is_numeric($prodi)){
    		if($prodi < count($this->theList)){
    			$pass = $this->input->post("pass");
    			if($pass == "konservasi"){
	    			$theProdi = $this->theList[$prodi];
	    			$data = file_get_contents($this->data_path."data_".str_replace("/","-",$theProdi->nama_prodi).".json");
			    	$data = json_decode($data);
			    	unset($data[0]);
			    	echo $this->blade->make("jadwal_table",["result"=>$data,"nama_prodi"=>$theProdi->nama_prodi]);
    			}else{
    				echo $this->blade->make("jadwal_salah");
    			}
    		}
    	}
    }
    
    public function ilkom(){
    	$data = file_get_contents(APPPATH."storage/data.json");
    	$data = json_decode($data);
    	unset($data[0]);
    	echo $this->blade->make("jadwal",["result"=>$data]);
    }
    
    public function akuntansi(){
    	
    }
    

}

/* End of file Home.php */
