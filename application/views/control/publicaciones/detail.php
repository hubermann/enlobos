<h2><?php echo $title ?></h2>
<div class="well well-large well-transparent">
<?php
 /* echo '<p>Categoria: '.$this->Categoria->traer_nombre($query->categoria_id).' </p>'; */
 
?>
<div class="btn-group">
<a class="btn btn-small" href="<?php echo base_url('control/publicaciones/delete_comfirm/'.$query->id.''); ?>">Eliminar</a>
<a class="btn btn-small" href="<?php echo base_url('control/publicaciones/editar/'.$query->id.''); ?>">Editar</a>
</div>
</div>