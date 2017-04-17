<?php  

class Shortlink extends CI_Model{

	public function __construct(){

	$this->load->database();

	}
	//all
	public function get_records($num,$start){
		$this->db->select()->from('shortlinks')->order_by('id','ASC')->limit($num,$start);
		return $this->db->get();

	}

	//detail
	public function get_record($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('shortlinks');

		return $c->row(); 
	}
	
	//total rows
	public function count_rows(){ 
		$this->db->select('id')->from('shortlinks');
		$query = $this->db->get();
		return $query->num_rows();
	}



		//add new
		public function add_record($data){ $this->db->insert('shortlinks', $data);
				

	}


		//update
		public function update_record($id, $data){

			$this->db->where('id', $id);
			$this->db->update('shortlinks', $data);

		}

		//destroy
		public function delete_record(){

			$this->db->where('id', $this->uri->segment(4));
			$this->db->delete('shortlinks');
		}

		public function alias_from_url($url){
		
			$query = $this->db->get_where('shortlinks', array('url' => $url), 1, 0);

			if ($query->num_rows() > 0){

				foreach ($query->result() as $row){

				$alias = $row->alias;

				}
			return $alias;
			}
		}


		public function bring_url($alias){
					$this->db->where('alias' ,$alias);
					$this->db->limit(1);
					$c = $this->db->get('shortlinks');

					return $c->row('url'); 
				}



	public function create($url){
	//echo '>>'.$this->input->get('url');
	$short_url = "";
	$link_length =6;

	$url = prep_url($url);


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

return $short_url;

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
		public function traer_nombre($id){
					$this->db->where('shortlinks_categoria_id' ,$id);
					$this->db->limit(1);
					$c = $this->db->get('shortlinks');

					return $c->row('nombre'); 
				}
		
		*/

}

?>