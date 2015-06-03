<?php
    session_start();
    $config= parse_ini_file("../config/turismo.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}
    
    $params = \filter_input_array(\INPUT_GET);
    
    switch ($params['a']) {
    case 0:
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
        $query = "INSERT INTO usuarios VALUES(NULL,'".$params['c']."','".$params['n']."','".$params['t']."','".$params['k']."')";
        if (!mysqli_query($connect, $query)){
            $output = mysqli_errno($connect)." - ".  mysqli_error($connect);
        } else {
            $output = 1;
            $query = "INSERT INTO bitacora VALUES(NULL,NOW(),".$_SESSION['idusuario'].",'Mantenimiento de Departamentos','A',".
                     "'".$params['c']." - ".$params['n']."',NULL)";
            $result=\mysqli_query($connect, $query);
        }
        break;
    case 2:
        $query = "SELECT * FROM departamentos WHERE iddepartamentos='".$params['c']."'";
        $result = mysqli_query($connect, $query);
        $cuantos = mysqli_num_rows($result);
        if ($cuantos==1){
            $anterior= mysqli_fetch_assoc($result);
            $query = "UPDATE departamentos SET nombre_depto = '".$params['n']."' ".
                      "WHERE iddepartamentos = '".$params['c']."'";
            if (!mysqli_query($connect, $query)){
                $output = mysqli_errno($connect)." - ". mysqli_error($connect);

            } else {
                $output = 1;
                $query = "INSERT INTO bitacora ".
                         "VALUES(NULL,NOW(),".$_SESSION['idusuario'].",'Mantenimiento de Departamentos','C',".
                         "'".$params['c']." - ".$params['n']."',".
                         "'".$anterior['iddepartamentos']." - ".$anterior['nombre_depto']."')";
                $result= mysqli_query($connect, $query);
            }
        } else {
            $output = 0;
        }
        break;
    case 3:
        $query = "SELECT IFNULL(COUNT(*),0) AS cuantos FROM municipios WHERE iddepartamentos='".$params['c']."'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
        $output = $row['cuantos'];
        break;
    case 4:
        $query = "SELECT * FROM departamentos WHERE iddepartamentos = '".$params['c']."'";
        $anterior= mysqli_fetch_assoc($result);
        $query = "DELETE FROM departamentos WHERE iddepartamentos = '".$params['c']."'";
        if (!mysqli_query($connect, $query)){
            $output = mysqli_errno($connect)." - ". mysqli_error($connect);

        } else {
            $output = 1;
            $query = "INSERT INTO bitacora ".
                     "VALUES(NULL,NOW(),".$_SESSION['idusuario'].",'Mantenimiento de Departamentos','B',NULL".
                     "'".$anterior['iddepartamentos']." - ".$anterior['nombre_depto']."')";            
            $result= mysqli_query($connect, $query);
        }
        break;
    case 5:
        $output = "";
        $query = "SELECT iddepartamentos, nombre_depto FROM departamentos ORDER BY nombre_depto";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)){
            $output = $output ."<option value='".$row['iddepartamentos']."'>".$row['nombre_depto']."</option>";
        }
        if ($output==="") { $output = "0"; }
        break;
    default:
        break;
    }
    echo $output;