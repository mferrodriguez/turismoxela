<?php

    session_start();
    $config= parse_ini_file("../config/turismo.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}
    $luser = $_SESSION['idusuarios'];
    
    $query = "INSERT INTO bitacora VALUES(NULL,NOW(),".$luser.",'O',NULL)";
    if (mysqli_query($connect, $query)){
        setcookie("turismoxela",null,  time()-7200);
        session_destroy();
    }