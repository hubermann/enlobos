
<section id="perfil">
  <div class="container">
    <div class="row">
      <div class="col-md-4">

        <div class="row">
          <?php if($this->session->userdata('front_logged_in')){
  
          $session_logueado = array();
          $session_logueado = $this->session->userdata('front_logged_in');


          $usuario_logged = $this->usuario->get_record( $session_logueado['id'] );
          echo "<h2>".$usuario_logged->nombre." ".$usuario_logged->apellido."</h2>";
          echo '<p>
            <a href="'.base_url('perfil-editar').'">Editar mis datos</a>
          </p>';
          echo '<p>
            <a href="'.base_url('perfil-imagen').'">Imagen</a>
          </p>';
          echo '<p>
            <a href="'.base_url('perfil-modificar-acceso').'">Cambiar mi contraseña</a>
          </p>';
          if(empty($usuario_logged->filename)){

            echo "No tiene imagen cargada";

          }


        }
        ?>
        </div>
      </div><!-- col 1 -->

      <div class="col-md-8">
        
        <div class="row">
          <h3>Mis publicaciones en bolsa de trabajo</h3>
        </div>
        <!-- -->
        <div class="row">
          <h3>Mis clasificados</h3>
        </div>
        <!-- -->
        <div class="row">
          <h3>Mis publicaciones en bolsa de trabajo</h3>
        </div>

      </div><!-- col 8 -->

    </div>
  </div>

</section>


