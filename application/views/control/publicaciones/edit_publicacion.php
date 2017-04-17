<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'edit_publicacion');
echo form_open_multipart(base_url('control/publicaciones/update/'),$attributes);

echo form_hidden('id', $query->id); 
?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">

 





			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Titulo</label>
			<div class="controls">
			<input value="<?php echo $query->titulo; ?>" type="text" class="form-control" name="titulo" />
			<?php echo form_error('titulo','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Descripcion_corta</label>
			<div class="controls">
			<input value="<?php echo $query->descripcion_corta; ?>" type="text" class="form-control" name="descripcion_corta" />
			<?php echo form_error('descripcion_corta','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Descripcion_completa</label>
			<div class="controls">
			<input value="<?php echo $query->descripcion_completa; ?>" type="text" class="form-control" name="descripcion_completa" />
			<?php echo form_error('descripcion_completa','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Owner</label>
			<div class="controls">
			<input value="<?php echo $query->owner; ?>" type="text" class="form-control" name="owner" />
			<?php echo form_error('owner','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Visitas</label>
			<div class="controls">
			<input value="<?php echo $query->visitas; ?>" type="text" class="form-control" name="visitas" />
			<?php echo form_error('visitas','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Tags</label>
			<div class="controls">
			<input value="<?php echo $query->tags; ?>" type="text" class="form-control" name="tags" />
			<?php echo form_error('tags','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->

			<div class="control-group">
			<label class="control-label">Categoria id</label>
				<div class="controls">
				<select name="categoria_id" id="categoria_id">
					<?php 
					
					$categorias = $this->categoria_publicacion->get_records_menu();
					if($categorias){

						foreach ($categorias as $value) {
							if($query->categoria_id == $value->id){$sel= "selected";}else{$sel="";}
							echo '<option value="'.$value->id.'" '.$sel.'>'.$value->nombre.'</option>';
						}
					}
					
					?>
					</select>
					
					<?php echo form_error('categoria_id','<p class="error">', '</p>'); ?>
				</div>
			</div>
			
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Ciudad</label>
			<div class="controls">
			<input value="<?php echo $query->ciudad; ?>" type="text" class="form-control" name="ciudad" />
			<?php echo form_error('ciudad','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Modalidad_horarios</label>
			<div class="controls">
			<input value="<?php echo $query->modalidad_horarios; ?>" type="text" class="form-control" name="modalidad_horarios" />
			<?php echo form_error('modalidad_horarios','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Finalizado</label>
			<div class="controls">
			<input value="<?php echo $query->finalizado; ?>" type="text" class="form-control" name="finalizado" />
			<?php echo form_error('finalizado','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Aprobado</label>
			<div class="controls">
			<input value="<?php echo $query->aprobado; ?>" type="text" class="form-control" name="aprobado" />
			<?php echo form_error('aprobado','<p class="error">', '</p>'); ?>
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
