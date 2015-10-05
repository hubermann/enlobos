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
$attributes = array('class' => 'form-horizontal', 'id' => 'edit_evento');
echo form_open_multipart(base_url('control/eventos/update/'),$attributes);

echo form_hidden('id', $query->id); 
?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">

 


<!-- Text input-->

<div class="control-group">
<label class="control-label">Categoria id</label>
	<div class="controls">
	<select name="categoria_id" id="categoria_id">
		<?php 
		
		$categorias = $this->categoria_evento->get_records_menu();
		if($categorias){

			foreach ($categorias->result() as $value) {
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
			<label class="control-label">Titulo</label>
			<div class="controls">
			<input value="<?php echo $query->titulo; ?>" type="text" class="form-control" name="titulo" />
			<?php echo form_error('titulo','<p class="error">', '</p>'); ?>
			</div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Destacado</label>
			<div class="controls">
			<select name="destacado" id="destacado">
				<option value="1" <?php if($query->destacado == 1){echo "selected";} ?>>Si</option>
				<option value="0" <?php if($query->destacado == 0){echo "selected";} ?>>No</option>
			</select>
		
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Descripcion</label>
			<div class="controls">
			<textarea name="descripcion" id="descripcion" class="form-control"><?php echo $query->descripcion; ?></textarea>
			<?php echo form_error('descripcion','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<?php  
			list($anio,$mes,$dia) = explode('-', $query->fecha_desde);
			$fecha_formateda_desde = "$dia-$mes-$anio";
			?>
			<div class="control-group">
			<label class="control-label">Fecha desde<small> (mes-dia-a&ntilde;o) </small></label>
			<div class="controls">
			<div id="fechacontainer">
			<input value="<?php echo $fecha_formateda_desde; ?>" type="text" class="form-control" name="fecha_desde" />
			</div>
			<?php echo form_error('fecha_desde','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<?php  
			list($anio,$mes,$dia) = explode('-', $query->fecha_hasta);
			$fecha_formateda_hasta = "$dia-$mes-$anio";
			?>
			<div class="control-group">
			<label class="control-label">Fecha hasta<small> (mes-dia-a&ntilde;o) </small></label>
			<div class="controls">
			<div id="fechacontainer">
			<input value="<?php echo $fecha_formateda_hasta; ?>" type="text" class="form-control" name="fecha_hasta" />
			</div>
			<?php echo form_error('fecha_hasta','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Horario</label>
			<div class="controls">
			<input value="<?php echo $query->horario; ?>" type="text" class="form-control" name="horario" />
			<?php echo form_error('horario','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Organizador</label>
			<div class="controls">
			<input value="<?php echo $query->organizador; ?>" type="text" class="form-control" name="organizador" />
			<?php echo form_error('organizador','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Direccion</label>
			<div class="controls">
			<input value="<?php echo $query->direccion; ?>" type="text" class="form-control" name="direccion" />
			<?php echo form_error('direccion','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Costo</label>
			<div class="controls">
			<input value="<?php echo $query->costo; ?>" type="text" class="form-control" name="costo" />
			<?php echo form_error('costo','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Mapa</label>
			<div class="controls">
			<input value="<?php echo $query->mapa; ?>" type="text" class="form-control" name="mapa" />
			<?php echo form_error('mapa','<p class="error">', '</p>'); ?>
			</div>
			</div>
	<!-- Text input-->
<div class="control-group">
	<label class="control-label">Imagen</label>
	<div class="controls">
	<div id="previewImg">
	<?php if($query->filename){
	echo '<p><img src="'.base_url('images-eventos/'.$query->filename).'" width="140" /></p>';
	} ?>

</div>
	<input value="<?php echo set_value('filename'); ?>" type="file" class="form-control" name="filename" onchange="show_preview(this)"/>
	<?php echo form_error('filename','<p class="error">', '</p>'); ?>
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
