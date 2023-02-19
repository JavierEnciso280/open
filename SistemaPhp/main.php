<?php
    session_start();
?>


<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html charset=utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0
    maximun-scale=1, user-scalable=yes'>
    <meta name="description" content="SystemWeb">
    <meta name="autor" content="Javier Enciso">
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/skins/skin-blue.css" type="text/css">
    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/plugins/datepicker/datepicker.min.css" type="text/css">
    <link rel="stylesheet" href="assets/plugins/chosen/css/chosen.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/skins/skin-blue.min.css" type="text/css">
    <title>Login</title>

    <script language="javascript">
    function getkey(e)
    {
    if (window.event)
        return window.event.keyCode;
    else if (e)
        return e.which;
    else
        return null;
    }

    function goodchars(e, goods, field)
    {
    var key, keychar;
    key = getkey(e);
    if (key == null) return true;
        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();
        // check goodkeys
    if (goods.indexOf(keychar) != -1)
        return true;
        // control keys
    if ( key==null || key==0 || key==8 || key==9 || key==27 )
        return true;
    if (key == 13) {
        var i;
        for (i = 0; i < field.form.elements.length; i++)
    if (field == field.form.elements[i])
        break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
    };
        // else return false
        return false;
    }
    </script>

    </head>
    <body class="skin-blue fixed">
        <div class="wrapper"> <!--contenedor-->
            <header class="main-header">
                <a href="#" class="logo">
                    <img src="assets/img/log.png" alt="Logo SysWeb">
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?php include 'top-menu.php';?>
                        </ul>
                    </div>
                </nav>
            </header>
        
            <aside class="main-sidebar"><!--menu lateral del main-->
                <section class="sidebar">
                    <?php include 'sidebar-menu.php';?> <!--proceso en sidebar-menu.php-->
                </section>
            </aside>
            

            <div class="content-wrapper">
                <?php include 'content.php';?>
                <div class="modal fade" id="logout">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title"><i class="fa fa-sign-out">Salir</i></h4>
                            </div>
                            <div class="modal-body">
                                <p>Deseas salir?</p>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="logout.php">Si, salir</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <footer class="main-footer">
                <strong>Copyright &copy;<?php date('Y');?>- <a href="#" target="_blank">Desarrollado por X</a></strong>
            </footer>
            
        </div>
        
        <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/plugins/chosen/js/chosen.jquery.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.js" type="text/javascript"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.maskMoney.min.js" type="text/javascript"></script>
        <script src="assets/js/app.js" type="text/javascript"></script>

        <script type="text/javascript">
      $(function () {
        // datepicker plugin
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });

        // chosen select
        $('.chosen-select').chosen({allow_single_deselect:true}); 
        //resize the chosen on window resize
        
        // mask money
        $('#harga_beli').maskMoney({thousands:'.', decimal:',', precision:0});
        $('#harga_jual').maskMoney({thousands:'.', decimal:',', precision:0});

        $(window)
        .off('resize.chosen')
        .on('resize.chosen', function() {
          $('.chosen-select').each(function() {
             var $this = $(this);
             $this.next().css({'width': $this.parent().width()});
          })
        }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
          if(event_name != 'sidebar_collapsed') return;
          $('.chosen-select').each(function() {
             var $this = $(this);
             $this.next().css({'width': $this.parent().width()});
          })
        });
    
    
        $('#chosen-multiple-style .btn').on('click', function(e){
          var target = $(this).find('input[type=radio]');
          var which = parseInt(target.val());
          if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
           else $('#form-field-select-4').removeClass('tag-input-style');
        });

        // DataTables
        $("#dataTables1").dataTable();
        $('#dataTables2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false,

          "language": idioma_español
        });
      });

    var idioma_español= {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}

    </script>

    </body>
</html>