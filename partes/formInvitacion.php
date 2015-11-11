
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/ingreso.css" rel="stylesheet">
<?php 

require_once("clases/validadora.php");

if(validadora::validarSesionActual()){  ?>
    <div class="container">

      <form class="form-ingreso" onsubmit="GuardarCD();return false">
        <h2 class="form-ingreso-heading">CD</h2>
        <label for="cantante" class="sr-only">Cantante</label>
        <input type="text"  minlength="6"  id="cantante" title="Se necesita un nombre de cantante" class="form-control" placeholder="Cantante" required="" autofocus="">
        <label for="titulo" class="sr-only">Titulo</label>
        <input type="text"  minlength="6"  id="titulo" title="Se necesita un titulo del disco"  class="form-control" placeholder="Titulo" required="" autofocus="">
        <label for="anio" class="sr-only">Año</label>
        <input type="number"   min="1900" title="Un año entre 1900 y hoy"  max="2099" id="anio" class="form-control" placeholder="año" required="" autofocus="">
       <input readonly   type="hidden"    id="idCD" class="form-control" >
       
        <button  class="btn btn-lg btn-success btn-block" type="submit"><span class="glyphicon glyphicon-floppy-save">&nbsp;&nbsp;</span>Guardar </button>
     
      </form>

    </div> <!-- /container -->

  <?php }else{    echo"<h3>Usted no esta logeado o ha excedido su tiempo de sesión. </h3>";?>         
   
  <?php  }  ?>
    
  
