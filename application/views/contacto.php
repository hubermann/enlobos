<div class="row">
	
<div class="col-md-2"><!--empty--></div>

<div class="col-lg-8">
    <div id="message" style="text-align:center"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url('process_contact'); ?>" id="contactform">
       
        <div class="row">
          <h5 class="center teal-text">Dejanos tus datos. Pronto nos comunicaremos.</h5>
        </div>
   
         <div class="form-group">
            <label for="nombre">Nombre Apellido</label>
            <input placeholder="Bruce Banner" id="nombre_apellido" name="nombre_apellido" type="text" class="form-control validate">
            
          </div>
    

      

          <div class="form-group">
         <label for="telefono">telefono</label>
            <input placeholder="+54 9 4444-5555" id="telefono" name="telefono" type="text" class="form-control">
           
          </div>

          <div class="form-group">
          <label for="email">Email</label>
            <input placeholder="nombre@dominio.ext" name="email" id="email" type="email" class="validate form-control">
        
        </div>



        <div class="form-group">
         
                <label for="disabled">Mensaje</label>
             <textarea id="mensaje" name="mensaje" class="form-control"></textarea>
            

        </div>
        
        <button class="btn " type="submit" id="submit" name="action">Enviar</button>
        
      </form>

      <br>
      <br>
      <br>
      <br>
      <br>
    </div>

<div class="col-md-2"><!--empty--></div>

</div>




<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script>
	function initContactForm() {

    $('#contactform').submit(function() { // atencion al nombre del ID que se dice aca
        console.log('enviando..');
        var action = $(this).attr('action');
        var values = $(this).serialize(); // agarramos la informacion del form y cargamos en una sola variable
        $('#contactform #submit').attr('disabled', 'disabled').after('<img src="http://www.trabajo-ya.com/public_folder/21.gif" width="70" class="loader" />');
        $("#message").slideUp(750, function() { 
            $('#message').hide();
            $.post(action, values, function(data) {
            if (data == '1'){ // AcÃƒÂ¡ redireccionamos a la pÃƒÂ¡gina.
            window.location.href = 'gracias.php';
            }
                $('#message').html(data);
                $('#message').slideDown('slow'); // aca bajamos el mensaje de success o error
                $('#contactform img.loader').fadeOut('fast', function() {
                    $(this).remove()
                });
                $('#contactform #submit').removeAttr('disabled');
                if (data.match('success') != null){
                    // Comentar este si se quiere solo mostrar el mensaje y no hacer desaparecer el formulario
                    $('#contactform').slideUp('slow');
                }
            });
        });
        return false;
    })
}


function initInputFields(){
    var curVal;
    $('input[type=text]').each(function() {
        var ipt = $(this);
        ipt.attr('oValue', ipt.val());

        ipt.focus(function() {
            curVal = ipt.val();
            ipt.val('');
        });

        ipt.blur(function() {
            if (ipt.val() == '') {
                ipt.val(curVal);
            }
        });

    });

    $('textarea').each(function() {
        var ipt = $(this);
        ipt.attr('oValue', ipt.val());

        ipt.focus(function() {
            curVal = ipt.val();
            ipt.val('');
        });

        ipt.blur(function() {
            if (ipt.val() == '') {
                ipt.val(curVal);
            }
        });

    });

}


initInputFields();
initContactForm();
</script>