<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    session_start();
    
    if (!isset($_SESSION['ultact'])||(time()-$_SESSION['ultact'])>1800){
        $output = 0;
    } else {
        $_SESSION['ultact']=time();
        $output = json_encode(array('idu' => $_SESSION['idusuarios'], 'nom' => $_SESSION['usuario_nombre'], 'nivel' => $_SESSION['nivel']));
    }
    echo $output;