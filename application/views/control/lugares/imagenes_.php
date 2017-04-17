
<script type="text/javascript">
function confirma_eliminar(idvar, urldel) {
	var result = confirm("Confirma eliminar esta imagen?");
	if (result==true) {
    	//Confirmada la eliminacion de la img
    	$.ajax({
    	    url: "/control/lugares/delete_imagen/"+idvar,
    	    context: document.body,
    	    success: function(data){
    	      //wrapper del thumbnail
              $(".wrapp_thumb"+idvar).remove();
              $("#"+idvar).remove();

    	    }
    	});	
	}
}
</script>


<style>
    .container_img{height: 140px;  overflow: hidden;}
</style>



<div class="panel panel-default">
    <div class="panel-body">
    <?php 

    $atts = array('id' => 'form_imagenes', 'class' => "navbar-form navbar-left", 'role'=> 'search');
    echo form_open_multipart(base_url('control/lugares/add_imagen'), $atts);
    echo form_hidden('id', $this->uri->segment(4));
    echo '<input type="file" class="form-control" name="adjunto" id="adjunto" />

    <button onclick="validateImage();" class="btn btn-default"><span class="glyphicon glyphicon-camera"></span> Agregar Imagen</button>
    ';
    echo form_close();
    ?>
    </div>
</div>


<?php
if($query_imagenes->result()!=""){
    $count = 1;
    foreach ($query_imagenes->result() as $imagen) {
        echo '
        <div id="wrapp_thumb'.$imagen->id.'">
        <div class="thumbnail_delete thumbnail" id="'.$imagen->id.'" style="float:left; margin: 1em; padding:.8em; text-align:center;">
        <div class="container_img"><img src="'.base_url('images-lugares/'.$imagen->filename).'" width="120" alt="" /></div>
        <p onclick="confirma_eliminar('.$imagen->id.')" class="btn btn-default" role="button">Quitar imagen</p>
        </div>
        </div>';
        

    }   
}#fin if

?>
