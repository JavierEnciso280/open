
<section class="content-header">
    <h1>
        <i class="fa fa-user icon-title"></i> Gestión de usuarios
        <a class="btn btn-primary btn-social pull-right" href="?module=form-user&form=add" data-toggle="tooltip" title="Agregar">
            <i class="fa fa-plus"></i>Agregar
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-mb-12">
            <?php
                if(empty($_GET['alert'])){
                    echo "";
                }elseif($_GET['alert']==1){
                    echo "
                        <div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-check-circle'></i>Exito</h4>
                            Datos guardados
                        </div>
                    ";
                }elseif($_GET['alert']==2){
                    echo "
                        <div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-check-circle'></i>Exito</h4>
                                Datos actualizados correctamente
                            </div>
                    ";
                }elseif($_GET['alert']==3){
                    echo "
                        <div class='alert alert-succes alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-check-circle'></i></h4>
                            Usuario activado correctamente
                        </div>
                    ";
                }elseif($_GET['alert']==4){
                    echo "
                        <div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-check-circle'></i></h4>
                            Usuario bloqueado correctamente
                        </div>
                    ";
                }
                elseif($_GET['alert']==5){
                    echo "
                        <div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-times-circle'></i>Error</h4>
                            Asegurese de que el formato de la imagen sea el correcto
                        </div>
                    ";
                }
                elseif($_GET['alert']==6){
                    echo "
                        <div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-times-circle'></i>Error</h4>
                            Archivo debe ser menor a 1MB
                        </div>
                    ";
                }
                elseif($_GET['alert']==7){
                    echo "
                        <div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-times-circle'></i>Error</h4>
                            Asegurese de que el tipo de archivo sea *.JPG *.JPEG *.PNG
                        </div>
                    ";
                }
            ?>

            <!--dataTable-->
            <div class="box box-primary">
                <div class="box-body">

                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="center">Nro</th>
                                <th class="center">Foto</th>
                                <th class="center">Nombre</th>
                                <th class="center">Nombre del usuario</th>
                            
                                <!--<th class="center">Email</th>-->                            
                                <th class="center">Permisos de acceso</th>
                                <th class="center">Status</th>
                                <!--<th class="center">Acciones</th>-->                            
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $nro = 1;
                            $query = mysqli_query($conex, "SELECT * FROM usuarios ORDER BY id_user DESC")
                            or die('error'.mysqli_error($conex));

                            while($data = mysqli_fetch_assoc($query)){
                                echo "<tr>
                                        <td width='50' class='center'>$nro</td>";

                                        if($data['foto']==""){?>
                                        <!--<td class="center"><img src="images/user/user-default.png" width="40" class="img-user"></td>-->
                                <?php 
                                    }else{ ?>
                                        <td class="center"><img class="img-user" src='images/user/<?php echo $data['foto'];?>' width="40"></td>
                                        
                                <?php }
                                echo "  
                                        <td>$data[username]</td>
                                        <td>$data[name_user]</td>
                                
                                        <td>$data[permisos_acceso]</td>
                                        <td>$data[status]</td>
                                        <td class='center' width='100'>
                                            <div>";
                                                // botones de bloqueado y modificar module=form y condicion act=off

                                                if($data['status']=='activo'){   ?>
                                                    <a href="modules/user/proces.php?act=off&id=<?php echo $data['id_user'];?>" data-toggle="tooltip" data-placement="top" title="BLOQUEADO" style="margin-right:5px ;" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-off"></i></a>
                                        <?php   }else { //ref module=form y condicion act=on ?>
                                                    <a href="modules/user/proces.php?act=on&id=<?php echo $data['id_user'];?>" data-toggle="tooltip"       data-placement="top" title="BLOQUEADO" style="margin-right:5px ;" class="btn btn-warning    btn-sm"><i class="glyphicon glyphicon-off"></i></a>
                                        <?php   }
                                                    //button de modificar ref module=form con id de la bd
                                                    //este id se consulta si existe en esta referencia form=edit
                                                    echo "<a data-toggle='tooltip' data-placement='top' title='Modificar' class='btn btn-primary btn-sm' href='?module=form-user&form=edit&id=$data[id_user]'><i style='color:#fff'; class='glyphicon glyphicon-edit'></i>
                                                    </a>
                                            </div>
                                        </td> 
                                    </tr>";
                                $nro++;  //autoincrementar el numero asignado a cada usuario     
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</section>