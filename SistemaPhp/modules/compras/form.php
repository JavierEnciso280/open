<?php
    if($_GET['form']=='agregar'){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon title"></i> Nueva compra
            </h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="?module=start">Inicio</a></li>
                <li class=""><a href="?module=compras">Compras</a></li>
                <li class="active">Agregar</li>
                
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" method="POST" action="modules/compras/proces.php?act=insert">
                            <div class="box-body">

                                <!--generar automaticamente el codigo en este bloque-->
                                <?php
                                //obtener el ultimo cod_compra de la tabla compra con la siguiente consulta
                                $consulta_Id = mysqli_query($conex, "SELECT MAX(cod_compra) as id FROM compra")
                                or die('error'.mysqli_error($conex));
                                //contar
                                $contar = mysqli_num_rows($consulta_Id);
                                if($contar<>0){
                                    $data_id = mysqli_fetch_assoc($consulta_Id);
                                    $codigo = $data_id['id']+1; //obtenido el cod_compra con alias 'id', se suma 1 para fijar en la variable $codigo el numero a ser utilizado en la siguiente compra
                                }else{
                                    $codigo = 1;
                                }
                                ?>
                                <!--fin de bloque generar codigo-->

                                <!--Codio-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $codigo;?>" readonly>
                                        <!--aca se inserta el $codigo generado en la consulta anterior-->
                                    </div>

                                    <label class="col-sm-1 control-label">Fecha</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control datepicker" data-data-format="dd-mm-yyyy" name="fecha" autocomplete="off" value="<?php echo date('yy-m-d');?>" readonly>
                                        <!--se inserta en el input la fecha del servidor-->
                                    </div>
                                        
                                    <label class="col-sm-2 control-label">Hora</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control datepicker" data-data-format="H-mm-ss" name="hora" autocomplete="off" value="<?php echo date('H:i:s');?>" readonly>
                                        <!--se inserta en el input la hora del servidor-->
                                    </div>
                                </div>

                                <!--Combo buscador proveedor-->
                                <div class="form-group">
                                   <label class="col-sm-2 control-label">Proveedor</label>

                                   <div class="col-sm-3">
                                     <select class="chosen-select" name="cod_proveedor" data-placeholder="--Seleccionar proveedor--" aria-autocomplete="off" required>
                                        <option value=""></option><!--primer option vacio-->
                                        <?php
                                            //realizar consulta sql para obtener los datos a fijar como opciones, en este caso proveedor
                                            $consultaProv = mysqli_query($conex, "SELECT cod_proveedor, razon_social,ruc FROM proveedor order by cod_proveedor asc ")
                                            or die('error' . mysqli_error($conex));
                                            //recorrer con while previamente convertir a array la consulta
                                            while($dataProv = mysqli_fetch_assoc($consultaProv)){
                                                //el segundo option trae los valores razon social y ruc, con el cod_proveedor como parámetro
                                                echo "<option value='$dataProv[cod_proveedor]'>$dataProv[razon_social] | $dataProv[ruc]</option>"; 
                                            }
                                        ?>
                                     </select>   
                                   </div>

                                   <!--FACTURA-->
                                   <label class="col-sm-2 control-label">Nro de Factura</label>
                                   <div class="col-sm-3">
                                        <input type="text" class="form-control" name="nro_factura" autocomplete="off" required>
                                   </div>

                                </div>

                                <!--COMBO BUSCADOR DE DEPOSITO-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Depósito</label>
                                    <div class="col-sm-3">

                                        <select name="deposito" class="chosen-select" data-placeholder="--Seleccionar depósito--" autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                             $consultaDep = mysqli_query($conex, "SELECT * FROM deposito order by cod_deposito asc") or die('error' . mysqli_error($conex));
                                             while($dataDepo = mysqli_fetch_assoc($consultaDep)){
                                                echo "<option value='$dataDepo[cod_deposito]'>$dataDepo[cod_deposito] | $dataDepo[descrip]";
                                             }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <hr><!------------------------------------------------------------------------------------------------------>
                                <!--FORM-GROUP BOTON MODAL AGREGAR PRODUCTOS -->
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="col-sm-2 control-label">Productos</label>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalUno">
                                            <span class="glyphicon glyphicon-plus">Agregar Productos</span>
                                        </button>
                                    </div> 
                                </div>
                                <!--FIN DEL FORM-GROUP BOTON AGREGAR PRODUCTOS-->
                                <!--CARGAR LOS RESULTADOS-->
                                <div id="resultados" class="col-md-9">  
                                </div>

                                <!--BOTONES-->
                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Guardar">
                                            <a class="btn btn-default btn-reset" href="?module=compras">Cancelar</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

<?php
    }//fin del add
