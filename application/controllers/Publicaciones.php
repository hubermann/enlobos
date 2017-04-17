<?php  

class Publicaciones extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('usuario','categoria_publicacion', 'publicacion', 'shortlink'));
		$this->load->helper(array('url','form'));
		$this->load->library('session');

		if( ! ini_get('date.timezone') ){
        date_default_timezone_set('GMT');
        setlocale(LC_ALL,"es_ES");
        setlocale(LC_TIME, 'es_AR');
    }


	}

	public function index(){
		//Pagination
		$per_page = 15;
		$page = $this->uri->segment(3);
		if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
			$data['pagination_links'] = "";
			$total_pages = ceil($this->publicacion->count_rows() / $per_page);

			if ($total_pages > 1){ 
				for ($i=1;$i<=$total_pages;$i++){ 
				if ($page == $i) 
					//si muestro el índice de la página actual, no coloco enlace 
					$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
				else 
					//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
					$data['pagination_links']  .= '<li><a href="'.base_url().'publicaciones/'.$i.'" > '. $i .'</a></li>'; 
			} 
		}


		$data['publicaciones'] = $this->publicacion->get_records_inicio($per_page,$start);
		$data['content'] = "publicaciones/index";
		$this->load->view('front_layout', $data);
	}


	//por categoria
		public function por_categoria(){
		//Pagination
		$per_page = 15;
$categoria = $this->uri->segment(3);
$page = $this->uri->segment(4);

$categoria_slug = $this->categoria_publicacion->traer_nombre($categoria);
		if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
			$data['pagination_links'] = "";
			$total_pages = ceil($this->publicacion->count_rows_por_categoria($categoria) / $per_page);

			if ($total_pages > 1){ 
				for ($i=1;$i<=$total_pages;$i++){ 
				if ($page == $i) 
					//si muestro el índice de la página actual, no coloco enlace 
					$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
				else 
					//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
					$data['pagination_links']  .= '<li><a href="'.base_url('categoria/'.$categoria_slug.'/'.$i).'" > '. $i .'</a></li>'; 
			} 
		}


		$data['publicaciones'] = $this->publicacion->get_records_por_categoria($per_page,$start, $categoria);
		$data['content'] = "publicaciones/por_categoria";
		$this->load->view('front_layout', $data);
	}

		public function busqueda(){
			$busqueda = $this->input->get('key');
		//Pagination
		$per_page = 15;
		$page = $this->uri->segment(3);
		if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
			$data['pagination_links'] = "";
			$total_pages = ceil($this->publicacion->count_rows_busqueda($busqueda) / $per_page);

			if ($total_pages > 1){ 
				for ($i=1;$i<=$total_pages;$i++){ 
				if ($page == $i) 
					//si muestro el índice de la página actual, no coloco enlace 
					$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
				else 
					//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
					$data['pagination_links']  .= '<li><a href="'.base_url('busqueda/'.$i.'" > '. $i ).'</a></li>'; 
			} 
		}

		


		$data['publicaciones'] = $this->publicacion->get_records_busqueda($per_page,$start, $busqueda);
		$data['total_resultados'] = $this->publicacion->count_rows_busqueda($busqueda);
		$data['content'] = "publicaciones/busqueda";
		$this->load->view('front_layout', $data);
	}


	public function by_tag(){
		#echo  '>>>>>>'.$busqueda = $this->uri->segment(3);
		//Pagination
		$per_page = 15;
		$page = $this->uri->segment(3);
		if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
			$data['pagination_links'] = "";
			$total_pages = ceil($this->publicacion->count_rows_busqueda($busqueda) / $per_page);

			if ($total_pages > 1){ 
				for ($i=1;$i<=$total_pages;$i++){ 
				if ($page == $i) 
					//si muestro el índice de la página actual, no coloco enlace 
					$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
				else 
					//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
					$data['pagination_links']  .= '<li><a href="'.base_url('busqueda/'.$i.'" > '. $i ).'</a></li>'; 
			} 
		}
		$data['publicaciones'] = $this->publicacion->get_records_busqueda($per_page,$start, $busqueda);
		$data['total_resultados'] = $this->publicacion->count_rows_busqueda($busqueda);
		$data['content'] = "publicaciones/busqueda";
		$this->load->view('front_layout', $data);
	}



	public function mis_publicaciones(){
		if(!$this->session->userdata('front_logged_in')){redirect('/');}

		$array_user = array();
    $array_user= $this->session->userdata('front_logged_in');


		//Pagination
		$per_page = 15;
		$page = $this->uri->segment(3);
		if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
			$data['pagination_links'] = "";
			$total_pages = ceil($this->publicacion->count_rows() / $per_page);

			if ($total_pages > 1){ 
				for ($i=1;$i<=$total_pages;$i++){ 
				if ($page == $i) 
					//si muestro el índice de la página actual, no coloco enlace 
					$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
				else 
					//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
					$data['pagination_links']  .= '<li><a href="'.base_url().'publicaciones/'.$i.'" > '. $i .'</a></li>'; 
			} 
		}


		$data['publicaciones'] = $this->publicacion->get_records_by_user($per_page,$start, $array_user['id']);
		$data['content'] = "publicaciones/mis_publicaciones";
		$this->load->view('front_layout', $data);
	}


	public function by_user(){
		
		$usuario_seleccionado = $this->usuario->select_by_nickname( $this->uri->segment(2) );

		//Pagination
		$per_page = 15;
		$page = $this->uri->segment(3);
		if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
			$data['pagination_links'] = "";
			$total_pages = ceil($this->publicacion->count_rows() / $per_page);

			if ($total_pages > 1){ 
				for ($i=1;$i<=$total_pages;$i++){ 
				if ($page == $i) 
					//si muestro el índice de la página actual, no coloco enlace 
					$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
				else 
					//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
					$data['pagination_links']  .= '<li><a href="'.base_url('user/'.$usuario_seleccionado->nickname.'/'.$i).'" > '. $i .'</a></li>'; 
			} 
		}

		$data['nickname'] = $usuario_seleccionado->nickname;
		$data['avatar'] = $usuario_seleccionado->filename;
		$data['profile'] = $usuario_seleccionado->profile;
		$data['publicaciones'] = $this->publicacion->get_records_by_user($per_page,$start, $usuario_seleccionado->id);
		$data['content'] = "publicaciones/publicaciones_por_user";
		$this->load->view('front_layout', $data);
	}



	public function nueva(){
		if(!$this->session->userdata('front_logged_in')){
			$this->session->set_flashdata('warning', 'Necesitas loguearte.');
			redirect('/ingreso');}
		$data['content'] = "publicaciones/new";
		#$tags = $this->publicacion->all_tags();

		$this->load->view('front_layout', $data);
	}

	public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('titulo', 'Titulo', 'required');

	$this->form_validation->set_rules('descripcion_corta', 'Descripcion corta', 'required|max_length[200]');
	$this->form_validation->set_rules('descripcion_completa', 'Descripcion completa', 'required');
	$this->form_validation->set_rules('categoria_id', 'Categoria_id', 'required');
	$this->form_validation->set_message('required', 'El campo "%s" es requerido.');
	$this->form_validation->set_message('max_length', 'Excedido el limite de caracteres para %s');

	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');

		$data['content'] = 'publicaciones/new';
		$this->load->view('front_layout', $data);

	}else{
		
		
			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
	
		$created_at = date("y-m-d h:i:s");	

		$newpublicacion = array( 'titulo' => $this->input->post('titulo'), 
		 'descripcion_corta' => $this->input->post('descripcion_corta'), 
		 'descripcion_completa' => $this->input->post('descripcion_completa'), 
		 'owner' => $this->input->post('owner'), 
		 'visitas' => 0, 
		 'tags' => $this->input->post('tags'), 
		 'categoria_id' => $this->input->post('categoria_id'), 
		 'provincia_id' => $this->input->post('provincia_id'), 
		 'pais_id' => $this->input->post('pais_id'), 
		 'ciudad' => $this->input->post('ciudad'), 
		 'modalidad_horarios' => "", 
		 'finalizado' => 0, 
		 'aprobado' => 1, 
		 'created_at' => $created_at, 
		 'duracion' => $this->input->post('duracion'), 
		 'slug' => $slug, 
		);
		#save
		$this->publicacion->add_record($newpublicacion);
		$this->session->set_flashdata('success', 'Publicacion creada');
		redirect('publicaciones/'.$slug.'/'.$this->db->insert_id(), 'refresh');

	}



}

