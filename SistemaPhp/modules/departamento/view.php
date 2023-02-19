<?php
    if($_SESSION['id_user']){

    }
    
?>

<section class="content-header">
    <ol class="breadcrumb" style="margin-right:150px ;">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=depto">Departamento</a></li>  
    </ol>

    <h1>
        <i class="fa fa-edit icon-title"></i> Datos de departamentos
        <li style="list-style:none;"><a class="btn btn-primary btn-social pull-right" data-toggle="tooltip" title="Agregar" href="?module=form-depto&form=add">
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
                    <!--boton imprimir-->
                    <section class="content-header">
                        <a class="btn btn-warning btn-social pull-right" href="modules/departamento/print.php" target="_blank">
                            <i class="fa fa-print"></i>Imprimir
                        </a>
                    </section>

                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de departamentos</h2>
                        <!--Cabecera de la tabla-->
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!--mostrar la lista de datos de la bd con php-->
                            <?php
                            $nro=1;
                            $query = mysqli_query($conex, "SELECT * FROM departamento")//traer todos los datos de la tabla departamento
                            or die('error'.mysqli_error($conex));

                            //asignar a un array los datos y recorrer con while
                            while($data = mysqli_fetch_assoc($query)){
                                //ir capturando los datos
                                $id_depto = $data['id_departamento'];
                                $depto_descrip = $data['dep_descripcion'];

                                echo "
                                    <tr>
                                        <td class='center'>$id_depto</td>
                                        <td class='center'>$depto_descrip</td>
                                        <td class='center' width='80'>
                                            <div>
                                                <a data-toggle='tooltip' data-placement='top' title='Modificar datos de Departamento' style='margin-right:5px;' class='btn btn-primary btn-sm' 
                                                href='?module=form-depto&form=edit&id=$id_depto'>
                                                <i class='glyphicon glyphicon-edit' style='color:white;'></i></a>
                                                ";?>
                                                
                                                <a data-toggle="tooltip" data-placement="top" title="Eliminar datos" class="btn btn-danger btn-sm
                                                " href="modules/departamento/proces.php?act=delete&id_depto=<?php echo $id_depto;?>"
                                                onclick="return confirm('Estás seguro que deseas eliminar <?php echo $depto_descrip;?>?')">
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