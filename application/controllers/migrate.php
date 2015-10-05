<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migrate extends CI_Controller{
    
    public function index(){
    	
        $this->load->library("migration");

      if(!$this->migration->version($this->uri->segment(2))){
          show_error($this->migration->error_string());
      }else{
      	echo 'Realizada la migracion '.$this->uri->segment(2);
      }   
    }
    
}