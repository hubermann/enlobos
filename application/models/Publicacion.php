<?php  

class Publicacion extends CI_Model{

	public function __construct(){

	$this->load->database();

	}
	//all
	public function get_records($num,$start){
		$this->db->select()->from('publicaciones')->order_by('id','DESC')->limit($num,$start);
		return $this->db->get()->result();

	}

	public function get_records_inicio($num,$start){
		$this->db->select()->from('publicaciones')
		->where('finalizado', 0)->order_by('id','DESC')->limit($num,$start);
		return $this->db->get()->result();

	}

	public function get_records_por_categoria($num,$start, $categoria){
		$this->db->select()->from('publicaciones')
		->where('categoria_id', $categoria)
		->where('finalizado', 0)->order_by('id','DESC')->limit($num,$start);
		return $this->db->get()->result();

	}

	public function get_records_busqueda($num,$start, $busqueda){
		$this->db->like('titulo',$busqueda)
		->or_like('descripcion_corta',$busqueda)
		->or_like('descripcion_completa',$busqueda)
		->from('publicaciones')
		->order_by('id','DESC')->limit($num,$start);
		return $this->db->get()->result();

	}

	public function get_records_by_user($num,$start, $id_user){
		
        
		$this->db->select()->from('publicaciones')
		->where('owner', $id_user)
		->order_by('id','ASC')->limit($num,$start);
		return $this->db->get()->result();

	}

	//detail
	public function get_record($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('publicaciones');

		return $c->row(); 
	}
	
	//total rows
	public function count_rows(){ 
		$this->db->select('id')->from('publicaciones');
		$query = $this->db->get();
		return $query->num_rows();
	}

	//total rows
	public function count_rows_busqueda($busqueda){ 
		$this->db->like('titulo',$busqueda)
		->or_like('descripcion_corta',$busqueda)
		->or_like('descripcion_completa',$busqueda)
		->from('publicaciones');
		$query = $this->db->get();
		return $query->num_rows();
	}

	//total rows
	public function count_rows_por_categoria($categoria){ 
		$this->db->select('id')->from('publicaciones')
		->where('categoria_id', $categoria);
		$query = $this->db->get();
		return $query->num_rows();
	}


	//total rows
	public function all_tags(){ 
		$this->db->select('tags')->from('publicaciones');
		$query = $this->db->get();
		$todos = "";
		foreach ($query->result() as $cadena) {
			
			foreach ($cadena as $value) {
				if($value != NULL ){$todos .= $value;}
			}
		}
		

		echo $todos;
	}


		//add new
		public function add_record($data){ $this->db->insert('publicaciones', $data);
				

	}


		//update
		public function update_record($id, $data){

			$this->db->where('id', $id);
			$this->db->update('publicaciones', $data);

		}

		//destroy
		public function delete_record($borrar){

			$this->db->where('id', $borrar);
			$this->db->delete('publicaciones');
		}




		
		public function traer_nombre($id){
					$this->db->where('publicaciones_categoria_id' ,$id);
					$this->db->limit(1);
					$c = $this->db->get('publicaciones');

					return $c->row('nombre'); 
				}
		
		public function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'a&ntilde;o',
        'm' => 'mes',
        'w' => 'semana',
        'd' => 'día',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
        	//si el key es != al de mes
        		if($k!='m'){
            	$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            }else{
            	//es mes
            	$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 'es' : '');
            }
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' atras' : 'ahora';
		}

}

?>