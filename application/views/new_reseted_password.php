
<h2>Crear nueva contraseña   | Trabajo-ya.com</h2>

<?php
/*formulario para el que resetea el password posterior al envio de email de compracion etc*/

$attributes = array('class' => 'form-horizontal', 'id' => 'create_new_pass');
echo form_open_multipart(base_url('create_new_pass'),$attributes);


?>
<legend></legend>
<div class="well well-large well-transparent">


      <!-- Text input-->
      <div class="control-group">
      <label class="control-label">Password</label>
      <div class="controls">
      <input value="<?php echo set_value('password'); ?>" class="form-control" type="password" name="password" />
      <?php echo form_error('password','<p class="error">', '</p>'); ?>
      </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
      <label class="control-label">Confirmacion Password</label>
      <div class="controls">
      <input value="<?php echo set_value('password_conf'); ?>" class="form-control" type="password" name="password_conf" />
      <?php echo form_error('password_conf','<p class="error">', '</p>'); ?>
      </div>
      </div>

<div class="control-group">
<label class="control-label"></label>
  <div class="controls">
    <button class="btn" type="submit">Crear</button>
  </div>
</div>



</fieldset>

<?php echo form_close(); ?>

</div>
