<?php  

$attributes = array('class' => 'form-horizontal', 'id' => 'new_publicacion');
echo form_open_multipart(base_url('control/publicaciones/create/'),$attributes);

echo form_hidden('publicacion[id]');

?>
<legend><?php echo $title ?></legend>
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
			<label class="control-label">Descripcion_corta</label>
			<div class="controls">
			<input value="<?php echo set_value('descripcion_corta'); ?>" class="form-control" type="text" name="descripcion_corta" />
			<?php echo form_error('descripcion_corta','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Descripcion_completa</label>
			<div class="controls">
			<input value="<?php echo set_value('descripcion_completa'); ?>" class="form-control" type="text" name="descripcion_completa" />
			<?php echo form_error('descripcion_completa','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Owner</label>
			<div class="controls">
			<input value="<?php echo set_value('owner'); ?>" class="form-control" type="text" name="owner" />
			<?php echo form_error('owner','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Visitas</label>
			<div class="controls">
			<input value="<?php echo set_value('visitas'); ?>" class="form-control" type="text" name="visitas" />
			<?php echo form_error('visitas','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Tags</label>
			<div class="controls">
			<input value="<?php echo set_value('tags'); ?>" class="form-control" type="text" name="tags" />
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
			<label class="control-label"></label>
			<div class="controls">
			<input value="<?php echo set_value(''); ?>" class="form-control" type="text" name="" />
			<?php echo form_error('','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Provincia_id</label>
			<div class="controls">
			<?php  echo form_dropdown('provincia_id', $this->config->item('provincia_list'), $this->input->post('provincia_id'), 'id = provincia_id');?>
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
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Modalidad_horarios</label>
			<div class="controls">
			<input value="<?php echo set_value('modalidad_horarios'); ?>" class="form-control" type="text" name="modalidad_horarios" />
			<?php echo form_error('modalidad_horarios','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Finalizado</label>
			<div class="controls">
			<input value="<?php echo set_value('finalizado'); ?>" class="form-control" type="text" name="finalizado" />
			<?php echo form_error('finalizado','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Aprobado</label>
			<div class="controls">
			<input value="<?php echo set_value('aprobado'); ?>" class="form-control" type="text" name="aprobado" />
			<?php echo form_error('aprobado','<p class="error">', '</p>'); ?>
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