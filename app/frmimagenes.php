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
                <span class="h3 resaltadon">Formulario de Gesti&oacute;n de Im&aacute;genes</span><br>
                <p class="text-right uid"><span class="resaltadon" id="nombreusuario">Usuario activo:&nbsp;&nbsp;</span></p>
            </header
        </div>
        <div class="container col-lg-10 jumbotron" style="width: 100%; padding: 15px 15px 15px 15px !important;">
            <div class="btn-group-sm" style="text-align: center;">
                <span class="resaltadon">Opciones disponibles:</span>
                <button type="button" class="btn btn-default btn-primary" id="btnNew"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo</button>
                <button type="button" class="btn btn-default btn-primary" id="btnSave"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Grabar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnEdit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;Editar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnDelete"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>&nbsp;&nbsp;Eliminar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnCancel"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp;Cancelar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnExit"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;Volver</button>
            </div><br>
            <form id="frmData">
                <div class="form-group">
                    <div style="font-size: 11pt; text-shadow: 1px 1px #e5e5e5; font-weight: bold; text-align: center; width:100%;background-color: #555; color:white;">
                        Ingrese los datos que se solicitan a continuaci&oacute;n:
                    </div>
                    <input type="hidden" id="txtAction"/>
                    <input type="hidden" id="txtIdFotografias"/>
                    <div class="form-group">
                        <label for="txtIdSitios">Sitio al que pertenece la Im&aacute;gen:&nbsp;&nbsp;</label>
                        <select class="form-control" id="txtIdSitios">
                        </select>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="txtPath">Nombre del Archivo en el Servidor:&nbsp;&nbsp;</label>
                            <input type="text" class="form-control" id="txtPath" placeholder="Ruta de Acceso del Archivo."/>
                            <button type="button" class="btn btn-default btn-primary" id="btnFile" data-toggle="modal" data-target="#divFile">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;Subir Archivo al Servidor
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripci&oacute;n del Archivo:&nbsp;&nbsp;</label>
                        <input type="text" class="form-control" id="txtDescripcion" placeholder="Ingrese una breve Descripci&oacute;n de la Im&aacute;gen"/>
                    </div>
                </div>
            </form>
            <div id="divData">
                <table id="tabData" class="table table-hover table-bordered">
                    <thead>
                        <tr class="success resaltadon">
                            <td style="width: 5%;" class="text-center"></td>
                            <td style="width: 10%;" class="text-center">ID</td>
                            <td style="width: 10%;" class="text-center">ID Sitio</td>
                            <td style="width: 20%;" class="text-center">Nombre Archivo</td>
                            <td style="width: 50%;" class="text-justify">Descripci&oacute;n</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
        <div class="modal fade" id="divFile" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header label-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Subir una Im&aacute;gen</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
                        <input name="image_file" id="imageInput" type="file" /><br>
                        <input type="submit"  id="submit-btn" value="Subir" class="btn btn-default" />
                        <img src="../images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Por Favor espere ..."/>
                    </form>
                    <div id="output"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->        
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/cust_imagenes.js"></script>
        <script src="../js/crypt/md5.js"></script>
        <script type="text/javascript" src="../js/jquery.form.js"></script>
    </body>
</html>
