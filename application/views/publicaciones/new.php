
<section>
<div class="container">
	<div class="col-md-4">
		<h3>Datos personales</h3>

	</div>

	<div class="col-md-8">
		<?php  

				$attributes = array('class' => 'form-horizontal', 'id' => 'new_publicacion');
				echo form_open_multipart(base_url('publicaciones/create/'),$attributes);

				echo form_hidden('publicacion[id]');

				?>
				<fieldset>
				<legend>Crear una nueva publicación de empleo.</legend>
				<div class="well well-large well-transparent">

				<!-- Text input-->
				<div class="control-group">
				<label class="control-label">Titulo</label>
				<div class="controls">
				<input value="<?php echo set_value('titulo'); ?>" class="form-control" type="text" name="titulo" />
				<?php echo form_error('titulo','<p class="error">', '</p>'); ?>
				</div>
				</div>
				<!-- Text input-->
				<div class="control-group">
				<label class="control-label">Descripcion corta [ <span id="contador_limite">200 </span> caracteres ]</label>
				<div class="controls">
				<textarea name="descripcion_corta" id="descripcion_corta" cols="10" rows="5" class="form-control"><?php echo set_value('descripcion_corta'); ?></textarea>
				<?php echo form_error('descripcion_corta','<p class="error">', '</p>'); ?>
				
				</div>
				</div>
				<!-- Text input-->
				<div class="control-group">
				<label class="control-label">Descripcion completa</label>
				<div class="controls">
				<textarea name="descripcion_completa" id="descripcion_completa" cols="10" rows="10" class="form-control"><?php echo set_value('descripcion_completa'); ?></textarea>
				<?php echo form_error('descripcion_completa','<p class="error">', '</p>'); ?>
				</div>
				</div>
				<?php  
				$user_loggued = $this->session->userdata('front_logged_in')
				?>
				<!-- Text input-->
				<input value="<?php echo $user_loggued['id']; ?>" class="form-control" type="hidden" name="owner" />
				
				<!-- Text input-->
				<div class="control-group">
				<label class="control-label">Tags</label>
				<div class="controls">
				<input value="<?php echo set_value('tags'); ?>" class="form-control" type="text" name="tags" id="singleFieldTags" />
				<?php echo form_error('tags','<p class="error">', '</p>'); ?>
				</div>
				</div>
				<!-- Text input-->

				<div class="control-group">
				<label class="control-label">Categoria</label>
					<div class="controls">
						
						<select name="categoria_id" id="categoria_id">
						<?php  
						
						$categorias = $this->categoria_publicacion->get_records_menu();
						if($categorias){

							foreach ($categorias as $value) {
								echo '<option value="'.$value->id.'">'.$value->nombre.'</option>';
							}
						}
						
						?>
						</select>

						<?php echo form_error('categoria_id','<p class="error">', '</p>'); ?>
					</div>
				</div>
			
				<!-- Text input-->
				<div class="control-group">
				<label class="control-label">Pais</label>
				<div class="controls">
				<?php  echo form_dropdown('pais_id', $this->config->item('paises_list'), $this->input->post('pais_id'), 'id = pais_id');?>
				<?php echo form_error('pais_id','<p class="error">', '</p>'); ?>
				</div>
				</div>

				<!-- Text input-->
				<div class="control-group">
				<label class="control-label">Provincia</label>
				<div class="controls">
				<?php  echo form_dropdown('provincia_id', $this->config->item('provincias_list'), $this->input->post('provincia_id'), 'id = provincia_id');?>
				<?php echo form_error('provincia_id','<p class="error">', '</p>'); ?>
				</div>
				</div>


				<!-- Text input-->
				<div class="control-group">
				<label class="control-label">Ciudad</label>
				<div class="controls">
				<input value="<?php echo set_value('ciudad'); ?>" class="form-control" type="text" name="ciudad" />
				<?php echo form_error('ciudad','<p class="error">', '</p>'); ?>
				</div>
				</div>
				<!-- Text input
				<div class="control-group">
				<label class="control-label">Modalidad horarios</label>
				<div class="controls">
				<?php  echo form_dropdown('modalidad_horarios', $this->config->item('modalidad_horarios_list'), $this->input->post('modalidad_horarios'), 'id = modalidad_horarios');?>
				<?php echo form_error('modalidad_horarios','<p class="error">', '</p>'); ?>
				</div>
				</div>-->

				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Moneda</label>
					<div class="controls">
					<?php  echo form_dropdown('duracion', $this->config->item('duracion_clasificados'), $this->input->post('duracion'), 'id = duracion');?>
					<?php echo form_error('duracion','<p class="error">', '</p>'); ?>
					</div>
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
	</div>

</div>
</section>




