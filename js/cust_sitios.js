/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function validsession(fullexit){
    $.getJSON("../app/session.php",function(data){
        if (data === 0){$.get("../app/logout.php",function(){document.location.replace('../index.html');});
        } else {if (fullexit===0){ $("#nombreusuario").html("Usuario Activo:  "+data.nom);} else {document.location.replace("menu.html");} }
    });
}

function refresh_data(){$.get("../app/sitios_pro.php?a=0",function(data){$("#tabData tbody").html(data);});}

function clear_form(){
    $("#txtIdSitios").val("");
    $("#txtNomAnt").val("");
    $("#txtNombre").val("");
    $("#txtUbicacion").val("");
    $("#txtDescripcion").val("");
    $("#txtHistoria").val("");
    $("#txtCoordenadas").val("");
    if ($("#txtAction").val()==1){$("#txtNombre").prop('disabled',false);} else {$("#txtNombre").prop('disabled',true);}
}

function refresh_form(){
    clear_form();
    refresh_data();
    $("#frmData").hide(500);
    $("#tabData").show(500);
};

$(document).ready(function(){
    validsession(0);
    $("#frmData").hide();
    clear_form();
    refresh_form();
    $("#tabData tfoot").html("");
    $("#btnNew").click(function(){
        validsession(0);
        $("#txtAction").val("1");
        $("#tabData tfoot").html("");
        clear_form();
        $("#frmData").show(500);
        $("#tabData").hide(500);
    });
    $("#btnEdit").click(function(){
        validsession(0);
        if ($("#txtIdSitios").val()!==""){
            $("#txtAction").val("2");
            $("#frmData").show(500);
            $("#tabData").hide(500);
        }
    });
    $("#btnSave").click(function(){
        validsession(0);
        if ($("#txtAction").val()==1){
            if ($("#txtNombre").val()!==""){
                if ($("#txtUbicacion").val()===""){
                    alert("La Ubicacion del Sitio NO PUEDE ESTAR VACIA!!");
                    $("#txtUbicacion").focus();
                } else {
                    if ($("#txtDescripcion").val()===""){
                        alert("La Descripcion del Sitio NO PUEDE ESTAR VACIA!!")
                        $("#txtDescripcion").focus();
                    } else {
                        if ($("txtHistoria").val()===""){
                            alert("Debe ingresar datos en la Historia del Sitio!!");
                            $("#txtHistoria").focus();
                        } else {
                            if ($("#txtCoordenadas").val()===""){
                                alert("Las Coordenadas del Sitio NO PUEDEN ESTAR VACIAS!!!");
                                $("#txtCoordenadas").focus();
                            } else {
                                if ($("#txtNombre").val()!==$("#txtNomAnt")){
                                    $.get("../app/sitios_pro.php?a=1"+
                                            "&n="+$("#txtNombre").val()+"&u="+$("#txtUbicacion").val()+
                                            "&d="+$("#txtDescripcion").val()+"&h="+$("#txtHistoria").val()+
                                            "&c="+$("#txtCoordenadas").val(),
                                        function(data){
                                            if (data==1){
                                                refresh_form();
                                                $("#tabData tfoot").html("<tr><td colspan='3' class='bg-success'>Registro agregado exitosamente ...</td></tr>");
                                                window.setTimeout(function(){$("#tabData tfoot").html("");},4000);
                                            } else {
                                                alert("No se pudo Agregar el Dato!!\nIntente de nuevo.");
                                            }
                                        }
                                    );
                                }
                            }
                        }
                    }
                }
            } else {
                alert("El Nombre del Sitio NO PUEDE ESTAR VACIO!!");
                $("#txtNombre").focus();
            }
        } else {
            if ($("#txtAction").val()==2){
                if ($("#txtUbicacion").val()===""){
                    alert("La Ubicacion del Sitio NO PUEDE ESTAR VACIA!!");
                    $("#txtUbicacion").focus();
                } else {
                    if ($("#txtDescripcion").val()===""){
                        alert("La Descripcion del Sitio NO PUEDE ESTAR VACIA!!")
                        $("#txtDescripcion").focus();
                    } else {
                        if ($("txtHistoria").val()===""){
                            alert("Debe ingresar datos en la Historia del Sitio!!");
                            $("#txtHistoria").focus();
                        } else {
                            if ($("#txtCoordenadas").val()===""){
                                alert("Las Coordenadas del Sitio NO PUEDEN ESTAR VACIAS!!!");
                                $("#txtCoordenadas").focus();
                            } else {
                                if ($("#txtNombre").val()!==$("#txtNomAnt")){
                                    $.get("../app/sitios_pro.php?a=2"+
                                            "&i="+$("#txtIdSitios").val()+"&n="+$("#txtNombre").val()+
                                            "&u="+$("#txtUbicacion").val()+"&d="+$("#txtDescripcion").val()+
                                            "&h="+$("#txtHistoria").val()+"&c="+$("#txtCoordenadas").val(),
                                        function(data){
                                            if (data==1){
                                                refresh_form();
                                                $("#tabData tfoot").html("<tr><td colspan='3' class='bg-success'>Registro modificado exitosamente ...</td></tr>");
                                                window.setTimeout(function(){$("#tabData tfoot").html("");},4000);
                                            } else {
                                                alert("No se pudo Modificar el Dato!!\nIntente de nuevo.");
                                            }
                                        }
                                    );
                                }
                            }
                        }
                    }
                }
            }
            refresh_form();
            window.setTimeout(function(){$("#tabData tfoot").html("");},4000);
        }
    });
    $("#btnDelete").click(function(){
        validsession(0);
        var confi = confirm("Realmente desea eliminar este registro\ny todos los registros relacionados?");
        //alert(confi);
        if (confi===true){
            $.get("../app/sitios_pro.php?a=4"+"&i="+$("#txtIdSitios").val(),
                function(data){
                    if (data==1){
                        refresh_form();
                        $("#tabData tfoot").html("<tr><td colspan='3' class='bg-success'>Registro eliminado exitosamente ...</td></tr>");
                        window.setTimeout(function(){$("#tabData tfoot").html("");},4000);
                    } else {
                        alert("No se pudo Eliminar el Dato!!\nIntente de nuevo.");
                    }
                }
            );
        }
    });
    $("#btnCancel").click(function(){validsession(0); refresh_form(); $("#tabData tfoot").html("");});
    $("#txtNewPass").focusout(function(){
        if ($("#txtNewPass").val()==""){
            alert("ERROR: Clave no puede estar vacía!!");
            $("#txtNewPass").focus();
        }
    });
    $("#txtNewPassConf").focusout(function(){
        if ($("#txtNewPassConf").val()==""){
            alert("ERROR: Clave no puede estar vacía!!");
            $("#txtNewPassConf").focus();
        } else {
            if ($("#txtNewPassConf").val()!==$("#txtNewPass").val()){
                alert("ERROR: Ambos campos de clave DEBEN SER iguales!!!");
                $("#txtNewPassConf").focus(); 
            }
        }
    });
    $("#btnMap").click(function(){
        var coord = $("#txtCoordenadas").val();
        var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="
                    +coord+"&zoom=19&size=640x640&sensor=true&maptype=satellite&markers=color:blue%7Clabel:S%7C"+coord;
        $("#Mapa").attr("src",img_url);
    });
    $("#btnExit").click(function(){validsession(1);});
});

$(document).on('click','.opcion',function(){
    $("#txtIdSitios").val($(this).attr('id'));
    $.getJSON("../app/sitios_pro.php?a=3&i="+$("#txtIdSitios").val(),
        function(data){
            if (data!==0){
                $("#txtNombre").val(data.nom);
                $("#txtUbicacion").val(data.loc);
                $("#txtDescripcion").val(data.des);
                $("#txtHistoria").val(data.his);
                $("#txtCoordenadas").val(data.coo);
                $("#txtNomAnt").val($("#txtNombre").val());
            } else {
                alert("Error General de Datos!!\nIntente de nuevo.");
            }
        }
    );}
);