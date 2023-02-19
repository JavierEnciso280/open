<?php
session_start();
require_once '../../config/database.php';

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url-index.php?alert=1'>";
}else{
    if($_GET['act']=='insert'){
        if(isset($_POST['guardar'])){

            $codigo = $_POST['codigo'];
            $codigo_deposito = $_POST['deposito'];
            //insertar detalle de compra
            //seleccionar tablas producto y tmp donde el cod_producto de tabla producto es lo mismo que id_producto de la tabla tmp
            $sql = mysqli_query($conex, "SELECT * FROM producto, tmp WHERE producto.cod_producto = tmp.id_producto");

            while($row = mysqli_fetch_array($sql)){
                $codigo_producto = $row['id_producto'];//con el id_producto se obtienen las caracteristicas fijas del producto, nombre, unidad de medida y tipo
                $precio = $row['precio_tmp'];//el precio temporal de acuerdo a la cantidad de productos o si se cambia el precio en la compra
                $cantidad = $row['cantidad_tmp'];//la cantidad seleccionada en el momento de la compra

                //una vez obtenidos los datos de la compra de la tabla tmp, se procede al insert ahora en la tabla detalle_compra ya con los inputs del codigo,deposito
                $insert_detalle = mysqli_query($conex, "INSERT INTO detalle_compra (cod_producto, cod_compra, cod_deposito, precio, cantidad) values 
                ($codigo_producto, $codigo, $codigo_deposito, $precio, $cantidad)") or die('error' . mysqli_error($conex));

                //insertar stock
                //primero select y verificar los productos de la table stock
                $query = mysqli_query($conex, "SELECT * FROM stock WHERE cod_producto = $codigo_producto and cod_deposito = $codigo_deposito")
                    or die('error' . mysqli_error($conex));

                if($count = mysqli_num_rows($query)==0){
                    //si no existe ningun producto con el $codigo_deposito, insertar en la tabla stock
                    $insertar = mysqli_query($conex, "INSERT INTO  stock (cod_deposito, cod_producto, cantidad) values 
                    ($codigo_deposito, $codigo_producto,$cantidad)") or die('error' . mysqli_error($conex));

                }else{
                    //actualizar lo que ya hay
                    $actualizar = mysqli_query($conex, "UPDATE stock SET cantidad = cantidad + $cantidad WHERE cod_producto = $codigo_producto and
                    cod_deposito = $codigo_deposito") or die('error' . mysqli_error($conex));
                }
            }

            //insertar cabecera de compra
            //definir variables que vienen de la cabecera del form; proveedor,deposito,factura, fecha y hora que vienen por post del form
            //definir las variables restantes 
            $codigo_proveedor = $_POST['cod_proveedor'];
            $deposito = $_POST['deposito'];
            $factura = $_POST['nro_factura'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];

            $sumaTotal = $_POST['suma_total'];//del input en archivo agregar_pedido
            $estado = 'activo';//definir como activo 
            $user = $_SESSION['id_user']; //capturar el usuario que realiza la compra
            //insertar
            $query = mysqli_query($conex, "INSERT INTO compra (cod_compra,cod_proveedor,cod_deposito,nro_factura,fecha,hora,estado,total_compra,id_user) 
            values ($codigo,$codigo_proveedor,$deposito,'$factura','$fecha','$hora','$estado',$sumaTotal,$user)")
             or die('error' . mysqli_error($conex));
            
            if($query){
                header("location: ../../main.php?module=compras&alert=1");
            }else{
                header("location: ../../main.php?module=compras&alert=2");

            }
        }

    }
    elseif($_GET['act']=='anular'){//act anular del view.php
        if(isset($_GET['cod_compra'])){
            $codigo = $_GET['cod_compra'];
            //anular cabecera de compra (cambiar estado a anulado)
            $anular = mysqli_query($conex, "UPDATE compra SET estado = 'anulado' WHERE cod_compra=$codigo")
                or die('error' . mysqli_error($conex));

            //consultar detalle de compra utilizando el mismo codigo que viene por get
            $sql = mysqli_query($conex, "SELECT * FROM detalle_compra WHERE cod_compra = $codigo");
            while($row = mysqli_fetch_array($sql)){
                //se resta la cantidad, mientras el codigo del producto sea x y mientras el codigo del deposito sea y
                $codigo_producto = $row['cod_producto'];
                $codigo_deposito = $row['cod_deposito'];
                $cantidad = $row['cantidad'];
                //actualizar stock
                $actualizar = mysqli_query($conex, "UPDATE stock SET cantidad=cantidad-$cantidad WHERE cod_producto = $codigo_producto and cod_deposito= $codigo_deposito") or die('error' . mysqli_error($conex));
                //comprobar si accion es exitosa
                if($actualizar){
                    header("location: ../../main.php?module=compras&alert=2");
                }else{
                    header("location: ../../main.php?module=compras&alert=4");
                }   

            }
        }
    }
}
?>