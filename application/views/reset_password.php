<div class="row">
	<div class="col-lg-3 col-md-3"><!-- empty --></div>
	<div class="col-lg-6 col-md-6 center">
		<?php
	if($this->session->userdata('front_logged_in')){echo '<a href="'.base_url('desconectar').'">Salir</a>';}

	$attribute = array ("class"=>"form_login_front");
	echo form_open(base_url('solicitud_reset_password'),$attribute); ?>
	<h3>Recuperar contraseña</h3>
	<div class="row no-gutters no-margin form-group">
		<h4 class="form-signin-heading" style="padding: 0px 0px 13px 0px;text-align: center;">Ingrese la direccion de email asociada a su cuenta.</h4>
		<input type="text" class="col-lg-10 col-md-10 col-sm-12 col-xs-12 field" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">

		<button class="btn btn-large " type="submit"><i class="icon-lock icon-large"></i> Acceder</button>
		
		<?php echo form_error('email','<p style="  display: block;clear: both;color: red;text-align: center;padding: 10px;text-transform: uppercase;" class="error">', '</p>'); ?>
	</div>
	<?php echo form_close(); ?>



		</div>

	</div>
	<div class="col-lg-3 col-md-3"><!-- empty --></div>
</div>
