<?php
    if($_SESSION['permisos_acceso']=="Super Admin"){?>

        <section class="content-header">
            <h1>
                <i class="fa fa-home icon-title"></i> Inicio
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p style="font-size: 15px;">
                            <i class="icon fa fa-user"></i>Bienvenido <?php echo $_SESSION['name_user']; ?> a la aplicación <strong>SysWeb</strong>
                        </p>
                    </div>
                </div>
            </div>
        

            <h2>Formulario de movimientos</h2>
            <div class="row">
                <div class="col-lg-4 col-xs-4">
                    <div style="background-color: #00c0ef; color:white;" class="small-box">
                        <div class="inner">
                            <p><strong>Compras</strong></p>
                            <ul>
                                <li>Registrar</li>
                                <li>la compra</li>
                                <li>de productos</li>
                            </ul>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cart-plus"></i>
                        </div>
                            <a href="?module=compras" class="small-box-footer" title="Registrar compras" data-toggle="tooltip">
                            <i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-4">
                    <div style="background-color: green; color:white;" class="small-box">
                        <div class="inner">
                            <p><strong>Ventas</strong>
                            <ul>
                                <li>Registrar</li>
                                <li>venta</li>
                                <li>de productos</li>
                            </ul>
                            <div class="icon">
                                <i class="glyphicon glyphicon-piggy-bank"></i>
                            </div>
                            </p>
                        </div>
                        <a href="?module=venta" class="small-box-footer" title="Registrar venta" data-toggle="tooltip">
                        <i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-4">
                    <div style="background-color:gray ; color:white;" class="small-box">
                        <div class="inner">
                            <p><strong>Stock</strong>
                            <ul>
                                <li>Visualizar</li>
                                <li>Stock</li>
                                <li>de productos</li>
                            </ul>
                            <div class="icon">
                                <i class="fa fa-area-chart"></i>
                            </div>
                            </p>
                        </div>
                        <a href="?module=stock" class="small-box-footer" data-toggle="tooltip" title="Ver Stock">
                        <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>



            </div>
        </section>

        <?php 
    
    }else
        if($_SESSION['permisos_acceso']=="Ventas"){?>

            <section class="content-header">
                <h1>
                    <i class="fa fa-home icon-title"></i> Inicio
                </h1>
                <ol class="breadcrumb">
                    <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                   <div class="col-lg-12 col-xs-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" data-toggle="tooltip" aria-hidden="true">&times;</button>
                            <i class="fa fa-user"></i> Bienvenido <?php echo $_SESSION['name_user']?> al <strong>SysWeb</strong>
                        </div>
                   </div>
                </div>
            

                <h2>Formularios de movimiento</h2>
                <div class="row">
                    <div class="col-lg-4 col-xs-4">
                        <div class="small-box" style="background-color: green; color:white;">
                            <div class="inner">
                                <p><strong>Ventas</strong>
                                <ul>
                                    <li>Registrar</li>
                                    <li>venta de</li>
                                    <li>Productos</li>
                                </ul>
                                </p>
                            </div>
                            <div class="icon">
                            <i class="glyphicon glyphicon-piggy-bank"></i>
                            </div>
                            <a href="?module=ventas" class="small-box-footer" data-toggle="tooltip" title="Agregar venta"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-xs-4">
                        <div class="small-box" style="background-color: blue; color:white;">
                            <div class="inner">
                                <p><strong>Stock</strong>
                                <ul>
                                    <li>Visualizar</li>
                                    <li>Stock</li>
                                    <li>de Productos</li>
                                </ul>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cart-plus"></i>
                            </div>
                            <a href="?module=stock" class="small-box-footer" data-toggle="tooltip" title="Ver stock"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>


                </div>
            </section>

    <?php    
    }elseif($_SESSION['permisos_acceso']=='Compras'){ ?>
            <section class="content-header">
                <h1>
                    <i class="fa fa-home icon-title"></i> Inicio
                </h1>
                <ol class="breadcrumb">
                    <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                   <div class="col-lg-12 col-xs-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" data-toggle="tooltip" aria-hidden="true">&times;</button>
                            <i class="fa fa-user"></i> Bienvenido <?php echo $_SESSION['name_user']?> al <strong>SysWeb</strong>
                        </div>
                   </div>
                </div>

                <h2>Formularios de movimiento</h2>
            <div class="row">
                <div class="col-lg-4 col-xs-4">
                    <div style="background-color: #00c0ef; color:white;" class="small-box">
                        <div class="inner">
                            <p><strong>Compras</strong></p>
                            <ul>
                                <li>Registrar</li>
                                <li>la compra</li>
                                <li>de productos</li>
                            </ul>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cart-plus"></i>
                        </div>
                            <a href="?module=compras" class="small-box-footer" title="Registrar compras" data-toggle="tooltip">
                            <i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-4">
                    <div style="background-color:gray ; color:white;" class="small-box">
                        <div class="inner">
                            <p><strong>Stock</strong>
                            <ul>
                                <li>Visualizar</li>
                                <li>Stock</li>
                                <li>de productos</li>
                            </ul>
                            <div class="icon">
                                <i class="fa fa-area-chart"></i>
                            </div>
                            </p>
                        </div>
                        <a href="?module=stock" class="small-box-footer" data-toggle="tooltip" title="Ver Stock">
                        <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>



    <?php    
    }
    