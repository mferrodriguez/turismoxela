<?php
    session_start();
    $config= parse_ini_file("../config/turismo.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}
    
    $params = filter_input_array(INPUT_GET);
    
    switch ($params['a']) {
    case 0:
        // SELECCION GENERAL - PARA LLENAR EL GRID
        $query = "SELECT * FROM sitios ORDER BY idsitios";
        $result = mysqli_query($connect, $query);
        $cuantos = mysqli_num_rows($result);
        $output="";
        if ($cuantos > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $output = $output.
                        "<tr id='r".$row['idsitios']."'>".
                            "<td>".
                                "<input type='radio' id='".$row['idsitios']."' class='opcion text-center' name='seleccionar'>".
                            "</td>".
                            "<td class='text-center'>".$row['idsitios']."</td>".
                            "<td class='text-center'>".$row['nombre']."</td>".
                            "<td class='text-center nombre'>".$row['ubicacion']."</td>".
                            "<td class='text-center'>".$row['coordenadas']."</td>".
                        "</tr>";
            }
        } else {
            $output = "AUN NO EXISTEN REGISTROS INGRESADOS ... PRESIONE [NUEVO]";
        }
        break;
    case 1:
        // INSERCION DE TUPLA
        $query = "INSERT INTO sitios ".
                      "VALUES(NULL,'".$params['n']."','".$params['u']."','".$params['d']."','".$params['h']."','".$params['c']."')";
        if (!mysqli_query($connect, $query)){
            $output = mysqli_errno($connect)." - ".  mysqli_error($connect);
        } else {
            $output = 1;
            $query = "INSERT INTO bitacora VALUES(NULL,NOW(),".$_SESSION['idusuarios'].",'A',".
                     "'".$params['n']." - ".$params['u']." - ".$params['c']."',NULL)";
            $result=mysqli_query($connect, $query);
        }
        break;
    case 2:
        // MODIFICACION DE TUPLA
        $query = "SELECT * FROM sitios WHERE idsitios =".$params['i'];
        $result = mysqli_query($connect, $query);
        $cuantos = mysqli_num_rows($result);
        if ($cuantos==1){
            $anterior= mysqli_fetch_assoc($result);
            $query = "UPDATE sitios SET nombre = '".$params['n']."', ubicacion = '".$params['u']."', ".
                                       "descripcion = '".$params['d']."', historia = '".$params['h']."', ".
                                       "coordenadas = '".$params['c']."' ".
                      "WHERE idsitios = ".$params['i'];
            if (!mysqli_query($connect, $query)){
                $output = mysqli_errno($connect)." - ". mysqli_error($connect);
            } else {
                $output = 1;
                $query = "INSERT INTO bitacora ".
                         "VALUES(NULL,NOW(),".$_SESSION['idusuario'].",'C',".
                         "'".$params['i']." - ".$params['n']." - ".$params['c']."',".
                         "'".$anterior['idsitios']." - ".$anterior['nombre']." - ".$anterior['coordenadas']."')";
                $result= mysqli_query($connect, $query);
            }
        } else {
            $output = 0;
        }
        break;
    case 3:
        // SELECCION INDIVIDUAL - PARA EDICION
        $query = "SELECT * FROM sitios WHERE idsitios = ".$params['i'];
        $result = mysqli_query($connect, $query);
        $cuantos = mysqli_num_rows($result);
        $output="";
        if ($cuantos = 1){
            while ($row = mysqli_fetch_assoc($result)){
                $output = json_encode(array("id"=>$row['idsitios'], "nom"=>$row['nombre'],
                          "loc"=>$row['ubicacion'], "des"=>$row['descripcion'], "his"=>$row['historia'],
                          "coo"=>$row['coordenadas']));
            }
        } else {
            $output = "ERROR GENERAL DE DATOS";
        }
        break;
    case 4:
        // SELECCION PARA LLENADO DE OPTIONS.
        $query = "SELECT idsitios, nombre FROM sitios ORDER BY nombre";
        $result = mysqli_query($connect, $query);
        $cuantos = mysqli_num_rows($result);
        $output="";
        if ($cuantos > 0){
            while ($row = mysqli_fetch_assoc($result)){$output = $output."<option value='".$row['idsitios']."'>".$row['nombre']."</option>";}
        } else {
            $output = "ERROR GENERAL DE DATOS";
        }
        break;
    default:
        break;
    }
    echo $output;