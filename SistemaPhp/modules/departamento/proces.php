
<?php

session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url-index-php?alert=3'>";
}else{
    if($_GET['act']=='insert'){
        if(isset($_POST['guardar'])){
            $codigo = $_POST['codigo'];//lo que viene por POST de name=codigo en form.php
            $dep_descrip = $_POST['dep_descripcion'];

            $query = mysqli_query($conex, "INSERT INTO departamento values ($codigo,'$dep_descrip')")
            or die('error'.mysqli_error($conex));

            if($query){
                header("location: ../../main.php?module=depto&alert=1");
            }else{
                header("location: ../../main.php?module=depto&alert=4");
            }
        }
    }
    elseif($_GET['act']=='update'){
        if($_POST['btn-update']){
            if(isset($_POST['codigo-update'])){// name=codigo del form.php
                $codigo = $_POST['codigo-update'];
                $descrip = $_POST['depto-update'];

                $actualizar = mysqli_query($conex, "UPDATE departamento SET dep_descripcion = '$descrip' 
                WHERE id_departamento = $codigo")
                or die('error'.mysqli_error($conex));

                if($actualizar){
                    header("Location: ../../main.php?module=depto&alert=2");
                    //archivo main/pasa al module=depto(que en content lleva a view y con el & que use el alert=2 de view)
                }else{
                    header("Location: ../../main.php?module=depto&alert=4");
                }
            }
        }

    }
    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_depto'])){
            $codigo = $_GET['id_depto'];

            $eliminar = mysqli_query($conex, "DELETE FROM departamento 
            WHERE id_departamento = $codigo")
            or die('error'.mysqli_error($conex));

            if($eliminar){
                header("location: ../../main.php?module=depto&alert=3");
            }else{
                header("location: ../../main.php?module=depto&alert=4");
            }
        }
    }
    
}
?>