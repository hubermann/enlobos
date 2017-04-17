<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Front extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    #$this->load->helper('pais_visitante');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model( array('usuario', 'solicitud_reset') );
    #$this->load->library('geoip_lib');
    /*$this->load->model(array('evento',
    'destacados_nota',
    'destacados_evento',
    'nota',
    'imagenes_nota',
    'categoria_nota',
    'video','usuario', 'solicitud_reset'
    ));
    $this->load->model('pais');
    $this->load->model('categoria_evento');
    $this->load->model('speaker');
    $this->load->model('sponsor');
    */

    if( ! ini_get('date.timezone') ){
        date_default_timezone_set('GMT');
        setlocale(LC_ALL,"es_ES");
        setlocale(LC_TIME, 'es_AR');
    }


  }

/* LOGIN DEL USUARIO DESDE EL FRONT */
public function ingreso(){
  
  $proviene_desde = "/";
  if($this->input->post('proviene_desde')){$proviene_desde=$this->input->post('proviene_desde').'#comentarios';}
  
  $this->session->set_userdata("proviene_desde",$proviene_desde);


  $this->form_validation->set_rules('email', 'Email', 'required|trim');
  $this->form_validation->set_rules('password', 'Contraseña', 'required|trim');

  $this->form_validation->set_message('required', "El campo %s es requerido");
    #Paso validacion
    if ($this->form_validation->run()){



  $access_granted = $this->usuario->check_credentials_front( $this->input->post('email'), $this->input->post('password') );
  if($access_granted===FALSE){
    $this->session->set_flashdata('error', 'No se encuentra usuario con esos datos.');
    redirect('ingreso', 'refresh');
  }else{

   #  REDIRECT TO ANCHOR
      redirect('mis-publicaciones');

    
  }

}
//No paso la validacion
$data['content'] = 'ingreso';
$this->load->view('front_layout', $data);

}
/* LOGOUT */
public function desconectar(){
  $this->usuario->logout_front();
  redirect('publicaciones');
}


public function perfil(){
  if(!$this->session->userdata('front_logged_in')){
    $this->session->set_flashdata('error', 'Necesitas ingresar con tu email y contraseña.');
     redirect('ingreso');}
  $data['content'] = 'perfil';
  $this->load->view('front_layout', $data);
}



//create
public function registro(){
  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->form_validation->set_rules('nombre', 'Nombre', 'required');
  $this->form_validation->set_rules('apellido', 'Apellido', 'required');
  $this->form_validation->set_rules('email', 'Email', 'required|is_unique[usuarios.email]|valid_email');
  $this->form_validation->set_rules('nickname', 'Nickname', 'required|is_unique[usuarios.nickname]|min_length[3]|max_length[20]');
  $this->form_validation->set_rules('password', 'Password', 'required');
  $this->form_validation->set_rules('password_conf', 'Confirmacion password', 'required|min_length[3]|max_length[20]|matches[password]');


  $this->form_validation->set_message('required','El campo %s es requerido.');
  $this->form_validation->set_message('is_unique', 'Ya existe otro usuario registrado con ese %s');
  $this->form_validation->set_message('valid_email', "La direccion de email no tiene un formato valido.");
  $this->form_validation->set_message('password_conf', "La direccion de email no coincide con la confirmacion.");
  $this->form_validation->set_message('min_length', "Ingrese un minimo de 3 caracteres y 20 como maximo para %s.");
  $this->form_validation->set_message('matches', 'No coincide el campo "Password" con "Confirmacion password".');
if ($this->form_validation->run() === FALSE){

    $this->load->helper('form');
    $data['title'] = '';
    $data['content'] = 'registro';
    $this->load->view('front_layout', $data);

  }else{


    // set default time zone if not set at php.ini
    if (!date_default_timezone_get('date.timezone')){
    date_default_timezone_set('America/Buenos_Aires');
    }
    $ahora = date("Y-m-d H:i:s");


    //encrypto

    $salt = md5(uniqid(rand(), true));
    $hash = hash('sha512', $salt.$this->input->post('password'));

    $newusuario = array(
      'nombre' => $this->input->post('nombre'),
      'apellido' => $this->input->post('apellido'),
      'email' => $this->input->post('email'),
      'nickname' => $this->input->post('nickname'),
      'password' => $hash,
      'salt' => $salt,
      'role_id' => 4,
      'created_at' => $ahora,
      'updated_at' => $ahora,
      'filename' => "",
    );
    #save
    $ultimo = $this->usuario->add_record($newusuario);
    $this->session->set_flashdata('success', 'Tu cuenta ha sido creada!');
    //creo la session de logueado
    $sess_array = array('id' => $ultimo, 'email' => $this->input->post('email'),'role_id' => 4);
    $this->session->set_userdata('front_logged_in', $sess_array);

    redirect('perfil', 'refresh');

  }

}

