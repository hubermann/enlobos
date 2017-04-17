<style>
	.error{color:red;}
</style>
	<div class="row">
		<div class="col-lg-3 col-md-3"><!-- empty --></div>
		<div class="col-lg-6 col-md-6 center">

		
		<?php
		if($this->session->userdata('front_logged_in')){echo '<a href="'.base_url('desconectar').'">Salir</a>';}

		$attribute = array ("class"=>"form_login_front form-horizontal");
		echo form_open(base_url('ingreso'),$attribute); ?>

		<h3>Ingrese su email y contraseña!</h3>
		
			<div class="form-group">
				<input type="text" class="form-control field" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
			</div>

			<div class="form-group">
				<input type="password" class="form-control field" placeholder="Contraseña" name="password">
			</div>

			<div class="form-group">
				<button class="btn" type="submit"><i class="icon-lock icon-large"></i> Acceder</button>
			</div>

			<div class="col-lg-12">
				<?php echo form_error('email','<p class="error">', '</p>'); ?>
				<?php echo form_error('password','<p class="error">', '</p>'); ?>
			</div>

			<?php  
			
			if($this->session->userdata("proviene_desde")){
				echo '<input type="hidden" name="proviene_desde" value="'.$this->session->userdata("proviene_desde").'">';
			}
			?>
			
			
			
			
			<!--<label class="checkbox"><input type="checkbox" value="remember-me"> Recordarme</label>-->
			<hr/>
			<?php echo form_close(); ?>
			<p class="help">No tiene usuario? <a href="<?php echo base_url('registro'); ?>">Regístrese</a> | 
			<a href="<?php echo base_url('reset_password'); ?>"> Se olvidó su contraseña?</a></p>
			

		</div>

		<div class="col-lg-3 col-md-3"><!-- empty --></div>
	</div><!-- fin row -->
