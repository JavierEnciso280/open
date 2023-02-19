
<?php
    
    ?>
    
    <section class="content-header">
        <ol class="breadcrumb" style="margin-right:150px ;">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li class="active"><a href="?module=clientes">Clientes</a></li>  
        </ol>
    
        <h1>
            <i class="fa fa-edit icon-title"></i> Datos de Clientes
            <li style="list-style:none;"><a class="btn btn-primary btn-social pull-right" data-toggle="tooltip" title="Agregar" href="?module=form-clientes&form=agregar">
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
                    <div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito</h4>
                        Datos modificados
                    </div>
                    ";
                }
                elseif ($_GET['alert']==3) {
                    echo "
                    <div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito</h4>
                        Datos eliminados correctamente
                    </div>
                    ";
                }
                elseif ($_GET['alert']==4) {
                    echo "
                    <div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times</button>
                        <h4><i class='icon fa fa-check-circle'></i>Error</h4>
                        Algo ha salido mal!
                    </div>
                    ";
                }
                ?>
                <!--body section-->
    
                <div class="box box-primary">
                    <div class="box-body">
                    <section class="content-header">
                        <a class="btn btn-warning btn-social pull-right" href="modules/clientes/print.php" target="_blank">
                            <i class="fa fa-print"></i>Imprimir reporte de clientes
                        </a>
                    </section>
    
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                            <h2>Lista de Clientes</h2>
                            <!--Cabecera de la tabla-->
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>RUC</th>
                                    <th>Depto</th>
                                    <th>Ciudad</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Telefono</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                <!--mostrar la lista de datos de la bd con php-->
                                <?php
                                $query = mysqli_query($conex, "SELECT * FROM v_clientes")//traer todos los datos de la tabla ciudad
                                or die('error'.mysqli_error($conex));
    
                                //asignar a un array los datos y recorrer con while
                                while($data = mysqli_fetch_assoc($query)){
                                    //ir capturando los datos
                                    $id_cliente=$data['id_cliente'];
                                    $ci_ruc = $data['ci_ruc'];
                                    $cli_nombre = $data['cli_nombre'];
                                    $cli_apellido = $data['cli_apellido'];
                                    $cli_telefono = $data['cli_telefono'];
                                    $dep_descripcion = $data['dep_descripcion'];
                                    $descrip_ciudad = $data['descrip_ciudad'];
    
                                    echo "
                                        <tr>
                                            <td class='center'>$id_cliente</td>
                                            <td class='center'>$ci_ruc</td>
                                            <td class='center'>$dep_descripcion</td>
                                            <td class='center'>$descrip_ciudad</td>
                                            <td class='center'>$cli_nombre</td>
                                            <td class='center'>$cli_apellido</td>
                                            <td class='center'>$cli_telefono</td>
                                            <td class='center' width='80'>
                                                <div>
                                                    <a data-toggle='tooltip' data-placement='top' title='Modificar Clientes' style='margin-right:5px;' class='btn btn-primary btn-sm' 
                                                    href='?module=form-clientes&form=edit&id_modify_client=$id_cliente'>
                                                    <i class='glyphicon glyphicon-edit' style='color:white;'></i></a>
                                                    ";?>
                                                    
                                                    <a data-toggle="tooltip" data-placement="top" title="Eliminar datos" class="btn btn-danger btn-sm
                                                    " href="modules/clientes/proces.php?act=delete&id_delete=<?php echo $id_cliente;?>"
                                                    onclick="return confirm('Estás seguro que deseas eliminar <?php echo $cli_nombre;?>?')">
                                                    <!--el btn delete llama directamente al proces.php y ahi usa la condicion act=delete, enviando el id desde aca para que cargue los valores a eliminar-->
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    </a><?php echo"
                                                </div>
                                            </dt>
                                        </tr>
                                    ";
                                }?>
    
                            </tbody>
    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>