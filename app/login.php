<?php
setcookie("turismoxela",null,  time()+7200);
    session_start();
    $config= parse_ini_file("../config/turismo.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}
    $luser = \filter_var($_GET['lu']);
    $lkey = \filter_var($_GET['lk']);
    
    $query = "SELECT * FROM usuarios WHERE usuario_cuenta = '".$luser."' AND clave = '".$lkey."'";
    //echo $query;
    $result = mysqli_query($connect, $query);
    $cuantos = mysqli_num_rows($result);
    if ($cuantos === 1) {
        while ($row = mysqli_fetch_assoc($result)){
            $idusuarios = $row['idusuarios'];
            $usuario_cuenta = $row['usuario_cuenta'];
            $usuario_nombre = $row['usuario_nombre'];
            $clave = $row['clave'];
            $nivel = $row['nivel'];
            $_SESSION['idusuarios'] = $idusuarios;
            $_SESSION['usuario_nombre'] = $usuario_nombre;
            $_SESSION['nivel'] = $nivel;
            $_SESSION['ultact'] = time();
            $output = json_encode(array('idu' => $_SESSION['idusuarios'], 'nom' => $_SESSION['usuario_nombre'], 'tip' => $_SESSION['nivel']));
            $query = "INSERT INTO bitacora VALUES(NULL,NOW(),".$idusuarios.",'L',NULL,NULL)";
            if (!mysqli_query($connect,$query)){echo mysqli_errno($connect)." - ".  mysqli_error($connect);}
        }
    } else {
        $output = 0;
    }
    echo $output;
    