<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'delete_comercio');
echo form_open(base_url('control/comercios/delete/'.$query->id), $attributes);
echo '<fieldset>'.form_hidden('id', $query->id); 

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">
 <!-- <p>Categoria id: <?php #echo $nombre_categoria = $this->categoria->traer_nombre($query->categoria_id); ?></p> -->

 <p>Razon_social: <?php echo $query->razon_social; ?></p>
 <p>Categoria_id: <?php echo $query->categoria_id; ?></p>
 <p>Slug: <?php echo $query->slug; ?></p>
 <p>Direccion: <?php echo $query->direccion; ?></p>
 <p>Telefono: <?php echo $query->telefono; ?></p>
 <p>Telefono2: <?php echo $query->telefono2; ?></p>
 <p>Email: <?php echo $query->email; ?></p>
 <p>Email2: <?php echo $query->email2; ?></p>
 <p>Descripcion_corta: <?php echo $query->descripcion_corta; ?></p>
 <p>Descripcion: <?php echo $query->descripcion; ?></p>
 <p>Mapa: <?php echo $query->mapa; ?></p>
 <p>Web: <?php echo $query->web; ?></p>
 <p>Facebook: <?php echo $query->facebook; ?></p>
 <p>Filename: <?php echo $query->filename; ?></p>

<!--  -->
<div class="control-group">

<label class="checkbox inline">


<p style="margin-left:1.3em"><input type="checkbox" name="comfirm" id="comfirm" /> Confirma eliminar?</p>
<?php echo form_error('comfirm','<p class="error">', '</p>'); ?>
 </label>
</div>
<!--  -->
<div class="control-group">
<button class="btn btn-danger" type="submit"><i class="icon-trash icon-large"></i> Eliminar</button>
</div>


</fieldset>

<?php echo form_close(); ?>