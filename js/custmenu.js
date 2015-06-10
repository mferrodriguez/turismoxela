/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*Opciones para main.php*/
var uid = 0;
var nom = "";
var tip = "";
var ultact = 0;
var status = false;

function validsession(){
    $.getJSON("session.php",function(data){
        if (data === 0){
            $.get("logout.php",function(data){document.location.replace('/index.html');});
        } else {
            uid = data.uid;
            nom = data.nom;
            tip = data.tip;
            ultact = data.ultact;
            status = Boolean(true);
        }
    });
}

$(document).ready(function(){
    $.getJSON("session.php",function(data){
        if (data === 0){
            $.get("logout.php",function(data){document.location.replace('/index.html');});
        } else {
            uid = data.uid;
            nom = data.nom;
            tip = data.tip;
            ultact = data.ultact;
            //alert (nom);
            $("#nombreusuario").html("Usuario Activo:  "+nom);
            if (tip==="U"){
                $("#btnQryBita").remove();
            }
        }
    });
    $("#smnuGenerales").toggle();
    $("#btnGenerales").click(function(){$("#smnuGenerales").toggle("slow");});
    $("#optUsuarios").click(function(){document.location.replace('frmusuarios.php');});
    $("#optSitios").click(function(){document.location.replace('frmsitios.php');});
    $("#optImagenes").click(function(){document.location.replace('frmimagenes.php')});
    $("#btnQuit").click(function(){$.get("logout.php",function(data){document.location.replace('../index.html');});});    
});