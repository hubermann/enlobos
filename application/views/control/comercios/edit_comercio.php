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
$attributes = array('class' => 'form-horizontal', 'id' => 'edit_comercio');
echo form_open_multipart(base_url('control/comercios/update/'),$attributes);

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
		
		$categorias = $this->categoria_comercio->get_records_menu();
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
			<label class="control-label">Razon_social</label>
			<div class="controls">
			<input value="<?php echo $query->razon_social; ?>" type="text" class="form-control" name="razon_social" />
			<?php echo form_error('razon_social','<p class="error">', '</p>'); ?>
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
			<label class="control-label">Telefono</label>
			<div class="controls">
			<input value="<?php echo $query->telefono; ?>" type="text" class="form-control" name="telefono" />
			<?php echo form_error('telefono','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Telefono2</label>
			<div class="controls">
			<input value="<?php echo $query->telefono2; ?>" type="text" class="form-control" name="telefono2" />
			<?php echo form_error('telefono2','<p class="error">', '</p>'); ?>
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
			<label class="control-label">Email2</label>
			<div class="controls">
			<input value="<?php echo $query->email2; ?>" type="text" class="form-control" name="email2" />
			<?php echo form_error('email2','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Descripcion_corta</label>
			<div class="controls">
			<textarea name="descripcion_corta"  class="form-control"  id="descripcion_corta" ><?php echo $query->descripcion_corta; ?></textarea>
			<?php echo form_error('descripcion_corta','<p class="error">', '</p>'); ?>
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
			<div class="control-group">
			<label class="control-label">Mapa</label>
			<div class="controls">
			<input value="<?php echo $query->mapa; ?>" type="text" class="form-control" name="mapa" />
			<?php echo form_error('mapa','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Web</label>
			<div class="controls">
			<input value="<?php echo $query->web; ?>" type="text" class="form-control" name="web" />
			<?php echo form_error('web','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Facebook</label>
			<div class="controls">
			<input value="<?php echo $query->facebook; ?>" type="text" class="form-control" name="facebook" />
			<?php echo form_error('facebook','<p class="error">', '</p>'); ?>
			</div>
			</div>
	<!-- Text input-->
<div class="control-group">
	<label class="control-label">Imagen</label>
	<div class="controls">
	<div id="previewImg">
	<?php if($query->filename){
	echo '<p><img src="'.base_url('images-comercios/'.$query->filename).'" width="140" /></p>';
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
