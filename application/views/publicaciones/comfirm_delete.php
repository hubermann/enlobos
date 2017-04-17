<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'delete_publicacion');
echo form_open(base_url('publicaciones/delete/'.$query->id), $attributes);
echo '<fieldset>'.form_hidden('id', $query->id); 

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">
 <!-- <p>Categoria id: <?php #echo $nombre_categoria = $this->categoria->traer_nombre($query->categoria_id); ?></p> -->

 <p>Titulo: <?php echo $query->titulo; ?></p>
 <p>Descripcion_corta: <?php echo $query->descripcion_corta; ?></p>
 <p>Descripcion_completa: <?php echo $query->descripcion_completa; ?></p>
 <p>Visitas: <?php echo $query->visitas; ?></p>


<!--  -->
<div class="control-group">

<label class="checkbox inline">


<p style="margin-left:1.3em"><input type="checkbox" name="comfirm" id="comfirm" /> Confirma eliminar?</p>
<?php echo form_error('comfirm','<p class="error">', '</p>'); ?>
 </label>
</div>
<!--  -->
<div class="control-group">
<button class="btn btn-danger color-white" type="submit"><i class="icon-trash icon-large"></i> Eliminar</button>
</div>


</fieldset>

<?php echo form_close(); ?>