<?php

class Solicitud_reset extends CI_Model{

  public function __construct(){

  $this->load->database();

  }
  //all
  public function get_records($num,$start){
    $this->db->select()->from('solicitudes_reset')->order_by('id','ASC')->limit($num,$start);
    return $this->db->get();

  }

  public function get_records_menu(){
    $this->db->select()->from('solicitudes_reset')->order_by('nombre','ASC');
    return $this->db->get();

  }

  //detail
  public function by_callback($call){
    $this->db->where('validacion_key' ,$call);
    $this->db->limit(1);
    $c = $this->db->get('solicitudes_reset');

    return $c->row();
  }

  //detail
  public function get_record($id){
    $this->db->where('id' ,$id);
    $this->db->limit(1);
    $c = $this->db->get('solicitudes_reset');

    return $c->row();
  }

  //total rows
  public function count_rows(){
    $this->db->select('id')->from('solicitudes_reset');
    $query = $this->db->get();
    return $query->num_rows();
  }



    //add new
    public function add_record($data){ $this->db->insert('solicitudes_reset', $data);


  }


    //update
    public function update_record($id, $data){

      $this->db->where('id', $id);
      $this->db->update('solicitudes_reset', $data);

    }

    //destroy
    public function delete_record($id){

      $this->db->where('id', $id);
      $this->db->delete('solicitudes_reset');
    }



    public function traer_nombre($id){
          $this->db->where('id' ,$id);
          $this->db->limit(1);
          $c = $this->db->get('solicitudes_reset');

          return $c->row('nombre');
        }



}

?>
