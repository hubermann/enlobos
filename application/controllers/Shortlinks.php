<?php 

class shortlinks extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('shortlink');
	$this->load->helper('url');
	$this->load->library('session');



	if( ! ini_get('date.timezone') ){
	    date_default_timezone_set('GMT');
	    setlocale(LC_ALL,"es_ES");
	    setlocale(LC_TIME, 'es_AR');
	}

	$this->data['thumbnail_sizes'] = array(); //thumbnails sizes 

}

public function index(){
	$url = "";
	$alias = $this->uri->segment(2);
	
	if($alias){	$url = $this->shortlink->bring_url($alias); }

	if($url!=""){redirect($url);}else{ show_404();}

}




//create


/*
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

*/




public function create(){
	//echo '>>'.$this->input->get('url');
	$short_url = "";
	$link_length =6;

	$url = prep_url($this->input->get('url'));


// Check to see if this URL has an Alias

$existing_alias = $this->alias_from_url($url);

// Generate a new alias if needed

if ($existing_alias == ""){

	$this->load->helper('string');

	$alias = random_string('alnum', $link_length);

	while ($this->does_alias_exist($alias)){

	$alias = random_string('alnum', $link_length);

	}

	$new_url = array( 'url'=>$url, 'alias' =>$alias );

	$this->shortlink->add_record($new_url);

	$short_url = $alias;

}else{

$short_url = $existing_alias;

}

// display the short url

echo $short_url;

}




function alias_from_url($url){

	$alias = "";

	$alias = $this->shortlink->alias_from_url($url);

	return $alias;


}




function does_alias_exist($alias){

	$this->db->select('id');

	$query = $this->db->get_where('shortlinks', array('alias' => $alias), 1, 0);

	if ($query->num_rows() > 0){

	return true;

	}else{

	return false;

	}

}

/*


function alias_from_url($url){

	$alias = "";

	$this->db->select('alias');

	$query = $this->db->get_where('links', array('url' => $url), 1, 0);

		if ($query->num_rows() > 0){

			foreach ($query->result() as $row){

			$alias = $row->alias;

			}

		}

	return $alias;

	}

}

*/



} //end class

?>