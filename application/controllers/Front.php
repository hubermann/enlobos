<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model(array('lugar','imagenes_lugar', 'slider', 'usuario'));
		$this->output->enable_profiler(TRUE);
	}

	public function index(){
		$data['sliders'] = $this->slider->get_records(0,10);
		$data['lugares'] = $this->lugar->seleccion_front(5);
		$data['content'] = "inicio";
		$this->load->view('front_layout', $data);
	}


	public function switcher(){
		$resultados = 0;
		#Busca titulos de publicaciones, turismo, clasificados y redirije
		$parametro = $this->uri->segment(1);
		$lugar = $this->lugar->select_by_titulo($parametro);

		if(  $lugar!= null ){
			$resultados = 1;
			var_dump($lugar->descripcion);
		}
		echo $resultados;
	}

	public function turismo(){
		//Pagination
		$per_page = 2;
		$page = $this->uri->segment(2);
		if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
			$data['pagination_links'] = "";
			$total_pages = ceil($this->lugar->count_rows() / $per_page);

			if ($total_pages > 1){ 
				for ($i=1;$i<=$total_pages;$i++){ 
				if ($page == $i) 
					//si muestro el índice de la página actual, no coloco enlace 
					$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
				else 
					//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
					$data['pagination_links']  .= '<li><a href="'.base_url('turismo/'.$i).'" > '. $i .'</a></li>'; 
			} 
		}
		
		//End Pagination
		$data['content'] = 'turismo';
		$data['lugares'] = $this->lugar->get_records($per_page,$start);

		$this->load->view('front_layout', $data);
	}

	//detail
	public function show_turismo(){
		$data['title'] = 'lugar';
		$data['content'] = 'turismo/detalle.php';
		$data['lugar'] = $this->lugar->get_record($this->uri->segment(3));
		$this->load->view('front_layout', $data);
	}

}