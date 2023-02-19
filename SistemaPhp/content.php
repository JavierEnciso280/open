<?php 
    require "config/database.php";

    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    }
    else{
        
        if($_GET['module'] =='start'){
            include "modules/start/view.php";
        }

        elseif($_GET['module']=='pass'){
            include "modules/password/view.php";
        }

        elseif($_GET['module']=='user'){
            include "modules/user/view.php";
        }

        elseif($_GET['module']=='form-user'){
            include "modules/user/form-user.php";

        }elseif($_GET['module']=='perfil'){
            include "modules/perfil/view.php";
            
        }elseif($_GET['module']=='form-perfil'){
            include "modules/perfil/form.php";
        }
        elseif($_GET['module']=='depto'){
            include "modules/departamento/view.php";
        }
        elseif($_GET['module']=='form-depto'){
            include "modules/departamento/form.php";
        }
        elseif($_GET['module']=='city'){
            include "modules/ciudad/view.php";
        }
        elseif($_GET['module']=='city-form'){
            include "modules/ciudad/form.php";
        }
        elseif($_GET['module']=='clientes'){
            include "modules/clientes/view.php";
        }
        elseif($_GET['module']=='form-clientes'){
            include "modules/clientes/form.php";
        }
        elseif($_GET['module']=='compras'){
            include "modules/compras/view.php";
        }
        elseif($_GET['module']=='form-compras'){
            include "modules/compras/form.php";
        }
        elseif($_GET['module']=='stock'){
            include "modules/stock/view.php";
        }
	
    }

?>