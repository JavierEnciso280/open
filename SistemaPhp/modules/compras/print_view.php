<?php
require_once "../../config/database.php";
if($_GET['act']=='imprimir'){
    if(isset($_GET['cod_compra'])){//cod_compra que viene con el btn imprimir
        $codigoCompra = $_GET['cod_compra'];
        //cabecera de compra
        $cabecera = mysqli_query($conex, "SELECT * FROM v_compras WHERE cod_compra= $codigoCompra")
            or die('error' . mysqli_error($conex));
                                        //utilizar el array de view para simplificar
                                            $data = mysqli_fetch_assoc($cabecera);
                                            //ir capturando los datos
                                            $cod_compra = $data['cod_compra'];
                                            $proveedor = $data['razon_social'];
                                            $deposito = $data['descrip'];
                                            $factura = $data['nro_factura'];
                                            $fecha = $data['fecha'];
                                            $hora = $data['hora'];
                                            $total = $data['total_compra'];
                                            $usuario = $data['name_user'];
                                        
        //detalle de compra
        //en el detalle se van a cargar los datos en una tabla, por lo que se utiliza un while
        $detalle_compra = mysqli_query($conex, "SELECT * FROM v_detalleCompra WHERE cod_compra=$cod_compra")
            or die('error' . mysqli_error($conex));
    }
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Factura compras</title>
    </head>
    <body>
        <div align='center'>
            <h4>Registro de factura de compras</h4>

            <label><strong>Proveedor:</strong><?php echo $proveedor;?></label><br>
            <label><strong>Depósito:</strong><?php echo $deposito;?></label><br>
            <label><strong>Nro Factura:</strong><?php echo $factura;?></label><br>
            <label><strong>Fecha:</strong><?php echo $fecha;?></label><br>
            <label><strong>Hora:</strong><?php echo $hora;?></label><br>
            <label><strong>Total:</strong><?php echo $total;?></label><br>
            <label><strong>Usuario:</strong><?php echo $usuario;?></label>
            <hr>
        </div>

        <div>
            <table width="100%" border="0.3" cellpadding="0" align="center">
                <thead style="background-color: red;">
                    <tr>
                        <th height="20" align="center" valign="middle"><small>Tipo de producto </small></th>
                        <th height="20" align="center" valign="middle"><small>Producto </small></th>
                        <th height="20" align="center" valign="middle"><small>Unidad de medida </small></th>
                        <th height="20" align="center" valign="middle"><small>Precio </small></th>
                        <th height="20" align="center" valign="middle"><small>Cantidad</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //llamar al select declarado arriba
                    while($data2 = mysqli_fetch_assoc($detalle_compra)){
                        //capturar valores de la vista detalleCompra
                        $t_p_descrip = $data2['cod_compra'];
                        $cod_producto = $data2['cod_producto'];
                        $t_p_descrip = $data2['t_p_descrip'];
                        $u_descrip = $data2['u_descrip'];
                        $precio = $data2['precio'];
                        $cantidad = $data2['cantidad'];

                        //imprimir los valores capturados
                         echo "
                        <tr>
                            <td width='100' align='left'>$t_p_descrip</td>
                            <td width='100' align='center'>$cod_producto</td>
                            <td width='100' align='left'>$u_descrip</td>
                            <td width='100' align='center'>$precio</td>
                            <td width='100' align='center'>$cantidad</td>
                        </tr>
                         ";
                    }
                    ?>
                </tbody>

            </table>

        </div>
        <hr>
        <div align ="center">
                <label><strong>El total de la compra es: Gs. </strong><?php echo $total?></label>
        </div>
    </body>
</html>