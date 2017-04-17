<?php 

class lugares extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('lugar');$this->load->model('imagenes_lugar');
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

	$this->data['thumbnail_sizes'] = array(300,900); //thumbnails sizes 

}

public function index(){
	//Pagination
	$per_page = 10;
	$page = $this->uri->segment(3);
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
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/lugares/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'lugares';
	$data['menu'] = 'control/lugares/menu_lugar';
	$data['content'] = 'control/lugares/all';
	$data['query'] = $this->lugar->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

$data['title'] = 'lugar';
$data['content'] = 'control/lugares/detail';
$data['menu'] = 'control/lugares/menu_lugar';
$data['query'] = $this->lugar->get_record($this->uri->segment(4));
$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
$this->load->helper('form');
$data['title'] = 'Nuevo lugar';
$data['content'] = 'control/lugares/new_lugar';
$data['menu'] = 'control/lugares/menu_lugar';
$this->load->view('control/control_layout', $data);
}

//create
public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('nombre', 'Nombre', 'required');

	$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

	$this->form_validation->set_rules('tags', 'Tags', 'required');

	#$this->form_validation->set_rules('visitas', 'Visitas', 'required');

	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');
		$data['title'] = 'Nuevo lugares';
		$data['content'] = 'control/lugares/new_lugar';
		$data['menu'] = 'control/lugares/menu_lugar';
		$this->load->view('control/control_layout', $data);

	}else{
		
		
			$this->load->helper('url');
			$slug = url_title($this->input->post('nombre'), 'dash', TRUE);
		

		
		$newlugar = array( 'nombre' => $this->input->post('nombre'), 
		 'slug' => $slug, 
		 'descripcion' => $this->input->post('descripcion'), 
		 'tags' => $this->input->post('tags'), 
		 'visitas' => $this->input->post('visitas'), 
		);
		#save
		$this->lugar->add_record($newlugar);
		$this->session->set_flashdata('success', 'lugar creado. <a href="lugares/detail/'.$this->db->insert_id().'">Ver</a>');
		redirect('control/lugares', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar lugar';	
	$data['content'] = 'control/lugares/edit_lugar';
	$data['menu'] = 'control/lugares/menu_lugar';
	$data['query'] = $this->lugar->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}

//update
public function update(){
	$this->load->helper('form');
	$this->load->library('form_validation'); 
	$this->form_validation->set_rules('nombre', 'Nombre', 'required');

	$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

	$this->form_validation->set_rules('tags', 'Tags', 'required');

	#$this->form_validation->set_rules('visitas', 'Visitas', 'required');


	$this->form_validation->set_message('required','El campo %s es requerido.');

	if ($this->form_validation->run() === FALSE){
		$this->load->helper('form');

		$data['title'] = 'Nuevo lugar';
		$data['content'] = 'control/lugares/edit_lugar';
		$data['menu'] = 'control/lugares/menu_lugar';
		$data['query'] = $this->lugar->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{		
		$id=  $this->input->post('id');

	
			$this->load->helper('url');
			$slug = url_title($this->input->post('nombre'), 'dash', TRUE);
		

		$editedlugar = array(  
		'nombre' => $this->input->post('nombre'),

		'slug' => $slug,

		'descripcion' => $this->input->post('descripcion'),

		'tags' => $this->input->post('tags'),

		'visitas' => $this->input->post('visitas'),
		);
		#save
		$this->session->set_flashdata('success', 'lugar Actualizado!');
		$this->lugar->update_record($id, $editedlugar);
		if($this->input->post('id')!=""){
			redirect('control/lugares', 'refresh');
		}else{
			redirect('control/lugares', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/lugares/comfirm_delete';
	$data['title'] = 'Eliminar lugar';
	$data['menu'] = 'control/lugares/menu_lugar';
	$data['query'] = $data['query'] = $this->lugar->get_record($this->uri->segment(4));
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

		$data['content'] = 'control/lugares/comfirm_delete';
		$data['title'] = 'Eliminar lugar';
		$data['menu'] = 'control/lugares/menu_lugar';
		$data['query'] = $this->lugar->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'lugar eliminado!');

		$prod = $this->lugar->get_record($this->input->post('id'));
			$path = 'images-lugares/'.$prod->filename;
			if(is_link($path)){
				unlink($path);
			}
		

		$this->lugar->delete_record();
		redirect('control/lugares', 'refresh');
		

	}
}

	public function imagenes(){
	$this->load->helper('form');
	$data['content'] = 'control/lugares/imagenes';
	$data['title'] = 'Imagenes ';
	$data['menu'] = 'control/lugares/menu_lugar';
	$data['query_imagenes'] = $this->imagenes_lugar->imagenes_lugar($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}


	public function guardar_orden(){
		if($this->input->post('orden_imagenes')){
			$orden  = $this->input->post('orden_imagenes');
			//nuevo array con imagenes en el orden seleccionado
			$nuevo_orden = array();
			foreach ( $orden as $key => $value ) {
				$img = $this->imagenes_lugar->get_record($key);
				array_push($nuevo_orden, $img->filename);
				
			}
	
		}
		
		$this->imagenes_lugar->delete_por_lugar($this->input->post('id'));
		foreach ($nuevo_orden as $value) {
			$nueva_imagen = array('lugar_id' => $this->input->post('id'),'filename' => $value );
			$this->imagenes_lugar->add_record($nueva_imagen);
		}
		redirect('control/lugares/imagenes/'.$this->input->post('id'));
	}



public function add_imagen(){
	$hubo_imagen=0; 
	$mensaje_imagen ="";
	//adjunto
	if($_FILES['adjunto']['size'] > 0){
		//imagen 1
		$file  = $this->upload_file();
		if ( $file['status'] != 0 ){
			//guardo
			$nueva_imagen = array('lugar_id' => $this->input->post('id'),'filename' => $file['filename'] );
			$this->imagenes_lugar->add_record($nueva_imagen);
			$mensaje_imagen .= "Imagen 1 cargada. ";
			$hubo_imagen=1;
		}
	}
	//adjunto2
	if($_FILES['adjunto2']['size'] > 0){
		
		//imagen 1
		$file2  = $this->upload_file2();
		if ( $file2['status'] != 0 ){
			//guardo
			$nueva_imagen = array('lugar_id' => $this->input->post('id'),'filename' => $file2['filename'] );
			$this->imagenes_lugar->add_record($nueva_imagen);
			$mensaje_imagen .= "Imagen 2 cargada. ";
			$hubo_imagen=1;
		}
	}
	//adjunto3
	if($_FILES['adjunto3']['size'] > 0){
		
		//imagen 1
		$file3  = $this->upload_file3();
		if ( $file3['status'] != 0 ){
			//guardo
			$nueva_imagen = array('lugar_id' => $this->input->post('id'),'filename' => $file3['filename'] );
			$this->imagenes_lugar->add_record($nueva_imagen);
			$mensaje_imagen .= "Imagen 3 cargada. ";
			$hubo_imagen=1;
		}
	}
		if($hubo_imagen=1){
			#save
			$this->session->set_flashdata('success', $mensaje_imagen );
			redirect('control/lugares/imagenes/'.$this->input->post('id'));
		}
	$this->session->set_flashdata('error', $file['msg']);
	redirect('control/lugares/imagenes/'.$this->input->post('id'));
}

public function delete_imagen(){
	$id_imagen = $this->uri->segment(4); 
	 
	$imagen = $this->imagenes_lugar->get_record($id_imagen);
	$path = 'images-lugares/'.$imagen->filename;
	unlink($path);
	
	$this->imagenes_lugar->delete_record($id_imagen);	
	#echo "Eliminada : ".$imagen->filename;
}



/*******  FILE ADJUNTO  ********/
public function upload_file(){
	
	//1 = OK - 0 = Failure
	$file = array('status' => '', 'filename' => '', 'msg' => '' );
	
	array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	//check extencion
	/*
	$file_extensions_allowed = array('application/pdf', 'application/msword', 'application/rtf', 'application/vnd.ms-excel','application/vnd.ms-powerpoint','application/zip','application/x-rar-compressed', 'text/plain');
	$exts_humano = array('PDF', 'WORD', 'RTF', 'EXCEL', 'PowerPoint', 'ZIP', 'RAR');
	*/
	$file_extensions_allowed = array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	$exts_humano = array('JPG', 'JPEG', 'PNG', 'GIF');
	
	
	$exts_humano = implode(', ',$exts_humano);
	$ext = $_FILES['adjunto']['type'];
	#$ext = strtolower($ext);
	if(!in_array($ext, $file_extensions_allowed)){
		$exts = implode(', ',$file_extensions_allowed);
		
	$file['msg'] .="<p>".$_FILES['adjunto']['name']." <br />Puede subir archivos que tengan alguna de estas extenciones: ".$exts_humano."</p>";
	$file['status'] = 0 ;
	}else{
		include_once(APPPATH.'libraries/class.upload.php');
		$yukle = new upload;
		$yukle->set_max_size(1900000);
		$yukle->set_directory('./images-lugares');
		$yukle->set_tmp_name($_FILES['adjunto']['tmp_name']);
		$yukle->set_file_size($_FILES['adjunto']['size']);
		$yukle->set_file_type($_FILES['adjunto']['type']);
		$random = substr(md5(rand()),0,6);
		$name_whitout_whitespaces = str_replace(" ","-",$_FILES['adjunto']['name']);
		$imagname=''.$random.'_'.$name_whitout_whitespaces;
		#$thumbname='tn_'.$imagname;
		$yukle->set_file_name($imagname);
		
	
		$yukle->start_copy();
		
		
		if($yukle->is_ok()){
		#$yukle->resize(600,0);
		#$yukle->set_thumbnail_name('tn_'.$random.'_'.$name_whitout_whitespaces);
		#$yukle->create_thumbnail();
		#$yukle->set_thumbnail_size(180, 0);
		
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
/*******  FILE ADJUNTO  ********/
public function upload_file2(){
	
	//1 = OK - 0 = Failure
	$file = array('status' => '', 'filename' => '', 'msg' => '' );
	
	array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	//check extencion
	/*
	$file_extensions_allowed = array('application/pdf', 'application/msword', 'application/rtf', 'application/vnd.ms-excel','application/vnd.ms-powerpoint','application/zip','application/x-rar-compressed', 'text/plain');
	$exts_humano = array('PDF', 'WORD', 'RTF', 'EXCEL', 'PowerPoint', 'ZIP', 'RAR');
	*/
	$file_extensions_allowed = array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	$exts_humano = array('JPG', 'JPEG', 'PNG', 'GIF');
	
	
	$exts_humano = implode(', ',$exts_humano);
	$ext = $_FILES['adjunto2']['type'];
	#$ext = strtolower($ext);
	if(!in_array($ext, $file_extensions_allowed)){
		$exts = implode(', ',$file_extensions_allowed);
		
	$file['msg'] .="<p>".$_FILES['adjunto2']['name']." <br />Puede subir archivos que tengan alguna de estas extenciones: ".$exts_humano."</p>";
	$file['status'] = 0 ;
	}else{
		include_once(APPPATH.'libraries/class.upload.php');
		$yukle = new upload;
		$yukle->set_max_size(1900000);
		$yukle->set_directory('./images-lugares');
		$yukle->set_tmp_name($_FILES['adjunto2']['tmp_name']);
		$yukle->set_file_size($_FILES['adjunto2']['size']);
		$yukle->set_file_type($_FILES['adjunto2']['type']);
		$random = substr(md5(rand()),0,6);
		$name_whitout_whitespaces = str_replace(" ","-",$_FILES['adjunto2']['name']);
		$imagname=''.$random.'_'.$name_whitout_whitespaces;
		#$thumbname='tn_'.$imagname;
		$yukle->set_file_name($imagname);
		
	
		$yukle->start_copy();
		
		
		if($yukle->is_ok()){
		#$yukle->resize(600,0);
		#$yukle->set_thumbnail_name('tn_'.$random.'_'.$name_whitout_whitespaces);
		#$yukle->create_thumbnail();
		#$yukle->set_thumbnail_size(180, 0);
		
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
/*******  FILE ADJUNTO  ********/
public function upload_file3(){
	
	//1 = OK - 0 = Failure
	$file = array('status' => '', 'filename' => '', 'msg' => '' );
	
	array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	//check extencion
	/*
	$file_extensions_allowed = array('application/pdf', 'application/msword', 'application/rtf', 'application/vnd.ms-excel','application/vnd.ms-powerpoint','application/zip','application/x-rar-compressed', 'text/plain');
	$exts_humano = array('PDF', 'WORD', 'RTF', 'EXCEL', 'PowerPoint', 'ZIP', 'RAR');
	*/
	$file_extensions_allowed = array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	$exts_humano = array('JPG', 'JPEG', 'PNG', 'GIF');
	
	
	$exts_humano = implode(', ',$exts_humano);
	$ext = $_FILES['adjunto3']['type'];
	#$ext = strtolower($ext);
	if(!in_array($ext, $file_extensions_allowed)){
		$exts = implode(', ',$file_extensions_allowed);
		
	$file['msg'] .="<p>".$_FILES['adjunto3']['name']." <br />Puede subir archivos que tengan alguna de estas extenciones: ".$exts_humano."</p>";
	$file['status'] = 0 ;
	}else{
		include_once(APPPATH.'libraries/class.upload.php');
		$yukle = new upload;
		$yukle->set_max_size(1900000);
		$yukle->set_directory('./images-lugares');
		$yukle->set_tmp_name($_FILES['adjunto3']['tmp_name']);
		$yukle->set_file_size($_FILES['adjunto3']['size']);
		$yukle->set_file_type($_FILES['adjunto3']['type']);
		$random = substr(md5(rand()),0,6);
		$name_whitout_whitespaces = str_replace(" ","-",$_FILES['adjunto2']['name']);
		$imagname=''.$random.'_'.$name_whitout_whitespaces;
		#$thumbname='tn_'.$imagname;
		$yukle->set_file_name($imagname);
		
	
		$yukle->start_copy();
		
		
		if($yukle->is_ok()){
		#$yukle->resize(600,0);
		#$yukle->set_thumbnail_name('tn_'.$random.'_'.$name_whitout_whitespaces);
		#$yukle->create_thumbnail();
		#$yukle->set_thumbnail_size(180, 0);
		
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