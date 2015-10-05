<?php 

class comercios extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('comercio');
	$this->load->model('categoria_comercio');
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
	$per_page = 10;
	$page = $this->uri->segment(3);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->comercio->count_rows() / $per_page);

		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/comercios/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'comercios';
	$data['menu'] = 'control/comercios/menu_comercio';
	$data['content'] = 'control/comercios/all';
	$data['query'] = $this->comercio->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

$data['title'] = 'comercio';
$data['content'] = 'control/comercios/detail';
$data['menu'] = 'control/comercios/menu_comercio';
$data['query'] = $this->comercio->get_record($this->uri->segment(4));
$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
$this->load->helper('form');
$data['title'] = 'Nuevo comercio';
$data['content'] = 'control/comercios/new_comercio';
$data['menu'] = 'control/comercios/menu_comercio';
$this->load->view('control/control_layout', $data);
}

//create
public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('razon_social', 'Razon_social', 'required');

	$this->form_validation->set_rules('categoria_id', 'Categoria_id', 'required');

	$this->form_validation->set_rules('direccion', 'Direccion', 'required');

	$this->form_validation->set_rules('descripcion_corta', 'Descripcion_corta', 'required');

	$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');


	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');
		$data['title'] = 'Nuevo comercios';
		$data['content'] = 'control/comercios/new_comercio';
		$data['menu'] = 'control/comercios/menu_comercio';
		$this->load->view('control/control_layout', $data);

	}else{
		
		$slug = url_title($this->input->post('razon_social'), 'dash', TRUE);

		
		
		$file  = $this->upload_file();
		if($_FILES['filename']['size'] > 0){
			if ( $file['status'] == 0 ){
				$this->session->set_flashdata('error', $file['msg']);
			}
		}else{
			$file['filename'] = '';
		}
		$newcomercio = array( 'razon_social' => $this->input->post('razon_social'), 
		 'categoria_id' => $this->input->post('categoria_id'), 
		 'slug' => $slug, 
		 'direccion' => $this->input->post('direccion'), 
		 'telefono' => $this->input->post('telefono'), 
		 'telefono2' => $this->input->post('telefono2'), 
		 'email' => $this->input->post('email'), 
		 'email2' => $this->input->post('email2'), 
		 'descripcion_corta' => $this->input->post('descripcion_corta'), 
		 'descripcion' => $this->input->post('descripcion'), 
		 'mapa' => $this->input->post('mapa'), 
		 'web' => $this->input->post('web'), 
		 'facebook' => $this->input->post('facebook'), 
		'filename' => $file['filename'], 
		);
		#save
		$this->comercio->add_record($newcomercio);
		$this->session->set_flashdata('success', 'comercio creado. <a href="comercios/detail/'.$this->db->insert_id().'">Ver</a>');
		redirect('control/comercios', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar comercio';	
	$data['content'] = 'control/comercios/edit_comercio';
	$data['menu'] = 'control/comercios/menu_comercio';
	$data['query'] = $this->comercio->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}

//update
public function update(){
	$this->load->helper('form');
	$this->load->library('form_validation'); 
	$this->form_validation->set_rules('razon_social', 'Razon_social', 'required');

	$this->form_validation->set_rules('categoria_id', 'Categoria_id', 'required');

	$this->form_validation->set_rules('direccion', 'Direccion', 'required');

	

	$this->form_validation->set_rules('descripcion_corta', 'Descripcion_corta', 'required');

	$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');


	$this->form_validation->set_message('required','El campo %s es requerido.');

	if ($this->form_validation->run() === FALSE){
		$this->load->helper('form');

		$data['title'] = 'Nuevo comercio';
		$data['content'] = 'control/comercios/edit_comercio';
		$data['menu'] = 'control/comercios/menu_comercio';
		$data['query'] = $this->comercio->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		if($_FILES['filename']['size'] > 0){
		
			$file  = $this->upload_file();
		
			if ( $file['status'] != 0 )
				{
				//guardo
				$comercio = $this->comercio->get_record($this->input->post('id'));
					 $path = 'images-comercios/'.$comercio->filename;
					 if(is_link($path)){
						unlink($path);
					 }
				
				
				$data = array('filename' => $file['filename']);
				$this->comercio->update_record($this->input->post('id'), $data);
				}
		
		
}		
		$id=  $this->input->post('id');

		
			$this->load->helper('url');
			$slug = url_title($this->input->post('razon_social'), 'dash', TRUE);
		

		$editedcomercio = array(  
		'razon_social' => $this->input->post('razon_social'),

		'categoria_id' => $this->input->post('categoria_id'),

		'slug' => $slug,

		'direccion' => $this->input->post('direccion'),

		'telefono' => $this->input->post('telefono'),

		'telefono2' => $this->input->post('telefono2'),

		'email' => $this->input->post('email'),

		'email2' => $this->input->post('email2'),

		'descripcion_corta' => $this->input->post('descripcion_corta'),

		'descripcion' => $this->input->post('descripcion'),

		'mapa' => $this->input->post('mapa'),

		'web' => $this->input->post('web'),

		'facebook' => $this->input->post('facebook'),
		);
		#save
		$this->session->set_flashdata('success', 'comercio Actualizado!');
		$this->comercio->update_record($id, $editedcomercio);
		if($this->input->post('id')!=""){
			redirect('control/comercios', 'refresh');
		}else{
			redirect('control/comercios', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/comercios/comfirm_delete';
	$data['title'] = 'Eliminar comercio';
	$data['menu'] = 'control/comercios/menu_comercio';
	$data['query'] = $data['query'] = $this->comercio->get_record($this->uri->segment(4));
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

		$data['content'] = 'control/comercios/comfirm_delete';
		$data['title'] = 'Eliminar comercio';
		$data['menu'] = 'control/comercios/menu_comercio';
		$data['query'] = $this->comercio->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'comercio eliminado!');

		$prod = $this->comercio->get_record($this->input->post('id'));
			$path = 'images-comercios/'.$prod->filename;
			if(is_link($path)){
				unlink($path);
			}
		

		$this->comercio->delete_record();
		redirect('control/comercios', 'refresh');
		

	}
}

public function upload_file(){

	//1 = OK - 0 = Failure
	$file = array('status' => '', 'filename' => '', 'msg' => '' );


	//check ext.
	$file_extensions_allowed = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
	$exts_humano = array('gif', 'png', 'jpeg', 'jpg');
	$exts_humano = implode(', ',$exts_humano);
	$ext = $_FILES['filename']['type'];
	#$ext = strtolower($ext);
	if(!in_array($ext, $file_extensions_allowed)){
		$exts = implode(', ',$file_extensions_allowed);

		$file['msg'] .="<p>".$_FILES['filename']['name']." <br />Puede subir archivos que tengan alguna de estas extenciones: ".$exts_humano."</p>";

	}else{
		include(APPPATH.'libraries/class.upload.php');
		$yukle = new upload;
		$yukle->set_max_size(1900000);
		$yukle->set_directory('./images-comercios');
		$yukle->set_tmp_name($_FILES['filename']['tmp_name']);
		$yukle->set_file_size($_FILES['filename']['size']);
		$yukle->set_file_type($_FILES['filename']['type']);
		$random = substr(md5(rand()),0,6);
		$name_whitout_whitespaces = str_replace(" ","-",$_FILES['filename']['name']);
		$imagname=''.$random.'_'.$name_whitout_whitespaces;
		#$thumbname='tn_'.$imagname;
		$yukle->set_file_name($imagname);


		$yukle->start_copy();


		if($yukle->is_ok()){
			
			if(count($this->data['thumbnail_sizes'])){
	    		foreach ($this->data['thumbnail_sizes'] as $thumb_size) {
	    			//create thumbnail
					$yukle->resize(1000,0);
					$yukle->set_thumbnail_name('tn_'.$thumb_size.'_'.$imagname);
					$result_thumb = $yukle->create_thumbnail();
					$yukle->set_thumbnail_size($thumb_size, 0);
	    		}
	    	}

			//UPLOAD ok
			$file['filename'] = $imagname;
			$file['status'] = 1;
		}
		else{
			$file['status'] = 0 ;
			$file['msg'] = 'Error al subir archivo';
		}

		//clean
		$yukle->set_tmp_name('');
		$yukle->set_file_size('');
		$yukle->set_file_type('');
		$imagname='';
	}//fin if(extencion)	


	return $file;
}


} //end class

?>