//Show
public function show(){

			$query = $this->publicacion->get_record($this->uri->segment(3));

			if($query->titulo == ""){  redirect('/');}

    	$categoria = $this->categoria_publicacion->traer_nombre($query->categoria_id);
			$provincias = $this->config->item('provincias_list');

			$ciudad = "";
			$provincia = "";
			if($query->provincia_id != 0){$provincia = "Provincia: ".$provincias[$query->provincia_id]; }
			if($query->ciudad){$ciudad = " | Ciudad: ".$query->ciudad; }

			$url_publicacion = base_url($query->slug.'/'.$query->id);
			$url_short = $this->shortlink->create($url_publicacion);


			$data['meta_description'] = '<meta name="description" content="Busqueda laboral en '.base_url().': '.$query->descripcion_corta.'">';
	
			$data['meta_title'] = $query->titulo.' | Recruiters tools';
			$data['og_info'] = '
		    <!-- You can use open graph tags to customize link previews.
		    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
		    <meta property="og:url"           content="'.base_url($query->slug.'/'.$query->id).'" />
		    <meta property="og:type"          content="'.base_url().'" />
		    <meta property="og:title"         content="'.$query->titulo.'" />
		    <meta property="og:description"   content="'.$query->descripcion_corta.'" />
		    <meta property="og:image"         content="'.base_url('/logo.jpg').'" />';

    	
	//info del que publica para mostar su nick con link hacia su perfil
	$publicante = $this->usuario->get_record($query->owner);
	

	$data['nickname'] = $publicante->nickname;
	$data['url_short'] = $url_short;
	$data['content'] = 'publicaciones/show';
	$data['categoria'] = $categoria;
	$data['ciudad'] = $ciudad;
	$data['provincia'] = $provincia;
	$data['titulo'] = $query->titulo;
	$data['id_publicacion'] = $query->id;
	$data['tags'] = $query->tags;
	$data['descripcion_corta'] = $query->descripcion_corta;
	$data['descripcion_completa'] = $query->descripcion_completa;
	$data['slug'] = $query->slug;
	$data['created_at'] = $this->publicacion->time_elapsed_string($query->created_at);

	//update visitas
	$visitas_actuales= $query->visitas;
	$nuevo_visitas = $visitas_actuales + 1;
	$editedvisitas = array(  'visitas' => $nuevo_visitas );
	#save
	$this->publicacion->update_record($query->id, $editedvisitas);

	$this->load->view('front_layout', $data);
}