?>
    <!--SCRIPTS NECESARIOS PARA AJAX Y JSON-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <!--llamar al modal DESDE OTRO ARCHIVO AQUI
    //include "modules/compras/modals.php";-->

    <script>
        $(document).ready(function(){
            load(1);
        });

        function load(page){
            var x = $("#x").val(); //capturar el value del input
            var parametros = {"action":"ajax","page":page,"x":x};
            //buscar
            $("#loader").fadeIn('slow'); //gif loader
            //llamar archivo
            $.ajax({
                url:'./ajax/productos_pedidos.php',
                data: parametros,
                beforeSend: function(objeto){
                    $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');//div id=loader del modal
                },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    //parar loader
                    $('#loader').html('');
                }
            })
        }
    </script>
    <script>
        function agregar(id){
            var precio_compra = $('#precio_compra_'+id).val();
            var cantidad = $('#cantidad_'+id).val();
            //validaciones de cantidad y precio
            if(isNaN(cantidad)){
                alert('Esto no es un número');
                document.getElementById('cantidad_'+id).focus();
                return false;
            }
            if(isNaN(precio_compra)){
                alert ('Esto no es un número');
                document.getElementById('precio_compra_'+id).focus();
                return false;
            }//fin de validaciones
            var parametros={"id":id,"precio_compra_":precio_compra, "cantidad":cantidad};
            //enviar valores con ajax
            $.ajax({
                type: "POST",
                url: "./ajax/agregar_pedido.php",
                data: parametros,
                beforeSend: function(objeto){
                    $("#resultados").html("Mensaje: Cargando...");
                },
                success: function(datos){
                    $("#resultados").html(datos);
                }
            });
        }
        //funcion eliminar/cancelar producto
        function eliminar(id){
            $.ajax({
                type: "GET",
                url: "./ajax/agregar_pedido.php",
                data: "id="+id,
                beforeSend: function(objeto){
                    $("#resultados").html("Mensaje: eliminando...");
                },
                success: function(datos){
                    $("#resultados").html(datos);
                }
            });
        }
    </script>

<!--************************************VENTANA EMERGENTE AGREGAR PRODUCTOS*************************************-->
<div class="modal fade bs-example-modal-lg" id="modalUno" tabindex="-1" role="dialog" aria-labelledby="modalOneLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"><!--inicio cabecera-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>&times;
                </button><!--boton x -->
                <h4 class="modal-title" id="myTitleModal">Buscar productos</h4>
            </div><!--fin de cabecera-->

            <!--cuerpo del formulario-->
            <div class="modal-body">
                <form class="form-horizontal">

                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="x" placeholder="Buscar productos" onkeyup="load(1)">
                        </div>
                        <button type="button" class="btn btn-default" onclick="load(1)"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                    </div>

                </form>

                <div id="loader" style="position: absolute; text-align: center; top: 55px; width: 100%; display: none;"></div>
                
                <div class="outer_div"></div>
                <!--icono loader y outer_div llamar con script-->
                
            </div>
                <!--BOTON CERRAR MODAL-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!--*****************************************************************************************************************************-->


   

