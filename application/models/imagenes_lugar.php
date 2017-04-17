<?php  
class Imagenes_lugar extends CI_Model{
	public function __construct(){
	$this->load->database();
	}
	//all
	public function get_records($num,$start){
		$this->db->select()->from('imagenes_lugares')->limit($num,$start);
		$rs = $this->db->get();
		return $rs->result();
	}
	
	
	
	function view_all($id){
		
		$this->db->where('lugar_id', $id);
		$rs =  $this->db->get('imagenes_lugares');
		return $rs->result();
		
		}
		
	//all by publiccacion
	public function imagenes_lugar($id_lugar){
		$this->db->select()->from('imagenes_lugares')->where('lugar_id',$id_lugar);
		$rs= $this->db->get();
		return $rs->result();
	}
	//detail
	public function get_record($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('imagenes_lugares');
		return $c->row(); 
	}
	public function traer_una($id){
		$this->db->where('lugar_id' ,$id);
		$this->db->limit(1)->order_by('id','ASC');
		$c = $this->db->get('imagenes_lugares');
		return $c->row(); 
	}
	
	public function get_records_menu(){
			$this->db->select()->from('imagenes_lugares')->order_by('id','ASC');
			return $this->db->get();
	
		}
	
	//total rows
	public function count_rows(){ 
		$this->db->select('id')->from('imagenes_lugares');
		$query = $this->db->get();
		return $query->num_rows();
	}
	//total rows
	public function total_por_lugar($id_lugar){ 
		$this->db->select('id')->from('imagenes_lugares')->where('lugar_id',$id_lugar);
		$query = $this->db->get();
		return $query->num_rows();
	}
		//add new
		public function add_record($data){ 
		
		$this->db->insert('imagenes_lugares', $data);
		}
		//update
		public function update_record($id, $data){
			$this->db->where('id', $id);
			$this->db->update('imagenes_lugares', $data);
		}
		//destroy
		public function delete_record($id_imagen){
			$this->db->where('id', $id_imagen);
			$this->db->delete('imagenes_lugares');
		}
		public function delete_por_lugar($id_lugar){
			$this->db->where('lugar_id', $id_lugar);
			$this->db->delete('imagenes_lugares');
		}
		
		public function get_filename($id){
			$this->db->where('id' ,$id);
			$query = $this->db->get('imagenes_lugares');
			$this->db->limit(1);
			$res = $query->row();
			return $res->filename;
		}
}
?>