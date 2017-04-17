<div class="row no-gutters">
      <div class="col-lg-4 col-md-4 col-sm-4">
      <nav class="editPanel">
            
                  <?php if($this->session->userdata('front_logged_in')){

                    $session_logueado = array();
                    $session_logueado = $this->session->userdata('front_logged_in');

                    $usuario_logged = $this->usuario->get_record( $session_logueado['id']);
                    //echo "<h2>".$usuario_logged->nombre." ".$usuario_logged->apellido."</h2>";
                    echo '<ul>';
                    echo '<li>
                        <a href="'.base_url('perfil-editar').'">Editar mis datos</a>
                    </li>';
                    echo '<li>
                        <a href="'.base_url('perfil-imagen').'">Imagen</a>
                    </li>';
                    echo '<li>
                        <a href="'.base_url('perfil-modificar-acceso').'">Cambiar mi contraseña</a>
                    </li>';
                    echo '</ul>';
                    if(empty($usuario_logged->filename)){

                        echo "<span class='warning'>No tiene imagen cargada</span>";

                    }
                  }
                  ?>
      </nav>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8">

  <?php if($this->session->userdata('front_logged_in')){
  $usuario_logged = $this->usuario->get_record( $session_logueado['id']);
  echo "<h2>".$usuario_logged->nombre." ".$usuario_logged->apellido."</h2>";

  if(empty($usuario_logged->filename)){
    echo '<p>No tienes imagen aun.</p>';

    $attributes = array('class' => 'form-horizontal', 'id' => 'new_usuario');
    echo form_open_multipart(base_url('perfil-cargar-imagen'),$attributes);
    ?>
    <!-- Text input-->
  <div class="control-group">
    <label class="control-label">Imagen</label>
    <div class="controls">
    <input value="<?php echo set_value('filename'); ?>" type="file" class="form-control" name="filename" onchange="show_preview(this)"/>
    <?php echo form_error('filename','<p class="error">', '</p>'); ?>
    </div>
  </div>


  <div class="control-group">
  <label class="control-label"></label>
    <div class="controls">
      <button class="btn" type="submit">Cargar imagen</button>
    </div>
  </div>


  <?php
  echo form_close();

  }else{

    if(strlen($usuario_logged->filename) > 6 ){
      echo '<div class="thumbnail">
        <img src="images-usuarios/tn_'.$usuario_logged->filename.'" alt="" />
      </div>';
    }



    $attributes = array('class' => 'form-horizontal', 'id' => 'new_usuario');
    echo form_open_multipart(base_url('perfil-cargar-imagen'),$attributes);
    ?>
    <!-- Text input-->
  <div class="control-group">
    <label class="control-label">Imagen</label>
    <div id="previewImg"></div>
    <div class="controls">
    <input value="<?php echo set_value('filename'); ?>" type="file" class="form-control" name="filename" onchange="show_preview(this)"/>
    <?php echo form_error('filename','<p class="error">', '</p>'); ?>
    </div>
  </div>


  <div class="control-group">
  <label class="control-label"></label>
    <div class="controls">
      <button class="btn" type="submit">Crear</button>
    </div>
  </div>


  <?php
  echo form_close();

  }


}
?>

<script>
  function show_preview(input) {
  if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
  $('#previewImg').html('<img src="'+e.target.result+'" width="140" />' );
  }
  reader.readAsDataURL(input.files[0]);
  }
}
</script>


</div>
  </div>