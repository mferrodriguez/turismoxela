<?php
    session_start();
    $config= parse_ini_file("../config/turismo.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}
    
    $params = \filter_input_array(\INPUT_GET);
    
    switch ($params['a']) {
    case 0:
        // SELECCION GENERAL - PARA LLENAR EL GRID
        $query = "SELECT * FROM usuarios ORDER BY usuario_cuenta";
        $result = mysqli_query($connect, $query);
        $cuantos = mysqli_num_rows($result);
        $output="";
        if ($cuantos > 0){
            while ($row = mysqli_fetch_assoc($result)){
                if ($row['nivel']=="A") {$txtnivel = "Administrador";}else{$txtnivel = "Usuario";}
                $output = $output.
                        "<tr id='r".$row['idusuarios']."'>".
                            "<td>".
                                "<input type='radio' id='".$row['idusuarios']."' class='opcion text-center' name='seleccionar'>".
                            "</td>".
                            "<td class='text-center'>".$row['idusuarios']."</td>".
                            "<td class='text-center'>".$row['usuario_cuenta']."</td>".
                            "<td class='text-center nombre'>".$row['usuario_nombre']."</td>".
                            "<td class='text-center'>".$txtnivel."</td>".
                        "</tr>";
            }
        } else {
            $output = "AUN NO EXISTEN REGISTROS INGRESADOS ... PRESIONE [NUEVO]";
        }
        break;
    case 1:
        // INSERCION DE TUPLA
        $query = "INSERT INTO usuarios VALUES(NULL,'".$params['c']."','".$params['n']."','".$params['t']."','".$params['k']."')";
        if (!mysqli_query($connect, $query)){
            $output = mysqli_errno($connect)." - ".  mysqli_error($connect);
        } else {
            $output = 1;
            $query = "INSERT INTO bitacora VALUES(NULL,NOW(),".$_SESSION['idusuario'].",'A','Mantenimiento de Departamentos',".
                     "'".$params['c']." - ".$params['n']." - ".$params['t']."',NULL)";
            $result=\mysqli_query($connect, $query);
        }
        break;
    case 2:
        // MODIFICACION DE TUPLA
        $query = "SELECT * FROM usuarios WHERE idusuarios='".$params['c']."'";
        $result = mysqli_query($connect, $query);
        $cuantos = mysqli_num_rows($result);
        if ($cuantos==1){
            $anterior= mysqli_fetch_assoc($result);
            $query = "UPDATE usuarios SET usuario_nombre = '".$params['n']."', nivel = '".$params['t']."' ".
                      "WHERE idusuarios = '".$params['c']."'";
            if (!mysqli_query($connect, $query)){
                $output = mysqli_errno($connect)." - ". mysqli_error($connect);
            } else {
                $output = 1;
                $query = "INSERT INTO bitacora ".
                         "VALUES(NULL,NOW(),".$_SESSION['idusuario'].",'C',".
                         "'".$params['c']." - ".$params['n']." - ".$params['t']."',".
                         "'".$anterior['iddepartamentos']." - ".$anterior['nombre_depto']." - ".$anterior['nivel']."')";
                $result= mysqli_query($connect, $query);
            }
        } else {
            $output = 0;
        }
        break;
    case 5:
        // MODIFICACION DE CLAVE
        $output = "";
        $query = "UPDATE usuarios SET clave = '".$params['k']."' WHERE idusuarios = ".$params['c'];
        $result = mysqli_query($connect, $query);
            if (!mysqli_query($connect, $query)){
                $output = mysqli_errno($connect)." - ". mysqli_error($connect);
            } else {
                $output = 1;
                $query = "INSERT INTO bitacora ".
                         "VALUES(NULL,NOW(),".$_SESSION['idusuario'].",'C',NULL,".
                         "'".$params['c']." - ".$params['n']." - Cambio de Clave')";
                $result= mysqli_query($connect, $query);
            }
        break;
    default:
        break;
    }
    echo $output;