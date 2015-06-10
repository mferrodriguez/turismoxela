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

function refresh_data(){$.get("../app/imagenes_pro.php?a=0",function(data){$("#tabData tbody").html(data);});}

function clear_form(){
    $("#txtIdUsuarios").val("");
    $("#txtUsusario_Cuenta").val("");
    $("#txtUsuario_Nombre").val("");
    $("#txtNomAnt").val("");
    if ($("#txtAction").val()==1){$("#txtUsuario_Cuenta").prop('disabled',false);} else {$("#txtUsuario_Cuenta").prop('disabled',true);}
}

function refresh_form(){
    clear_form();
    refresh_data();
    $("#frmData").hide(500);
    $("#tabData").show(500);
    $("#btnChgPwd").hide();
};

function fill_sitios(){
    $.get("../app/sitios_pro.php?a=4",function(data){
        $("#txtIdSitios").html(data);
    });
}
$(document).ready(function(){
    validsession(0);
    $("#frmData").hide();
    fill_sitios();
    //refresh_data();
    clear_form();
    refresh_form();
    var options = { 
            target:   '#output',   // target element(s) to be updated with server response 
            beforeSubmit:  beforeSubmit,  // pre-submit callback 
            resetForm: true        // reset the form after successful submit 
        }; 
    $('#MyUploadForm').submit(function() { 
            $(this).ajaxSubmit(options);  //Ajax Submit form            
            // return false to prevent standard browser submit and page navigation 
            return false; 
    });     
    function afterSuccess(){
        $('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
    }
    //function to check file size before uploading.
    function beforeSubmit(){
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob){
            //check empty input filed
            if( !$('#imageInput').val()) {$("#output").html("En serio? ... Archivo vacío?"); return false;}
            var fsize = $('#imageInput')[0].files[0].size; //get file size
            var ftype = $('#imageInput')[0].files[0].type; // get file type
            //allow only valid image file types 
            switch(ftype) {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg': break;
                default: $("#output").html("<b>"+ftype+"</b> Tipo de archivo NO PERMITIDO!");return false
            }
            //Allowed file size is less than 1 MB (1048576)
            if(fsize>1048576) {$("#output").html("<b>"+bytesToSize(fsize) +"</b> Archivo demasiado grande!! <br />Reduzca el tamaño de la imágen usando un software apropiado!.");return false;}
            $('#submit-btn').hide(); //hide submit button
            $('#loading-img').show(); //hide submit button
            $("#output").html("");  
        } else {
            //Output error to older browsers that do not support HTML5 File API
            $("#output").html("Por favor actualice su navegador, ya que la versión que está utilizando es incompatible!!");
            return false;
        }
    }

    //function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }    
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
        if ($("#txtIdUsuarios").val()!==""){
            $("#txtAction").val("2");
            $("#frmData").show(500);
            $("#tabData").hide(500);
            $("#txtIdDepto").prop('disabled',true);
            $("#btnChgPwd").show();
        }
    });
    $("#btnSave").click(function(){
        validsession(0);
        if ($("#txtAction").val()==1){
            if ($("#txtUsuario_Cuenta").val()!==""){
                if ($("#txtUsuario_Nombre").val()===""){
                    alert("El Nombre del Departamento NO PUEDE ESTAR VACIO!!");
                    $("#txtUsuario_Nombre").focus();
                } else {
                    if ($("#txtUsuario_Nombre").val()!==$("#txtNomAnt")){
                        $.get("../app/usuarios_pro.php?a=1&c="+$("#txtUsuario_Cuenta").val()+
                                                         "&n="+$("#txtUsuario_Nombre").val()+
                                                         "&t="+$("#txtNivel").val()+
                                                         "&k="+CryptoJS.MD5($("#txtClave").val()),
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
            } else {
                alert("El Código del Usuario NO PUEDE ESTAR VACIO!!");
                $("#txtUsuario_Cuenta").focus();
            }
        } else {
            if ($("#txtAction").val()==2){
                if ($("#txtUsuario_Nombre").val()==""){
                    alert("El Nombre del Usuario NO PUEDE ESTAR VACIO!!");
                    $("#txtUsuario_Nombre").focus();
                } else {
                    $.get("../app/usuarios_pro.php?a=2&c="+$("#txtIdUsuarios").val()+"&n="+
                            $("#txtUsuario_Nombre").val()+"&t="+$("#txtNivel").val(),function(data){
                        if (data==1){
                            refresh_form();
                            $("#tabData tfoot").html("<tr><td colspan='3' class='bg-success'>Registro modificado exitosamente ...</td></tr>");
                            window.setTimeout(function(){$("#tabData tfoot").html("");},4000);
                        } else {
                            alert("No se pudo Modificar el Dato!!\nIntente de nuevo.");
                        }
                    });
                }
            }
            refresh_form();
            window.setTimeout(function(){$("#tabData tfoot").html("");},4000);
        }
    });
    $("#btnDelete").click(function(){validsession(0);});
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
    $("#btnPwd").click(function(){
        if ($("#txtIdUsuarios")!=="") {
        $.get("../app/usuarios_pro.php?a=5&c="+$("#txtIdUsuarios").val()+"&k="+CryptoJS.MD5($("#txtNewPass").val()),
            function(data){
                if (data==1){
                    refresh_form();
                    $("#pwdModal").hide();
                    $("#tabData tfoot").html("<tr><td colspan='3' class='bg-success'>Clave modificada exitosamente ...</td></tr>");
                    window.setTimeout(function(){$("#tabData tfoot").html("");},4000);
                } else {
                    alert("No se pudo Modificar el Password!!\nIntente de nuevo.");
                }
            });
        }
    });
    $("#btnExit").click(function(){validsession(1);});
});

$(document).on('click','.opcion',function(){
    $("#txtIdUsuarios").val($(this).attr('id'));
    $("#txtUsuario_Cuenta").val($(this).closest('tr').find('td:eq(2)').text());
    $("#txtUsuario_Nombre").val($(this).closest('tr').find('td:eq(3)').text());
    $("#txtNomAnt").val($("#txtUsuario_Nombre").val());
    var tipo = $(this).closest('tr').find('td:eq(4)').text().substring(0,1);
    $("#txtTipoAnt").val(tipo);
    if (tipo=="U"){$("#txtNivel").val("U");}else{$("#txtNivel").val("A");}
});