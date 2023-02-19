
<?php

session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url-index-php?alert=3'>";
}else{
    if($_GET['act']=='add'){
        if(isset($_POST['guardar'])){

            $codigo = $_POST['codigo'];//lo que viene por POST de name=codigo en form.php
            $depart = $_POST['depart'];
            $descrip_ciudad = $_POST['descrip_ciudad'];//lo que viene por POST de name=descrip_ciudad

            $query = mysqli_query($conex, "INSERT INTO ciudad (cod_ciudad, id_departamento, descrip_ciudad) values ($codigo,$depart, '$descrip_ciudad')")
            or die('error'.mysqli_error($conex));

            if($query){
                header("location: ../../main.php?module=city&alert=1");
            }else{
                header("location: ../../main.php?module=city&alert=4");
            }
        }
    }
    elseif($_GET['act']=='update'){
        if($_POST['btn-update']){
            if(isset($_POST['codigo-update'])){// name=codigo del form.php

                $codigo = $_POST['codigo-update'];//lo que viene por POST de name=codigo en form.php
                $depart = $_POST['depart'];
                $descrip_ciudad = $_POST['descrip_ciudad'];//lo que viene por POST de name=descrip_ciudad
    

                $actualizar = mysqli_query($conex, "UPDATE ciudad SET descrip_ciudad = '$descrip_ciudad',
                id_departamento =$depart
                WHERE cod_ciudad = $codigo")
                or die('error'.mysqli_error($conex));

                if($actualizar){
                    header("Location: ../../main.php?module=city&alert=2");
                    //archivo main/pasa al module=depto(que en content lleva a view y con el & que use el alert=2 de view)
                }else{
                    header("Location: ../../main.php?module=city&alert=4");
                }
            }
        }

    }
    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_city'])){//viene directo desde el btn eliminar de view.php, el id_city esta incluido en el href
            $codigo = $_GET['id_city'];//asignar ese id que se trae de POST a una variable

            //consulta para eliminar
            $eliminar = mysqli_query($conex, "DELETE FROM ciudad 
            WHERE cod_ciudad = $codigo")
            or die('error'.mysqli_error($conex));

            if($eliminar){
                header("location: ../../main.php?module=city&alert=3");//en content.php module=city hace referencia a view.php
            }else{
                header("location: ../../main.php?module=city&alert=4");
            }
        }
    }
    
}
?>