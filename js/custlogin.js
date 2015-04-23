/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    $("#loginform").hide();
    $("#btnEnter").click(function(){
        $("#loginform").toggle('slow');
    });
    $("#btnLogin").click(function(){
        var uname = $("#uname").val();
        var pwd = $("#key").val();
        //var ulargo = uname.length;
        //var plargo = pwd.length;
        if (uname.length < 5){
            alert("Nombre de Usuario no puede estar en blanco, o ser menor a CINCO caracteres!!");
        } else {
            if (pwd.length < 5||pwd===null){
                alert("Clave no puede estar en blanco, o ser menor a CINCO caracteres!!");
            } else {
                //alert ("Kitoy");
                //alert(pass);
                $.getJSON("app/login.php?lu="+uname+"&lk="+CryptoJS.MD5(pwd),function(data){
                    if (data===0){
                        alert("Combinación Usuario/Contraseña no es válida!!\nVerifique!!!");
                    } else {
                        alert(data.idu+"\n"+data.nom+"\n"+data.tip)
                        document.location.replace('main.html');
                        $("#uid").val('Usuario Activo:'+data.nom);
                    }
                });
            }
        }
    });
});

