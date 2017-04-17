<?php 

class categorias_publicaciones extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('categoria_publicacion');
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
	$per_page = 15;
	$page = $this->uri->segment(3);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->categoria_publicacion->count_rows() / $per_page);

		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/categorias_publicaciones/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'categorias_publicaciones';
	$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
	$data['content'] = 'control/categorias_publicaciones/all';
	$data['query'] = $this->categoria_publicacion->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

$data['title'] = 'categoria_publicacion';
$data['content'] = 'control/categorias_publicaciones/detail';
$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
$data['query'] = $this->categoria_publicacion->get_record($this->uri->segment(4));
$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
$this->load->helper('form');
$data['title'] = 'Nuevo categoria_publicacion';
$data['content'] = 'control/categorias_publicaciones/new_categoria_publicacion';
$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
$this->load->view('control/control_layout', $data);
}

//create
public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
$this->form_validation->set_rules('nombre', 'Nombre', 'required');


	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');
		$data['title'] = 'Nuevo categorias_publicaciones';
		$data['content'] = 'control/categorias_publicaciones/new_categoria_publicacion';
		$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
		$this->load->view('control/control_layout', $data);

	}else{
		
	
			$this->load->helper('url');
			$slug = url_title($this->input->post('nombre'), 'dash', TRUE);
		

		
		$newcategoria_publicacion = array( 'nombre' => $this->input->post('nombre'), 
 'slug' => $slug, 
 'visitas' => $this->input->post('visitas'), 
);
		#save
		$this->categoria_publicacion->add_record($newcategoria_publicacion);
		$this->session->set_flashdata('success', 'categoria_publicacion creado. <a href="categorias_publicaciones/detail/'.$this->db->insert_id().'">Ver</a>');
		redirect('control/categorias_publicaciones', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar categoria_publicacion';	
	$data['content'] = 'control/categorias_publicaciones/edit_categoria_publicacion';
	$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
	$data['query'] = $this->categoria_publicacion->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}

//update
public function update(){
	$this->load->helper('form');
	$this->load->library('form_validation'); 
$this->form_validation->set_rules('nombre', 'Nombre', 'required');


	$this->form_validation->set_message('required','El campo %s es requerido.');

	if ($this->form_validation->run() === FALSE){
		$this->load->helper('form');

		$data['title'] = 'Nuevo categoria_publicacion';
		$data['content'] = 'control/categorias_publicaciones/edit_categoria_publicacion';
		$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
		$data['query'] = $this->categoria_publicacion->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{		
		$id=  $this->input->post('id');

	
			$this->load->helper('url');
			$slug = url_title($this->input->post('nombre'), 'dash', TRUE);
		

		$editedcategoria_publicacion = array(  
'nombre' => $this->input->post('nombre'),

'slug' => $slug,

'visitas' => $this->input->post('visitas'),
);
		#save
		$this->session->set_flashdata('success', 'categoria_publicacion Actualizado!');
		$this->categoria_publicacion->update_record($id, $editedcategoria_publicacion);
		if($this->input->post('id')!=""){
			redirect('control/categorias_publicaciones', 'refresh');
		}else{
			redirect('control/categorias_publicaciones', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/categorias_publicaciones/comfirm_delete';
	$data['title'] = 'Eliminar categoria_publicacion';
	$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
	$data['query'] = $data['query'] = $this->categoria_publicacion->get_record($this->uri->segment(4));
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

		$data['content'] = 'control/categorias_publicaciones/comfirm_delete';
		$data['title'] = 'Eliminar categoria_publicacion';
		$data['menu'] = 'control/categorias_publicaciones/menu_categoria_publicacion';
		$data['query'] = $this->categoria_publicacion->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'categoria_publicacion eliminado!');

		$prod = $this->categoria_publicacion->get_record($this->input->post('id'));
			$path = 'images-categorias_publicaciones/'.$prod->filename;
			if(is_link($path)){
				unlink($path);
			}
		

		$this->categoria_publicacion->delete_record();
		redirect('control/categorias_publicaciones', 'refresh');
		

	}
}


} //end class

?>