//RESET
public function reset_password(){
  $data['content'] = 'reset_password';
  $this->load->view('front_layout', $data);
}
public function solicitud_reset_password(){

  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');

  $this->form_validation->set_message('required', "Ingrese su cuenta de email asociada.");
  $this->form_validation->set_message('valid_email', "Ingrese una cuenta de email valido.");
  $this->form_validation->set_message('email_check', "no existe usuario registrado con esa direccion de email.");

  if ($this->form_validation->run() === FALSE){
    $this->load->helper('form');

    $data['title'] = '';
    $data['content'] = 'reset_password';
    $this->load->view('front_layout', $data);
  }else{



    //verifico que exista ese email
    $usuario = $this->usuario->select_by_email($this->input->post('email'));
    #var_dump($usuario);
    if($usuario->row('id')){
      $nueva_solicitud = array(
        'user_id' => $usuario->row('id'),
        'user_email' => $usuario->row('email'),
        'validacion_key' => $validation_salt = md5(uniqid(rand(), true)),
        'ip' => $_SERVER['REMOTE_ADDR'],
      );

      $this->solicitud_reset->add_record($nueva_solicitud);

      /*EMAIL TO USER */
      $this->load->library('email');

      $this->email->initialize(array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.hubermann.com',
        'smtp_user' => 'info@trabajo-ya.com',
        'smtp_pass' => 'Summer6969',
        'smtp_port' => 25,
        'crlf' => "\r\n",
        'newline' => "\r\n",
        'mailtype'  => 'html',
        'charset' => 'utf-8',
        'wordwrap' => TRUE
      ));

    $link_reset = base_url('callback_reset_validation/'.$validation_salt);
    $message = '<h3>Cambiar contraseña de trabajo-ya.com</h3>
    <p>Hemos recibido su solicitud para cambiar la contraseña asociada a su correo electrónico en trabajo-ya.com. </p>

    <p>Para inicar el proceso de recuper de contrasela haga clic en el siguiente en enlace: <a href="'.$link_reset.'">'.$link_reset.'</a> </p>

    <p>Si ha recibido este correo por error, seguramente otra persona escribió su correo electrónico por error para cambiar la contraseña. Si no inició usted esta solicitud, no necesita realizar nada y descarte este correo electrónico.
    </p>
    <p>Muchas gracias.</p>';

    $this->email->from('no-reply@trabajo-ya.com', 'Cambiar contraseña de trabajo-ya.com');
    $this->email->to($usuario->row('email'));
    #$this->email->cc('another@another-example.com');
    #$this->email->bcc('them@their-example.com');
    $this->email->subject('Reset pass');
    $this->email->message($message);
    $this->email->send();

    #echo $this->email->print_debugger();



    $this->session->set_flashdata('success', 'Revisa tu correo electrónico. Te hemos enviado un enlace para que puedas recuperar tu contraseña. ');

    redirect('/', 'refresh');
}//fin if user_email exists

  }//fin (else) paso validacion

}

//valida si existe un user con esa direccion de email
public function email_check($email){
		return $this->usuario->check_email_exist($this->input->post('email'));
}

//viene de un mail con random para reset password
public function callback_reset_password(){

  if($this->uri->segment(2)!=""){//veo que no este vacia la solicituda
    //busco por callback
    $solicitud = $this->solicitud_reset->by_callback($this->uri->segment(2));
    if(!$solicitud){
      $this->session->set_flashdata('error', 'No se encuentra esa solicitud!');
      redirect('ingreso', 'refresh');
      }else{
        //Si encuentro por callback veo la fecha

        #strtotime($solicitud->created_at) < time();
        $session_reseteador = array('user_id' => $solicitud->user_id,'user_email' => $solicitud->user_email,'solicitud' => $solicitud->id);
        $this->session->set_userdata('password_reset', $session_reseteador);
        #var_dump($solicitud);
        //si la fecha es aceptable muestro form para nuevo pass
        $data['content'] = 'new_reseted_password';
        $this->load->view('front_layout', $data);
        //si la fecha caduco lo envio a otro lado


    }
  }

}


