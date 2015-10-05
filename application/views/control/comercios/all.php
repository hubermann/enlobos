
<h2><?php echo $title; ?></h2>

<?php 
if(count($query)){
	echo '<table class="table table-striped">';
	foreach ($query as $row):

		 $nombre_categoria = $this->categoria_comercio->traer_nombre($row->categoria_id); 

		echo '<tr>';
		echo '<td>'.$row->razon_social.' </td>';
		echo '<td>'.$nombre_categoria.' </td>';

		echo '<td>'.$row->direccion.' </td>';
		echo '<td>'.$row->telefono.' </td>';
		echo '<td>'.$row->telefono2.' </td>';
		echo '<td>'.$row->email.' </td>';
		echo '<td>'.$row->email2.' </td>';


		if($row->filename){
		echo '<td><img src="'.base_url('images-comercios/'.$row->filename).'" width="100" /></td>';
		}else{
			echo "<td></td>";
		}

		echo '</td>';

		echo '<td> 
		<div class="btn-group">
		<a class="btn btn-small" href="'.base_url('control/comercios/delete_comfirm/'.$row->id.'').'"><i class="fa fa-trash-o"></i></a>
		<a class="btn btn-small" href="'.base_url('control/comercios/editar/'.$row->id.'').'"><i class="fa fa-edit"></i></a>		
		<!--<a class="btn btn-small" href="'.base_url('control/comercios/detail/'.$row->id.'').'"><i class="fa fa-chain"></i></a>-->
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