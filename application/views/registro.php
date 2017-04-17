
<div class="row">
	<div class="col-lg-3 col-md-3"><!-- empty --></div>
	<div class="col-lg-6 col-md-6 center">
		<?php

		$attributes = array('class' => 'form_login_front', 'id' => 'new_usuario');
		echo form_open_multipart(base_url('registro'),$attributes);

		echo form_hidden('usuario[id]');
		
		?>
		<h3>Crear mi cuenta.</h3>
			<div class="row no-gutters no-margin form-group">
			<!-- Text input-->
			<!-- Text input-->
			  <div class="row">

			  	<div class="col-md-6">
			  		<label class="control-label">Nombre (No visible en perfiles)</label>
					  <div class="controls">
					  <input value="<?php echo set_value('nombre'); ?>" class="col-lg-12 field form-control" placeholder="Nombre" type="text" name="nombre" />
					  <?php echo form_error('nombre','<p class="error">', '</p>'); ?>
					  </div>
			  	</div>

			  	<div class="col-md-6">
			  		<label class="control-label">Apellido (No visible en perfiles)</label>
					  <div class="controls">
					  <input value="<?php echo set_value('apellido'); ?>" class="col-lg-12 field form-control" placeholder="Apellido" type="text" name="apellido" />
					  <?php echo form_error('apellido','<p class="error">', '</p>'); ?>
					  </div>
			  	</div>


				  
			  </div>
			  

			  <!-- Text input-->
			  <div class="control-group">
				  <label class="control-label">Nickname (Visible en perfiles)</label>
				  <div class="controls">
				  <input value="<?php echo set_value('nickname'); ?>" class="col-lg-12 field form-control" placeholder="Nickname" type="text" name="nickname" />
				  <?php echo form_error('nickname','<p class="error">', '</p>'); ?>
				  </div>
			  </div>
			  <!-- Text input-->
			  <div class="control-group">
					<label class="control-label">Email</label>
				  <div class="controls">
					<input value="<?php echo set_value('email'); ?>" class="col-lg-12 field form-control" placeholder="Email" type="text" name="email" />
					<?php echo form_error('email','<p class="error">', '</p>'); ?>
				  </div>
			  </div>

			  


			  <!-- Text input-->
			  <div class="control-group">
				  <label class="control-label">Password</label>
				  <div class="controls">
					<input value="<?php echo set_value('password'); ?>" class="col-lg-12 field form-control" placeholder="Password" type="password" name="password" />
					<?php echo form_error('password','<p class="error">', '</p>'); ?>
				  </div>
			  </div>

			  <!-- Text input-->
			  <div class="control-group">
				  <label class="control-label">Confirmación Password</label>
				  <div class="controls">
					<input value="<?php echo set_value('password_conf'); ?>" class="col-lg-12 field form-control" placeholder="Confirmacion Password" type="password" name="password_conf" />
					<?php echo form_error('password_conf','<p class="error">', '</p>'); ?>
				  </div>
			  </div>
				
				
				<div class="control-group">
				<label class="control-label"></label>
					<div class="controls">
						<button style="width:100%;"class="btn" type="submit">Registrar</button>
					</div>
				</div>

		<?php echo form_close(); ?>
		</div>

	</div>
	<div class="col-lg-3 col-md-3"><!-- empty --></div>
</div>


		