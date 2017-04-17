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


<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'edit_usuario');
echo form_open_multipart(base_url('perfil-modificar-acceso'),$attributes);

?>
<legend><?php if($title!=""){echo $title;} ?></legend>
<div class="well well-large well-transparent">



      <!-- Text input-->
      <div class="control-group">
      <label class="control-label">Contraseña actual</label>
      <div class="controls">
      <input value="<?php echo set_value('pass_actual'); ?>" type="password" class="form-control" name="pass_actual" />
      <?php echo form_error('pass_actual','<p class="error">', '</p>'); ?>
      </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
      <label class="control-label">Nueva contraseña</label>
      <div class="controls">
      <input value="<?php echo set_value('nuevo_pass'); ?>" type="password" class="form-control" name="nuevo_pass" />
      <?php echo form_error('nuevo_pass','<p class="error">', '</p>'); ?>
      </div>
      </div>


      <!-- Text input-->
      <div class="control-group">
      <label class="control-label">Repetir Nueva contraseña</label>
      <div class="controls">
      <input value="<?php echo set_value('repeat_nuevo_pass'); ?>" type="password" class="form-control" name="repeat_nuevo_pass" />
      <?php echo form_error('repeat_nuevo_pass','<p class="error">', '</p>'); ?>
      </div>
      </div>



      <div class="control-group">
      <label class="control-label"></label>
        <div class="controls">
          <button class="btn" type="submit">Actualizar</button>
        </div>
      </div>

</fieldset>

<?php echo form_close(); ?>

</div>

</div>
</div>