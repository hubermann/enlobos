


<div class="row">
	<div class="col-lg-12">


		<?php  
		if($titulo!=""){
			
			$tags  = explode(',', $tags);
			$links_tags="";
			foreach ($tags as $val_tag) {
				# code...
				$links_tags .= '<a href="'.base_url('by-tag/'.$val_tag).'">'.$val_tag.'</a> ';
			}

			echo '<h1>'.$titulo.'</h1>
		
						<p>Descripción: '.$descripcion_completa.'</p>
						<!-- <p>Tags: '.$links_tags.'</p> -->
						<p>Categoria: '.$categoria.'</p>
						<p>'.$provincia.' '.$ciudad.'</p>
						<p>Publicado hace: '.$created_at.' por <a href="'.base_url('user/'.$nickname).'">'.$nickname.'</a></p>

						<p>

						<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.trabajo-ya.com/sh/'.$url_short.'" data-text="'.$titulo.'">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>

					
					<!-- Your share button code -->
    <div class="fb-share-button" 
        data-href="http://www.trabajo-ya.com/'.$slug.'/'.$id_publicacion.'" 
        data-layout="button_count">
    </div>

					</p>
					<p>Url corta: <a href="http://www.trabajo-ya.com/sh/'.$url_short.'">http://www.trabajo-ya.com/sh/'.$url_short.'</a></p>


			';
		}else{
			echo 'No se encontro la publicacion.';
		}
		?>
		<p>
			<br />
			<br />
		</p>


	</div>
</div>

<p></p>