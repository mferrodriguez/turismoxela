<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Sistema de Promoci&oacute;n Tur&iacute;stica Quetzaltenango</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">
    </head>
    <body class="container" style="padding: 30px;">
        <div class="container col-lg-10" style="width: 100%;">
            <header class="pagehead">
                <span class="h2 resaltadon">Sistema de Promoci&oacute;n Tur&iacute;stica de Quetzaltenango</span><br>
                <span class="h3 resaltadon">Formulario de Gesti&oacute;n de Usuarios</span><br>
                <p class="text-right uid"><span class="resaltadon" id="nombreusuario">Usuario activo:&nbsp;&nbsp;</span></p>
            </header
        </div>
        <div class="container col-lg-10 jumbotron" style="width: 100%; padding: 15px 15px 15px 15px !important;">
            <div class="btn-group-sm" style="text-align: center;">
                <span class="resaltadon">Opciones disponibles:</span>
                <button type="button" class="btn btn-default btn-primary" id="btnNew"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo</button>
                <button type="button" class="btn btn-default btn-primary" id="btnSave"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Grabar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnEdit"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Editar</button>
                <!--<button type="button" class="btn btn-default btn-primary" id="btnChgPwd" data-toggle="modal" data-target="#pwdModal"/><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;&nbsp;Cambiar Clave</button>-->
                <a href="#" class="btn btn-default btn-primary" id="btnChgPwd" data-toggle="modal" data-target="#pwdModal"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;&nbsp;Cambiar Clave</a>
                <button type="button" class="btn btn-default btn-primary" id="btnDelete"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Eliminar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnCancel"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp;Cancelar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnExit"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;Volver</button>
            </div><br>
            <form id="frmData">
                <div style="font-size: 11pt; text-shadow: 1px 1px #e5e5e5; font-weight: bold; text-align: center; width:100%;background-color: #555; color:white;">
                    Ingrese los datos que se solicitan a continuaci&oacute;n:
                </div>
                <input type="hidden" id="txtAction"/>
                <input type="hidden" id="txtIdUsuarios"/>
                <input type="hidden" id="txtNomAnt"/>
                <div class="form-group">
                    <label for="txtUsuario_Cuenta">Cuenta de Acceso al Sistema:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="txtUsuario_Cuenta" placeholder="Ingrese Nombre de Cuenta (8 caracteres m&iacute;nimo, ej: jlopez, pdeleon, etc.)"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario_Nombre">Nombre Completo del Usuario:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="txtUsuario_Nombre" placeholder="Ingrese Nombre Completo del Usuario (ej: Pedro P&eacute;rez, etc."/>
                </div>
                <div class="form-group">
                    <label for="txtClave">Password (Clave) del Usuario:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="txtClave" placeholder="Ingrese Password para la cuenta."/>
                </div>
                <div class="form-group">
                    <label for="txtNivel">Nivel de Acceso del Usuario:&nbsp;&nbsp;</label>
                    <select class="form-control" id="txtNivel">
                        <option value="U">Usuario Normal</option>
                        <option value="A">Administrador del Sistema</option>
                    </select>
                </div>
            </form>
            <div id="divData">
                <table id="tabData" class="table table-hover table-bordered">
                    <thead>
                        <tr class="success resaltadon">
                            <td style="width: 5%;" class="text-center"></td>
                            <td style="width: 10%;" class="text-center">ID</td>
                            <td style="width: 10%;" class="text-center">Cuenta</td>
                            <td style="width: 50%;" class="text-justify">Nombre del Usuario</td>
                            <td style="width: 15%;" class="text-justify">Nivel de Acceso</td>
                            <!--<td style="width: 10%;">Acciones Disponibles</td>-->
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
        <div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="txtNewPass">Password (Clave) del Usuario:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="txtNewPass" placeholder="Ingrese el NUEVO Password para la cuenta."/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->        
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/cust_usuarios.js"></script>
        <script src="../js/crypt/md5.js"></script>
    </body>
</html>