public function create_new_pass(){
  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->form_validation->set_rules('password', 'Password', 'required');
  $this->form_validation->set_rules('password_conf', 'Confirmacion password', 'required|min_length[3]|max_length[20]|matches[password]');
  //validaciones
  $this->form_validation->set_message('required','El campo %s es requerido.');
  $this->form_validation->set_message('password_conf', "La direccion de email no coincide con la confirmacion.");
  $this->form_validation->set_message('min_length', "Ingrese un minimo de 3 caracteres y 20 como maximo para password.");
  $this->form_validation->set_message('matches', 'No coincide el campo "Password" con "Confirmacion password".');

  if ($this->form_validation->run() === FALSE){
    $this->load->helper('form');

    $data['title'] = '';
    $data['content'] = 'new_reseted_password';
    $this->load->view('front_layout', $data);
  }else{
    //Esta todo ok cambio el password por el nuevo y elimino la solicitud de reset.
    // set default time zone if not set at php.ini
    if (!date_default_timezone_get('date.timezone'))
    {
    date_default_timezone_set('America/Buenos_Aires');
    }
    $ahora = date("Y-m-d H:i:s");

    $salt = md5(uniqid(rand(), true));
    $hash = hash('sha512', $salt.$this->input->post('password'));
    $editedusuario = array(
      'password' => $hash,
      'salt' => $salt,
      'updated_at' => $ahora,
    );
    #var_dump($this->session->userdata('password_reset'));
    $session_solicitud = array();
    $session_solicitud = $this->session->userdata('password_reset');

    $this->solicitud_reset->delete_record($session_solicitud['solicitud']);
    #save
    $this->session->set_flashdata('success', 'Contraseña Actualizada!');
    $this->usuario->update_record($session_solicitud['user_id'], $editedusuario);
    redirect('ingreso', 'refresh');
  }

}// fin create_new_pass



