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

$attributes = array('class' => 'form-horizontal', 'id' => 'new_comercio');
echo form_open_multipart(base_url('control/comercios/create/'),$attributes);

echo form_hidden('comercio[id]');

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">


			<!-- Text input-->

			<div class="control-group">
			<label class="control-label">Categoria</label>
				<div class="controls">
					
					<select name="categoria_id" id="categoria_id">
					<?php  
					
					$categorias = $this->categoria_comercio->get_records_menu();
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
			<label class="control-label">Razon_social</label>
			<div class="controls">
			<input value="<?php echo set_value('razon_social'); ?>" class="form-control" type="text" name="razon_social" />
			<?php echo form_error('razon_social','<p class="error">', '</p>'); ?>
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
			<label class="control-label">Telefono</label>
			<div class="controls">
			<input value="<?php echo set_value('telefono'); ?>" class="form-control" type="text" name="telefono" />
			<?php echo form_error('telefono','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Telefono2</label>
			<div class="controls">
			<input value="<?php echo set_value('telefono2'); ?>" class="form-control" type="text" name="telefono2" />
			<?php echo form_error('telefono2','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Email</label>
			<div class="controls">
			<input value="<?php echo set_value('email'); ?>" class="form-control" type="text" name="email" />
			<?php echo form_error('email','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Email2</label>
			<div class="controls">
			<input value="<?php echo set_value('email2'); ?>" class="form-control" type="text" name="email2" />
			<?php echo form_error('email2','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Descripcion_corta</label>
			<div class="controls">
			<textarea name="descripcion_corta" id="descripcion_corta" class="form-control" ></textarea>
			
			<?php echo form_error('descripcion_corta','<p class="error">', '</p>'); ?>
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
			<label class="control-label">Mapa</label>
			<div class="controls">
			<input value="<?php echo set_value('mapa'); ?>" class="form-control" type="text" name="mapa" />
			<?php echo form_error('mapa','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Web</label>
			<div class="controls">
			<input value="<?php echo set_value('web'); ?>" class="form-control" type="text" name="web" />
			<?php echo form_error('web','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Facebook</label>
			<div class="controls">
			<input value="<?php echo set_value('facebook'); ?>" class="form-control" type="text" name="facebook" />
			<?php echo form_error('facebook','<p class="error">', '</p>'); ?>
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