<h2><?php echo $title; ?></h2>

<?php
if(count($query->result())){
	$urldelete = base_url('control/usuarios/soft_delete');
	echo '<table class="table table-bordered">

	<thead>
	<th>Nombre</th>

	<th>email</th>


	<th>Role</th>
	<th></th>
	<th>opciones</th>
	<thead>
	';
	foreach ($query->result() as $row):

		 

		echo '<tr id="row'.$row->id.'">';
		echo '<td>'.$row->nombre.' '.$row->apellido.' </td>';

		echo '<td id="titulo'.$row->id.'">'.$row->email.' <!-- '.hash('sha512', $row->salt.$row->password).'--></td>';


		if($row->filename){
		echo '<td><img src="'.base_url('images-usuarios/'.$row->filename).'" width="100" /></td>';
		}else{
			echo "<td></td>";
		}

		echo '</td>';

		echo '<td>
		<div class="btn-group">
		<a class="btn btn-small" onclick="confirm_delete('.$row->id.', \'usuarios\', \''.$urldelete.'\')"><i class="fa fa-trash-o"></i></a>
		<a class="btn btn-small" href="'.base_url('control/usuarios/editar/'.$row->id.'').'"><i class="fa fa-edit"></i></a>
		<!--<a class="btn btn-small" href="'.base_url('control/usuarios/detail/'.$row->id.'').'"><i class="fa fa-chain"></i></a>-->
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
