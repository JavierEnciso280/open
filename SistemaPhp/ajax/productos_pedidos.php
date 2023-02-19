<?php
require_once '../config/database.php';

$action = (isset($_REQUEST['action']) && $_REQUEST['action']!= NULL)?$_REQUEST['action'] : '';
if($action = 'ajax'){
    $x = mysqli_real_escape_string($conex,(strip_tags($_REQUEST['x'],ENT_QUOTES)));
    $aColumns = array('cod_producto', 'cod_tipo_prod', 'id_u_medida', 'p_descrip', 'precio');//datos de la tabla producto
    $sTable = "producto";
    $sWhere = "";
    //comprobar si la variable del input x está vacio
    if($_GET['x']!= ""){
        $sWhere = "WHERE (";
        //recorrer las columnas de la tabla
        for($i=0;$i<count($aColumns);$i++){
            $sWhere .= $aColumns[$i] . " LIKE '%" . $x . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }

    //paginacion
    include 'paginacion.php';
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 5;
    $adjacents = 4;
    $offset = ($page - 1) * $per_page;

    $count_query = mysqli_query($conex, "SELECT count(*) as numrows FROM $sTable $sWhere");
    $rows = mysqli_fetch_array($count_query);
    $num_rows = $rows['numrows'];
    $total_pages = ceil($num_rows/$per_page);
    $reload = './index.php';

    $sql = "SELECT * FROM $sTable $sWhere LIMIT $offset, $per_page";
    $query = mysqli_query($conex, $sql);

    if($num_rows>0){ ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tr class="warning">
                    <th>Código del producto</th>
                    <th>Tipo del producto</th>
                    <th>Unidad de medida del producto</th>
                    <th>Nombre del producto</th>
                    <th><span class="pull-right">Cantidad</span></th>
                    <th><span class="pull-right">Precio</span></th>
                    <th style="width:36px;">Seleccionar</th>
                </tr>

                <?php
                while($row = mysqli_fetch_assoc($query)){
                    $id_producto = $row['cod_producto'];
                    $descrip = $row['p_descrip'];
                    
                    $cod_tipo_prod = $row['cod_tipo_prod'];
                    $sql_tipo_prod = mysqli_query($conex, "SELECT t_p_descrip FROM tipo_producto WHERE cod_tipo_prod ='$cod_tipo_prod'");
                    $row_tipo_prod = mysqli_fetch_array($sql_tipo_prod);
                    $tproducto_nombre = $row_tipo_prod['t_p_descrip'];

                    $id_u_medida= $row['id_u_medida'];
                    $sql_u_medida = mysqli_query($conex, "SELECT u_descrip FROM u_medida WHERE id_u_medida = '$id_u_medida'");
                    $row_u_medida = mysqli_fetch_array($sql_u_medida);
                    $u_medida_nombre = $row_u_medida['u_descrip'];

                    $precio_compra = $row['precio']; ?>

                        <tr>
                            <td><?php echo $id_producto;?></td>
                            <td><?php echo $cod_tipo_prod;?></td>
                            <td><?php echo $id_u_medida;?></td>
                            <td><?php echo $descrip;?></td>
                            <td class="col-xs-1">
                                <div class="pull-right">
                                    <input type="text" class="form-control" style="text-align: right;" id="cantidad_<?php echo $id_producto;?>" value="1"><!--id cantidad del form-->
                                </div>
                            </td>

                            <td class="col-xs-2">
                                <div class="pull-right">
                                    <input type="text" class="form-control" style="text-align: right;" id="precio_compra_<?php echo $id_producto; ?>" value="<?php echo $precio_compra;?>"><!--id cantidad del form-->
                                </div>
                            </td>

                            <td><span class="pull-right"><a href="#" onclick="agregar('<?php echo $id_producto;?>')"><i class="glyphicon glyphicon-plus"></i></a></span></td>

                        </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan=5><span class="pull-right">
                        <?php
                            echo paginate($reload, $page, $total_pages, $adjacents);
                        ?></span>
                    </td>
                </tr>
            </table>
        </div>

        <?php
    }


}
?>