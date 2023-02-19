<?php
session_start();
$session_id = session_id();
//capturar datos de la validacion en function 'agregar' productos_pedidos.php
//si existen los datos a continuacion, incluir a la base de datos
if(isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])) {$cantidad = $_POST['cantidad'];}//validacion del script en form
if (isset($_POST['precio_compra_'])) {$precio_compra_ = $_POST['precio_compra_'];}//validacioin del script en form

require_once '../config/database.php';//una vez obtenidos los datos validados, llamar a la base de datos

if(!empty($id) and !empty($cantidad) and !empty($precio_compra_)){
    $insert_temp = mysqli_query($conex, "INSERT INTO tmp (id_producto,cantidad_tmp, precio_tmp, session_id) 
    VALUES ('$id','$cantidad','$precio_compra_', '$session_id')");
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    //eliminar lo que tiene la tabla temporal
    $delete = mysqli_query($conex, "DELETE FROM tmp WHERE id_tmp = '" . $id . "'");
}
?>
<table class="table table-bordered table-striped table-hover">
    <tr class="warning">
        <th>Código</th>
        <th>Tipo de producto</th>
        <th>Unidad de medida</th>
        <th>Nombre del producto</th>
        <th><span class="pull-right">Cantidad</span></th>
        <th><span class="pull-right">Precio</span></th>
        <th style="width: 36px;"></th>
    </tr>

    <?php
    $suma_total = 0;
    //consulta de las tablas producto y tmp
    $sql = mysqli_query($conex, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto and tmp.session_id='" . $session_id . "'");

    while($row = mysqli_fetch_array($sql)){
        $id_tmp = $row['id_tmp'];
        $codigo_producto = $row['cod_producto'];
        $descrip_producto = $row['p_descrip'];
        $cantidad = $row['cantidad_tmp'];

        $cod_tipo_prod = $row['cod_tipo_prod'];

        $sql_tipo_prod = mysqli_query($conex, "SELECT t_p_descrip FROM tipo_producto WHERE cod_tipo_prod = '$cod_tipo_prod'");
        $row_tipo_prod = mysqli_fetch_array($sql_tipo_prod);
        $tproducto_nombre = $row_tipo_prod['t_p_descrip'];
        $id_u_medida= $row['id_u_medida'];
        
        $sql_u_medida = mysqli_query($conex, "SELECT u_descrip FROM u_medida WHERE id_u_medida = '$id_u_medida'");
        $row_u_medida = mysqli_fetch_array($sql_u_medida);
        $u_medida_nombre = $row_u_medida['u_descrip'];

        $precio_compra_ = $row['precio_tmp'];
        $precio_compra_f = number_format($precio_compra_);//formatear variable
        $precio_compra_r = str_replace(",", "", $precio_compra_f);//reemplazar ,
        $precio_total = $precio_compra_r * $cantidad;
        $precio_total_f = number_format($precio_total);
        $precio_total_r = str_replace(",", "", $precio_total_f);
        $suma_total += $precio_total_r;//sumador total
        ?>
        <tr>
            <!--grilla de productos SELECCIONADOS-->
            <td><?php echo $codigo_producto;?></td>
            <td><?php echo $tproducto_nombre;?></td>
            <td><?php echo $u_medida_nombre;?></td>
            <td><?php echo $descrip_producto;?></td>
            <td><span class="pull-right"><?php echo $cantidad;?></span></td>
            <td><span class="pull-right"><?php echo $precio_total_f;?></span></td>
            <td><span class="pull-right"><a href="#" onclick="eliminar('<?php echo $id_tmp;?>')"><i class="glyphicon glyphicon-trash"></i></a></span></td>
        </tr>

        <?php
    } ?>
        <tr>
            <!--CAPTURAR LAS VARIABLES ID DEL PRODUCTO, PRECIO Y CANTIDAD PARA PROCESAR-->
            <input type="hidden" class="form-control" name="suma_total" value="<?php echo $suma_total;?>">

            <?php
                if(empty($codigo_producto)){
                $codigo_producto = 0;
                }else{
                $codigo_producto;
                }
            ?>
            <input type="hidden" class="form-control" name="codigo_producto" value="<?php echo $codigo_producto;?>">

            <?php
                if(empty($cantidad)){
                $cantidad = 0;
                }else{
                $cantidad;
                }
            ?>
            <input type="hidden" class="form-control" name="cantidad" value="<?php echo $cantidad;?>">

            <td colspan="4"><span class="pull-right">Total Gs.</span></td>
            <td><strong><span class="pull-right"><?php echo number_format($suma_total);?></span></strong></td>
        </tr>
</table>
