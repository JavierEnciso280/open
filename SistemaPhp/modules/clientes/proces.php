
<?php

session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url-index-php?alert=3'>";
}else{
    if($_GET['act']=='add'){
        if(isset($_POST['guardar'])){
            //capturar todos los inputs de fom=add
            $codigoCliente = $_POST['codigo'];
            $cod_ciud  =$_POST['cod_ciud'];
            $ci_ruc = $_POST['ci_ruc'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $telefono = $_POST['tel'];

            //validaciones para los campos no requeridos; telefono y direccion
            if(!empty($_POST['direccion'])){
                $direccion = $_POST['direccion'];
            }else{
                $direccion = "No se encuentran registros";
            }
            if(!empty($_POST['telefono'])){
                $telefono = $_POST['telefono'];
            }else{
                $telefono = "000";
            }

            $query = mysqli_query($conex, "INSERT INTO clientes (id_cliente,cod_ciudad,ci_ruc,cli_nombre,cli_apellido,cli_direccion,cli_telefono) VALUES ($codigoCliente,$cod_ciud,'$ci_ruc','$nombres','$apellidos','$direccion','$telefono')")
            or die('error'.mysqli_error($conex));

            if($query){
                header("location: ../../main.php?module=clientes&alert=1");
            }else{
                header("location: ../../main.php?module=clientes&alert=4");
            }
        }
    }
    elseif($_GET['act']=='update'){
        if($_POST['guardar']){
            if(isset($_POST['codigo'])){// name=codigo del form.php

                $codigoCliente = $_POST['codigo'];
                $cod_ciud  =$_POST['up_codCiud'];
                $ci_ruc = $_POST['up_ciRuc'];
                $nombres = $_POST['up_nombres'];
                $apellidos = $_POST['up_apellidos'];
    
                //validaciones para los campos no requeridos; telefono y direccion
                if(!empty($_POST['up_direccion'])){
                    $direccion = $_POST['up_direccion'];
                }else{
                    $direccion = "No se encuentran registros";
                }
                if(!empty($_POST['up_telefono'])){
                    $telefono = $_POST['up_telefono'];
                }else{
                    $telefono = "000";
                }


                $actualizar = mysqli_query($conex, "UPDATE clientes SET 
                cod_ciudad = $cod_ciud,
                ci_ruc = $ci_ruc,
                cli_nombre = '$nombres',
                cli_apellido = '$apellidos',
                cli_direccion = '$direccion',
                cli_telefono = '$telefono' WHERE id_cliente = $codigoCliente")
                or die('error'.mysqli_error($conex));

                if($actualizar){
                    header("Location: ../../main.php?module=clientes&alert=2");
                }else{
                    header("Location: ../../main.php?module=clientes&alert=4");
                }
            }
        }

    }
    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_delete'])){//viene directo desde el btn eliminar de view.php, el id_city esta incluido en el href
            $codigo = $_GET['id_delete'];//asignar ese id que se trae de POST a una variable

            //consulta para eliminar
            $eliminar = mysqli_query($conex, "DELETE FROM clientes 
            WHERE id_cliente = $codigo")
            or die('error'.mysqli_error($conex));

            if($eliminar){
                header("location: ../../main.php?module=clientes&alert=3");//en content.php module=city hace referencia a view.php
            }else{
                header("location: ../../main.php?module=clientes&alert=4");
            }
        }
    }
    
}
?>