<?php 
class my404 extends CI_Controller {
    
		public function __construct(){

		parent::__construct();
		$this->load->model(array('usuario', 'publicacion','categoria_publicacion'));

		$this->load->helper(array('url','form'));

		}
		

    public function index(){ 
        $this->output->set_status_header('404'); 
     		$data['content'] = "error_404";
				$this->load->view('front_layout', $data);
    } 
} 
?>