/* MODIFICAR PASSWORD */
public function perfil_modificar_password(){

  $array_user = array();
  $array_user = $this->session->userdata('front_logged_in');


  if(empty($array_user['id'])){ redirect('/');}

  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->form_validation->set_rules('pass_actual', 'Contraseña actual', 'required');
  $this->form_validation->set_rules('nuevo_pass', 'Nueva contraseña', 'required|min_length[3]|max_length[20]');
  $this->form_validation->set_rules('repeat_nuevo_pass', 'Nueva contraseña', 'required|min_length[3]|max_length[20]|matches[nuevo_pass]');
  $this->form_validation->set_message('required','El campo %s es requerido.');
  $this->form_validation->set_message('min_length', "Ingrese un minimo de 3 caracteres y 20 como maximo para password.");
  $this->form_validation->set_message('matches', 'No coincide el campo "Contraseña" con "Confirmacion contraseña".');
  if ($this->form_validation->run() === FALSE){
    $this->load->helper('form');

    $data['title'] = '';
    $data['content'] = 'perfil_modificar_password';
    $this->load->view('front_layout', $data);
  }else{
    $usuario_logged = $this->usuario->get_record($array_user['id']);
    $access_granted = $this->usuario->check_credentials_front($usuario_logged->email, $this->input->post('pass_actual') );
    //Si no coincide su password actual
  #  $this->session->set_flashdata('error', 'No coincide su password actual!');
    if(!$access_granted){ redirect('perfil-modificar-acceso');}

    // ALL OK PROCEDO A ACTUALIZAR
    $salt = md5(uniqid(rand(), true));
    $hash = hash('sha512', $salt.$this->input->post('nuevo_pass'));

    // set default time zone if not set at php.ini
    if (!date_default_timezone_get('date.timezone'))
    {
    date_default_timezone_set('America/Buenos_Aires');
    }
    $ahora = date("Y-m-d H:i:s");

    $updated_password = array(
      'password' => $hash,
      'salt' => $salt,
      'updated_at' => $ahora,
    );

    $this->session->set_flashdata('success', 'Password Actualizado!');
    $this->usuario->update_record($usuario_logged->id, $updated_password);
    redirect('perfil', 'refresh');


  }//fin (else) paso validacion

}
/* EDITAR DATOS DEL PERFIL */
public function perfil_modificar(){

  $session_logueado = array();
  $session_logueado = $this->session->userdata('front_logged_in');


  if(empty($session_logueado['id'])){ redirect('/');}
  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->form_validation->set_rules('nombre', 'Nombre', 'required');
  $this->form_validation->set_rules('apellido', 'Apellido', 'required');

  // para evitar que de error de que el mail no es unique
  $info_user = $this->usuario->get_record($session_logueado['id']);
  if($this->input->post('email') != $original_email = $info_user->email) {

     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuarios.email]');
     $this->form_validation->set_message('is_unique','Existe registro con ese mail.');
  } else {
     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
  }

  // para evitar que de error de que el nickanme no es unique
  if($this->input->post('nickname') != $original_nick = $info_user->nickname) {

     $this->form_validation->set_rules('nickname', 'Nickname', 'required|is_unique[usuarios.nickname]|min_length[3]|max_length[20]');
     $this->form_validation->set_message('is_unique','Existe registro con ese Nickname.');
  } else {
     $this->form_validation->set_rules('nickname', 'Nickname', 'required|min_length[3]|max_length[20]');
  }

  

  $this->form_validation->set_message('required','El campo %s es requerido.');

  $this->form_validation->set_message('valid_email','El mail debe ser valido.');
  $this->form_validation->set_message('is_unique','El %s existe asociado a otra cuenta.');



  if ($this->form_validation->run() === FALSE){
    $this->load->helper('form');

    $data['title'] = 'Modificar mis datos';
    $data['content'] = 'perfil_editar';
    $data['query'] = $this->usuario->get_record($session_logueado['id']);

    $this->load->view('front_layout', $data);
  }else{

    $id=  $this->input->post('id');

    // set default time zone if not set at php.ini
    if (!date_default_timezone_get('date.timezone'))
    {
    date_default_timezone_set('America/Buenos_Aires');
    }
    $ahora = date("Y-m-d H:i:s");


    //encrypto

    $salt = md5(uniqid(rand(), true));
    $hash = hash('sha512', $salt.$this->input->post('password'));

    $editedusuario = array(
      'nombre' => $this->input->post('nombre'),
      'apellido' => $this->input->post('apellido'),
      'email' => $this->input->post('email'),
      'profile' => $this->input->post('profile'),
      'nickname' => $this->input->post('nickname'),
      'password' => $hash,
      'salt' => $salt,
      'updated_at' => $ahora,
    );

    #save
    $this->session->set_flashdata('success', 'usuario Actualizado!');
    $this->usuario->update_record($id, $editedusuario);
    if($this->input->post('id')!=""){
      redirect('perfil', 'refresh');
    }else{
      redirect('perfil', 'refresh');
    }



  }



}

public function upload_imagen(){
  $session_logueado = array();
  $session_logueado = $this->session->userdata('front_logged_in');
  
if($_FILES['filename']['size'] > 0){

    $file  = $this->upload_file();

    if ( $file['status'] != 0 )
      {
      //guardo
      $usuario = $this->usuario->get_record($session_logueado['id']);
        $path = 'images-usuarios/'.$usuario->filename;

        if(is_link($path)){
          unlink($path);
        }


      $data = array('filename' => $file['filename']);
      $this->usuario->update_record($session_logueado['id'], $data);
      $this->session->set_flashdata('success', 'Imagen actualizada!');
      }

  }

  redirect('perfil-imagen', 'refresh');
}

public function perfil_modificar_imagen(){
  $data['title'] = '';
  $data['content'] = 'perfil_editar_imagen';
  $this->load->view('front_layout', $data);
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
    $yukle->set_directory('./images-usuarios');
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
      $yukle->resize(800,0);
      $yukle->set_thumbnail_name('tn_'.$random.'_'.$name_whitout_whitespaces);
      $yukle->create_thumbnail();
      $yukle->set_thumbnail_size(180, 0);
      
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


}//END CLASS