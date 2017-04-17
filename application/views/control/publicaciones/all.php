
<h2><?php echo $title; ?></h2>

<?php 
if(count($query)){
	echo '<table class="table table-striped">';
	foreach ($query as $row):

		/* $nombre_categoria = $this->categoria->traer_nombre($row->categoria_id); */

echo '<tr>';
echo '<td>'.$row->titulo.' </td>';
echo '<td>'.$row->descripcion_corta.' </td>';
echo '<td>'.$row->descripcion_completa.' </td>';
echo '<td>'.$row->owner.' </td>';
echo '<td>'.$row->visitas.' </td>';
echo '<td>'.$row->tags.' </td>';
echo '<td>'.$row->categoria_id.' </td>';
echo '<td>'.$row->provincia_id.' </td>';
echo '<td>'.$row->ciudad.' </td>';
echo '<td>'.$row->modalidad_horarios.' </td>';
echo '<td>'.$row->finalizado.' </td>';
echo '<td>'.$row->aprobado.' </td>';
echo '<td>'.$row->slug.' </td>';

		echo '</td>';

		echo '<td> 
		<div class="btn-group">
		<a class="btn btn-small" href="'.base_url('control/publicaciones/delete_comfirm/'.$row->id.'').'"><i class="fa fa-trash-o"></i></a>
		<a class="btn btn-small" href="'.base_url('control/publicaciones/editar/'.$row->id.'').'"><i class="fa fa-edit"></i></a>		
		<!--<a class="btn btn-small" href="'.base_url('control/publicaciones/detail/'.$row->id.'').'"><i class="fa fa-chain"></i></a>-->
		</div>
		</td>';


		echo '</tr>';

	endforeach; 
	echo '</table>';
}else{
	echo 'No hay resultados.';
}
?>
<div>
<ul class="pagination pagination-small pagination-centered">
<?php echo $pagination_links;  ?>
</ul>
</div>