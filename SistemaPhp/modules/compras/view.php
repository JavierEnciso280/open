
<?php
    
    ?>
    
    <section class="content-header">
        <ol class="breadcrumb" style="margin-right:150px ;">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li class="active"><a href="?module=compras">Compras</a></li>  
        </ol>
    
        <h1>
            <i class="fa fa-edit icon-title"></i> Datos de compras
            <li style="list-style:none;"><a class="btn btn-primary btn-social pull-right" data-toggle="tooltip" title="Agregar" href="?module=form-compras&form=agregar">
                <i class="fa fa-plus"></i>Agregar</a>
            </li>
        </h1>
        <br>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!--Mensajes-->
                <?php
                if(empty($_GET['alert'])){
                    echo "";
                }
                elseif ($_GET['alert']==1) {
                    echo "
                    <div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito</h4>
                        Datos insertados correctamente
                    </div>
                    ";
                }
                elseif ($_GET['alert']==2) {
                    echo "
                    <div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito</h4>
                        Datos anulados correctamente!
                    </div>
                    ";
                }
                elseif ($_GET['alert']==3) {
                    echo "
                    <div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times</button>
                        <h4><i class='icon fa fa-check-circle'></i>Error</h4>
                        No se pudo ingresar la compra!
                    </div>
                    ";
                }
                elseif ($_GET['alert']==4) {
                    echo "
                    <div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times</button>
                        <h4><i class='icon fa fa-check-circle'></i>Error</h4>
                        No se pudo anular la compra!
                    </div>
                    ";
                }
                ?>
                <!--body section-->
    
                <div class="box box-primary">
                    <div class="box-body">
                        
    
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                            <h2>Lista de Compras</h2>
                            <!--Cabecera de la tabla-->
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Proveedor</th>
                                    <th>Deposito</th>
                                    <th>Nro Factura</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Total</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                <!--mostrar la lista de datos de la bd con php-->
                                <?php
                                $nro = 1;
                                $query = mysqli_query($conex, "SELECT * FROM v_compras WHERE estado = 'activo'")
                                or die('error'.mysqli_error($conex));
                                //vista solo donde estado sea activo, porque se pueden anular las compras con el estado 'anulado'
    
                                //asignar a un array los datos y recorrer con while
                                while($data = mysqli_fetch_assoc($query)){
                                    //ir capturando los datos
                                    $cod_compra=$data['cod_compra'];
                                    $proveedor = $data['razon_social'];
                                    $deposito = $data['descrip'];
                                    $factura = $data['nro_factura'];
                                    $fecha = $data['fecha'];
                                    $hora = $data['hora'];
                                    $total = $data['total_compra'];
                                    
    
                                    echo "
                                    <tr>
                                    <td class='center'>$cod_compra</td>
                                    <td class='center'>$proveedor</td>
                                    <td class='center'>$deposito</td>
                                    <td class='center'>$factura</td>
                                    <td class='center'>$fecha</td>
                                    <td class='center'>$hora</td>
                                    <td class='center'>$total</td>
                                    <td class='center' width='80'>
                                        <div>"?>
                                            <a data-toggle="tooltip" data-placement="top" title="Anular compra" class="btn btn-danger btn-sm" href="modules/compras/proces.php?act=anular&cod_compra=<?php echo $cod_compra; ?>" onclick="return confirm('Estás seguro/a de anular la factura <?php echo $factura; ?>?');">
                                                <i style="color:white ;" class="glyphicon glyphicon-trash"></i>
                                            </a> 
                                            
                                            <a data-toggle="tooltip" data-placement="top" title="Imprimir factura de compra" class="btn btn-warning btn-sm" href="modules/compras/print.php?act=imprimir&cod_compra=<?php echo $cod_compra;?> " target="_blank">
                                                <i style="color: black;" class="fa fa-print"></i>
                                            </a>
                                    <?php echo"
                                        </div>
                                    </td>
                                    </tr> ";
                                }?>
    
                            </tbody>
    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>