<?php
include('../configuracion.php');
include('../MySqli_conexionDB.php');

if(isset($_POST['Guardar'])){
    $NombreFoto = $_FILES['NombreFoto']['name'];
    $AltText = $_POST['titulo'];
    $IDAmigurumi = $_POST['IDAmigurumiImagenes'];

    if(isset($NombreFoto) && $NombreFoto != ""){
        $tipo = $_FILES['NombreFoto']['type'];
        $temp  = $_FILES['NombreFoto']['tmp_name'];

       if( !( (strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'jpg') || strpos($tipo,'webp')))){
          $_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, webp';
          $_SESSION['tipo'] = 'danger';
 header('location:'.ROOTURL.'?accion=verFotosAmigurumis&a='.$IDAmigurumi);
       }else{
         $query = "INSERT INTO fotos_amigurumis(IDAmigurumi,NombreFoto,AltText) values('$IDAmigurumi','$NombreFoto','$AltText')";
         $resultado = mysqli_query($conn,$query);
         if($resultado){
            move_uploaded_file($temp,'Galeria/'. $NombreFoto);   
             $_SESSION['mensaje'] = 'se ha subido correctamente';
             $_SESSION['tipo'] = 'success';
 header('location:'.ROOTURL.'?accion=verFotosAmigurumis&a='.$IDAmigurumi);
         }else{
             $_SESSION['mensaje'] = 'ocurrio un error en el servidor';
             $_SESSION['tipo'] = 'danger';
         }
       }
    }
}


?>