//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar publicacion';	
	$data['content'] = 'publicaciones/editar';
	$publicacion = $this->publicacion->get_record($this->uri->segment(3));
	//empty
	if(!$publicacion){ redirect('publicaciones');}

	

		$array_user = array();
    $array_user= $this->session->userdata('front_logged_in');
    //NOT OWNER
    if( $array_user['id'] != $publicacion->owner ){ redirect('publicaciones'); }

  $data['query'] = $publicacion;
	$this->load->view('front_layout', $data);
}

//update
public function update(){
	
		$this->load->helper('form');
		$this->load->library('form_validation'); 

		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('descripcion_corta', 'Descripcion corta', 'required|max_length[200]');
		$this->form_validation->set_rules('descripcion_completa', 'Descripcion completa', 'required');

		$this->form_validation->set_message('required','El campo %s es requerido.');
		$this->form_validation->set_message('max_length', 'Excedido el limite de caracteres para %s');

		if ($this->form_validation->run() === FALSE){
			$this->load->helper('form');


			$data['title']= 'Editar publicacion';	
			$data['content'] = 'publicaciones/editar';
			$data['query'] = $this->publicacion->get_record($this->input->post('id'));
			$this->load->view('front_layout', $data);
		}else{		
		$id=  $this->input->post('id');


			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
			$updated_at = date("y-m-d h:i:s");	

			$editedpublicacion = array(  
			'titulo' => $this->input->post('titulo'),

			'descripcion_corta' => $this->input->post('descripcion_corta'),

			'descripcion_completa' => $this->input->post('descripcion_completa'),

			'tags' => $this->input->post('tags'),
			'categoria_id' => $this->input->post('categoria_id'),
			'provincia_id' => $this->input->post('provincia_id'),
			'pais_id' => $this->input->post('pais_id'),
			'ciudad' => $this->input->post('ciudad'),
			'modalidad_horarios' => "",
			'finalizado' => $this->input->post('finalizado'),
			'aprobado' => $this->input->post('aprobado'),
			'duracion' => $this->input->post('duracion'), 
			'slug' => $slug,
			'updated_at' => $updated_at
			);
			#save
			$this->session->set_flashdata('success', 'publicacion Actualizada!');
			$this->publicacion->update_record($id, $editedpublicacion);
			if($this->input->post('id')!=""){
				redirect($slug.'/'.$id, 'refresh');
			}else{
				redirect('publicaciones', 'refresh');
			}



		}



}


//delete comfirm		
public function delete_comfirm(){
	if(!$this->session->userdata('front_logged_in')){redirect('/');}

	$user_loggued = array();
	$user_loggued = $this->session->userdata('front_logged_in');

	$this->load->helper('form');
	$data['content'] = 'publicaciones/comfirm_delete';
	$data['title'] = 'Eliminar publicacion';
	$data['menu'] = 'publicaciones/menu_publicacion';
	$publicacion =  $this->publicacion->get_record($this->uri->segment(3));
	if(!$publicacion || $publicacion->owner != $user_loggued['id'] ){ redirect('/'); }
	$data['query'] = $publicacion;
	$this->load->view('front_layout', $data);



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

		if(!$this->session->userdata('front_logged_in')){redirect('/');}

		$user_loggued = array();
		$user_loggued = $this->session->userdata('front_logged_in');


		$data['content'] = 'publicaciones/comfirm_delete';
		$data['title'] = 'Eliminar publicacion';
		$data['menu'] = 'publicaciones/menu_publicacion';
		$publicacion =  $this->publicacion->get_record($this->input->post('id'));
		if(!$publicacion || $publicacion->owner != $user_loggued['id'] ){ redirect('/'); }
		$data['query'] = $publicacion;

		$this->load->view('front_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'publicacion eliminado!');

		
		

		$this->publicacion->delete_record($this->input->post('id'));
		redirect('publicaciones', 'refresh');
		

	}
}









	
} //end class

?>