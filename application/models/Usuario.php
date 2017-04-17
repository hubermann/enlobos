<?php

class Usuario extends CI_Model{

	public function __construct(){

	$this->load->database();

	}
	//all
	public function get_records($num,$start){
		$this->db->select()->from('usuarios')
		->where('status', 0)
		->order_by('id','ASC')
		->limit($num,$start);
		return $this->db->get()->result();
	}



	function check_role_usuario($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('usuarios');
		return $c->row('role_id');
	}

	function select_by_email($email){
		
		$this->db->where('email' ,$email);
		$this->db->limit(1);
		$c = $this->db->get('usuarios');

		return $c;


	}


//detail
	public function select_by_nickname($nickname){
		$this->db->where('nickname' ,$nickname);
		$this->db->limit(1);
		$c = $this->db->get('usuarios');

		return $c->row();
	}



	function check_credentials($email, $password){
		$this->db->where(array('email' => $email));
       		$query = $this->db->get('usuarios', 1, 0);

       		if ($query->num_rows != 1) return FALSE;

	       		$db_salt = $query->row('salt');
	       		$db_hash = $query->row('password');
	       		if ($db_hash === hash('sha512', $db_salt.$password))
				{
					// Contraseña correcta (creo session)
					$sess_array = array('id' => $query->row('id'),'email' => $query->row('email'),'role_id' => $query->row('role_id'));
					$this->session->set_userdata('logged_in', $sess_array);
					return TRUE;
				}
		//return false por defecto
		return FALSE;
	}

	function check_email_exist($email){

					$this->db->where('email',$email);
					$query = $this->db->get('usuarios', 1, 0);
					 #var_dump($query->num_rows());
					if ($query->num_rows() != 1){
						return FALSE;
					}else{

					return TRUE;
				}
		//return false por defecto
		return FALSE;
	}

function check_credentials_front($email, $password){

	$this->db->where(array('email' => $email, 'status'=>0));
				$query = $this->db->get('usuarios');


				#var_dump($query->result());
				if ($query->num_rows() != 1){
					return FALSE;
				} 


				if ($query->row('password') === hash('sha512', $query->row('salt').$password)){
		
				// Contraseña correcta (creo session)
				$sess_array = array('id' => $query->row('id'),'email' => $query->row('email'),'role_id' => $query->row('role_id'));
				$this->session->set_userdata('front_logged_in', $sess_array);
				return TRUE;
			}
	//return false por defecto
	return FALSE;
}


	//Cerrar session
	public function logout(){
    	$this->session->unset_userdata('logged_in');
			redirect('/', 'refresh');
	}


//Cerrar session FRONT
public function logout_front(){
		$this->session->unset_userdata('front_logged_in');
		redirect('publicaciones', 'refresh');
}



	//detail
	public function get_record($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('usuarios');

		return $c->row();
	}

	//total rows
	public function count_rows(){
		$this->db->select('id')->where('status', 0)->from('usuarios');
		$query = $this->db->get();
		return $query->num_rows();
	}



		//add new
		public function add_record($data){
			$this->db->insert('usuarios', $data);
			return $this->db->insert_id();

	}


		//update
		public function update_record($id, $data){

			$this->db->where('id', $id);
			$this->db->update('usuarios', $data);

		}

		//destroy
		public function delete_record(){

			$this->db->where('id', $this->uri->segment(4));
			$this->db->delete('usuarios');
		}


		/*
		public function traer_nombre($id){
					$this->db->where('usuarios_categoria_id' ,$id);
					$this->db->limit(1);
					$c = $this->db->get('usuarios');

					return $c->row('nombre');
				}

		*/

}

?>
