<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'delete_usuario');
echo form_open(base_url('control/usuarios/delete/'.$query->id), $attributes);
echo '<fieldset>'.form_hidden('id', $query->id); 

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">
 <!-- <p>Categoria id: <?php #echo $nombre_categoria = $this->categoria->traer_nombre($query->categoria_id); ?></p> -->

 <p>Nombre: <?php echo $query->nombre; ?></p>
 <p>Apellido: <?php echo $query->apellido; ?></p>
 <p>Email: <?php echo $query->email; ?></p>
 <p>Password: <?php echo $query->password; ?></p>
 <p>Salt: <?php echo $query->salt; ?></p>
 <p>Role_id: <?php echo $query->role_id; ?></p>
 <p>Created_at: <?php echo $query->created_at; ?></p>
 <p>Updated_at: <?php echo $query->updated_at; ?></p>
 <p>Filename: <?php echo $query->filename; ?></p>

<!--  -->
<div class="control-group">

<label class="checkbox inline">

<input type="checkbox" name="comfirm" id="comfirm" />
<p>Confirma eliminar?</p>
<?php echo form_error('comfirm','<p class="error">', '</p>'); ?>
 </label>
</div>
<!--  -->
<div class="control-group">
<button class="btn btn-danger" type="submit"><i class="icon-trash icon-large"></i> Eliminar</button>
</div>


</fieldset>

<?php echo form_close(); ?>