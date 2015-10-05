<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'delete_evento');
echo form_open(base_url('control/eventos/delete/'.$query->id), $attributes);
echo '<fieldset>'.form_hidden('id', $query->id); 

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">
 <!-- <p>Categoria id: <?php #echo $nombre_categoria = $this->categoria->traer_nombre($query->categoria_id); ?></p> -->

 <p>Categoria_id: <?php echo $query->categoria_id; ?></p>
 <p>Titulo: <?php echo $query->titulo; ?></p>
 <p>Slug: <?php echo $query->slug; ?></p>
 <p>Destacado: <?php echo $query->destacado; ?></p>
 <p>Descripcion: <?php echo $query->descripcion; ?></p>
 <p>Fecha_desde: <?php echo $query->fecha_desde; ?></p>
 <p>Fecha_hasta: <?php echo $query->fecha_hasta; ?></p>
 <p>Horario: <?php echo $query->horario; ?></p>
 <p>Organizador: <?php echo $query->organizador; ?></p>
 <p>Direccion: <?php echo $query->direccion; ?></p>
 <p>Costo: <?php echo $query->costo; ?></p>
 <p>Mapa: <?php echo $query->mapa; ?></p>
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