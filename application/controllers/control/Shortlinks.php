<?php 

class shortlinks extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('shortlink');
	$this->load->helper('url');
	$this->load->library('session');

	//Si no hay session redirige a Login
	if(! $this->session->userdata('logged_in')){
		redirect('dashboard');
	}

	if( ! ini_get('date.timezone') ){
	    date_default_timezone_set('GMT');
	    setlocale(LC_ALL,"es_ES");
	    setlocale(LC_TIME, 'es_AR');
	}

	$this->data['thumbnail_sizes'] = array(); //thumbnails sizes 

}

public function index(){
	//Pagination
	$per_page = 4;
	$page = $this->uri->segment(3);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->shortlink->count_rows() / $per_page);

		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/shortlinks/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'shortlinks';
	$data['menu'] = 'control/shortlinks/menu_shortlink';
	$data['content'] = 'control/shortlinks/all';
	$data['query'] = $this->shortlink->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

	$data['title'] = 'shortlink';
	$data['content'] = 'control/shortlinks/detail';
	$data['menu'] = 'control/shortlinks/menu_shortlink';
	$data['query'] = $this->shortlink->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
	$this->load->helper('form');
	$data['title'] = 'Nuevo shortlink';
	$data['content'] = 'control/shortlinks/new_shortlink';
	$data['menu'] = 'control/shortlinks/menu_shortlink';
	$this->load->view('control/control_layout', $data);
}

//create
public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('alias', 'Alias', 'required');

	$this->form_validation->set_rules('url', 'Url', 'required');

	$this->form_validation->set_rules('created_at', 'Created_at', 'required');

	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');
		$data['title'] = 'Nuevo shortlinks';
		$data['content'] = 'control/shortlinks/new_shortlink';
		$data['menu'] = 'control/shortlinks/menu_shortlink';
		$this->load->view('control/control_layout', $data);

	}else{
		
		if($this->input->post('slug')){
			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
		}

		
		$newshortlink = array( 'alias' => $this->input->post('alias'), 
	 'url' => $this->input->post('url'), 
	 'created_at' => $this->input->post('created_at'), 
	);
		#save
		$this->shortlink->add_record($newshortlink);
		$this->session->set_flashdata('success', 'shortlink creado. <a href="shortlinks/detail/'.$this->db->insert_id().'">Ver</a>');
		redirect('control/shortlinks', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar shortlink';	
	$data['content'] = 'control/shortlinks/edit_shortlink';
	$data['menu'] = 'control/shortlinks/menu_shortlink';
	$data['query'] = $this->shortlink->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}

//update
public function update(){
	$this->load->helper('form');
	$this->load->library('form_validation'); 
	$this->form_validation->set_rules('alias', 'Alias', 'required');

	$this->form_validation->set_rules('url', 'Url', 'required');

	$this->form_validation->set_rules('created_at', 'Created_at', 'required');


	$this->form_validation->set_message('required','El campo %s es requerido.');

	if ($this->form_validation->run() === FALSE){
		$this->load->helper('form');

		$data['title'] = 'Nuevo shortlink';
		$data['content'] = 'control/shortlinks/edit_shortlink';
		$data['menu'] = 'control/shortlinks/menu_shortlink';
		$data['query'] = $this->shortlink->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{		
		$id=  $this->input->post('id');

		if($this->input->post('slug')){
			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
		}

		$editedshortlink = array(  
	'alias' => $this->input->post('alias'),

	'url' => $this->input->post('url'),

	'created_at' => $this->input->post('created_at'),
	);
		#save
		$this->session->set_flashdata('success', 'shortlink Actualizado!');
		$this->shortlink->update_record($id, $editedshortlink);
		if($this->input->post('id')!=""){
			redirect('control/shortlinks', 'refresh');
		}else{
			redirect('control/shortlinks', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/shortlinks/comfirm_delete';
	$data['title'] = 'Eliminar shortlink';
	$data['menu'] = 'control/shortlinks/menu_shortlink';
	$data['query'] = $data['query'] = $this->shortlink->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);


}

//delete
public function delete(){

	$this->load->helper('form');
	$this->load->library('form_validation');

	$this->form_validation->set_rules('comfirm', 'comfirm', 'required');
	$this->form_validation->set_message('required','Por favor, confirme para eliminar.');


	if ($this->form_validation->run() === FALSE){
		#validation failed
		$this->load->helper('form');

		$data['content'] = 'control/shortlinks/comfirm_delete';
		$data['title'] = 'Eliminar shortlink';
		$data['menu'] = 'control/shortlinks/menu_shortlink';
		$data['query'] = $this->shortlink->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'shortlink eliminado!');

		$prod = $this->shortlink->get_record($this->input->post('id'));
			$path = 'images-shortlinks/'.$prod->filename;
			if(is_link($path)){
				unlink($path);
			}
		

		$this->shortlink->delete_record();
		redirect('control/shortlinks', 'refresh');
		

	}
}


} //end class

?>