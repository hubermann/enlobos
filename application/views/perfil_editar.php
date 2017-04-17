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
		echo form_open_multipart(base_url('perfil-editar'),$attributes);

		echo form_hidden('id', $query->id);
		?>
		<legend><?php if($title!=""){echo $title;} ?></legend>
		<div class="well well-large well-transparent">

			  <!-- Text input-->
			  <div class="control-group">
			  <label class="control-label">Nombre</label>
			  <div class="controls">
			  <input value="<?php echo $query->nombre; ?>" type="text" class="form-control" name="nombre" />
			  <?php echo form_error('nombre','<p class="error">', '</p>'); ?>
			  </div>
			  </div>
			  <!-- Text input-->
			  <div class="control-group">
			  <label class="control-label">Apellido</label>
			  <div class="controls">
			  <input value="<?php echo $query->apellido; ?>" type="text" class="form-control" name="apellido" />
			  <?php echo form_error('apellido','<p class="error">', '</p>'); ?>
			  </div>
			  </div>

			  <!-- Text input-->
			  <div class="control-group">
			  <label class="control-label">Nickname</label>
			  <div class="controls">
			  <input value="<?php echo $query->nickname; ?>" type="text" class="form-control" name="nickname" />
			  <?php echo form_error('nickname','<p class="error">', '</p>'); ?>
			  </div>
			  </div>


			  <!-- Text input-->
			  <div class="control-group">
			  <label class="control-label">Email</label>
			  <div class="controls">
			  <input value="<?php echo $query->email; ?>" type="text" class="form-control" name="email" />
			  <?php echo form_error('email','<p class="error">', '</p>'); ?>
			  </div>
			  </div>
			  <!-- Text input-->
			  <div class="control-group">
			  <label class="control-label">Profile</label>
			  <div class="controls">
			  <textarea name="profile" id="profile" class="form-control" rows="6"><?php echo $query->profile; ?></textarea>
			  <?php echo form_error('profile','<p class="error">', '</p>'); ?>
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
