<?php 

if(isset($_GET['IDAmigurumi'])){
  $IDAmigurumi = (isset($_GET['IDAmigurumi'])) ? $_GET['IDAmigurumi'] : null;
}elseif(isset($_GET['a'])){
  $IDAmigurumi = (isset($_GET['a'])) ? $_GET['a'] : null;
}

// include ('../configuracion.php');
include_once('../MySqli_conexionDB.php');

$listImagenAmg = obtenerListaImagenesAmigurumis($IDAmigurumi);

// $listImagenAmg = obtenerListaImagenesAmigurumis();
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
  <div class="container">
       <br/><br/><br/>
    <div class="row">
       <div class="col-lg-4">
         <h1 class="text-primary">Subir Imagen</h1>
         <form action="Amigurumis/subirImagenes.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" id="IDAmigurumiImagenes" name="IDAmigurumiImagenes" value="<?=$IDAmigurumi?>"/>
          <div class="form-group">
              <label for="my-input">Seleccione una Imagen</label>
              <input id="my-input"  type="file" name="NombreFoto">
          </div>
          <div class="form-group">
              <label for="my-input">Titulo de la Imagen</label>
              <input id="my-input" class="form-control" type="text" name="titulo">
          </div>
          <?php if(isset($_SESSION['mensaje'])){ ?>
          <div class="alert alert-<?php echo $_SESSION['tipo'] ?> alert-dismissible fade show" role="alert">
         <strong><?php echo $_SESSION['mensaje']; ?></strong> 
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
     </button>
       </div>
          <?php unset($_SESSION['mensaje']); 
                unset($_SESSION['tipo']);} ?>
          <input type="submit" value="Guardar" class="btn btn-primary" name="Guardar">
         </form>
       </div>
       <div class="col-lg-8">
           <h1 class="text-primary text-center">Galeria de Imagenes</h1>
           <br/><hr>
           <div class="card-columns">
          <?php foreach($listImagenAmg AS $campos){ 
                  if($IDAmigurumi == $campos['IDAmigurumi']){?>
         <div class="card">
      <img src="<?=$campos['mostrarImagenAmigurumi']?>" class="card-img-top" alt="...">
       <div class="card-body">
      <h5 class="card-title"><strong><?=$campos['AltText']?></strong></h5>
    </div>
               
  </div>
  <?php }}?>
       </div>
    </div>
  </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>