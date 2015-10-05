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
</script><?php  

$attributes = array('class' => 'form-horizontal', 'id' => 'new_evento');
echo form_open_multipart(base_url('control/eventos/create/'),$attributes);

echo form_hidden('evento[id]');

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">


<!-- Text input-->
<div class="control-group">
<label class="control-label">Categoria</label>
	<div class="controls">
		
		<select name="categoria_id" id="categoria_id">
		<?php  
		
		$categorias = $this->categoria_evento->get_records_menu();
		if($categorias){

			foreach ($categorias->result() as $value) {
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
			<label class="control-label">Titulo</label>
			<div class="controls">
			<input value="<?php echo set_value('titulo'); ?>" class="form-control" type="text" name="titulo" />
			<?php echo form_error('titulo','<p class="error">', '</p>'); ?>
			</div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Destacado</label>
			<div class="controls">
			<select name="destacado" id="destacado">
				<option value="1">Si</option>
				<option value="0">No</option>
			</select>

			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Descripcion</label>
			<div class="controls">
			<textarea name="descripcion" id="descripcion" class="form-control"><?php echo set_value('descripcion'); ?></textarea>
			<?php echo form_error('descripcion','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Fecha_desde</label>
			<div class="controls">
			<input value="<?php echo set_value('fecha_desde'); ?>" class="form-control" type="text" name="fecha_desde" />
			<?php echo form_error('fecha_desde','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Fecha_hasta</label>
			<div class="controls">
			<input value="<?php echo set_value('fecha_hasta'); ?>" class="form-control" type="text" name="fecha_hasta" />
			<?php echo form_error('fecha_hasta','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Horario</label>
			<div class="controls">
			<input value="<?php echo set_value('horario'); ?>" class="form-control" type="text" name="horario" />
			<?php echo form_error('horario','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Organizador</label>
			<div class="controls">
			<input value="<?php echo set_value('organizador'); ?>" class="form-control" type="text" name="organizador" />
			<?php echo form_error('organizador','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Direccion</label>
			<div class="controls">
			<input value="<?php echo set_value('direccion'); ?>" class="form-control" type="text" name="direccion" />
			<?php echo form_error('direccion','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Costo</label>
			<div class="controls">
			<input value="<?php echo set_value('costo'); ?>" class="form-control" type="text" name="costo" />
			<?php echo form_error('costo','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Mapa</label>
			<div class="controls">
			<input value="<?php echo set_value('mapa'); ?>" class="form-control" type="text" name="mapa" />
			<?php echo form_error('mapa','<p class="error">', '</p>'); ?>
			</div>
			</div>
	<!-- Text input-->
<div class="control-group">
	<label class="control-label">Imagen</label>
	<div class="controls">
	<div id="previewImg"></div>
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



</fieldset>

<?php echo form_close(); ?>

</div>



