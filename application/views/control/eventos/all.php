
<h2><?php echo $title; ?></h2>

<?php 
if(count($query)){
	echo '<table class="table table-striped">';
	foreach ($query as $row):

		$nombre_categoria = $this->categoria_evento->traer_nombre($row->categoria_id); 

		echo '<tr>';
		echo '<td>'.$nombre_categoria.' </td>';
		echo '<td>'.$row->titulo.' </td>';
		echo '<td>'.$row->descripcion.' </td>';
		echo '<td>'.$row->fecha_desde.' </td>';
		echo '<td>'.$row->fecha_hasta.' </td>';
		echo '<td>'.$row->horario.' </td>';
		echo '<td>'.$row->direccion.' </td>';
		echo '<td>'.$row->costo.' </td>';


		if($row->filename){
		echo '<td><img src="'.base_url('images-eventos/'.$row->filename).'" width="100" /></td>';
		}else{
			echo "<td></td>";
		}

		echo '</td>';

		echo '<td> 
		<div class="btn-group">
		<a class="btn btn-small" href="'.base_url('control/eventos/delete_comfirm/'.$row->id.'').'"><i class="fa fa-trash-o"></i></a>
		<a class="btn btn-small" href="'.base_url('control/eventos/editar/'.$row->id.'').'"><i class="fa fa-edit"></i></a>		
		<!--<a class="btn btn-small" href="'.base_url('control/eventos/detail/'.$row->id.'').'"><i class="fa fa-chain"></i></a>-->
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