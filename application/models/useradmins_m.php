<?php  

class Useradmins_m extends CI_Model{


	
		public function try_login($email = NULL, $password = NULL){
       
       		//consulto BD con los datos (cuento la cantidad de encontrados)
	       	$this->db->select('*')->from('useradmin')
	       	->limit(1)
       		->where( array('email' => $email, 'password'=> $password));
    		$query = $this->db->count_all_results();


       		if ($query != 1) return FALSE;

				$query = $this->db->select('*')->from('useradmin')
       			->where( array('email' => $email, 'password'=> $password))
	        	->limit(1)
	       		->get();

				$sess_array = array('id' => $query->row('id'),'email' => $query->row('email'));
 				
				$this->session->set_userdata('logged_in', $sess_array);

				return TRUE;
	
			}
	
		
		//Cerrar session
		public function logout(){
        	$this->session->unset_userdata('logged_in');
   			redirect('/dashboard', 'refresh');
    	}
    


}
?>