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
                <span class="h3 resaltadon">Formulario de Gesti&oacute;n de Sitios Tur&iacute;sticos</span><br>
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
                <div style="font-size: 11pt; text-shadow: 1px 1px #e5e5e5; font-weight: bold; text-align: center; width:100%;background-color: #555; color:white;">
                    Ingrese los datos que se solicitan a continuaci&oacute;n:
                </div>
                <input type="hidden" id="txtAction"/>
                <input type="hidden" id="txtIdSitios"/>
                <input type="hidden" id="txtNomAnt"/>
                <div class="form-group">
                    <label for="txtNombre">Nombre del Sitio:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese Nombre del Sitio (ej: Iglesia Catedral, etc."/>
                </div>
                <div class="form-group">
                    <label for="txtUbicacion">Ubicaci&oacute;n del Sitio:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="txtUbicacion" placeholder="Ingrese Ubicaci&oacute;n del Sitio (ej: Centro Hist&oacute;rico, etc."/>
                </div>
                <div class="form-group">
                    <label for="txtDescripcion">Descripci&oacute;n del Sitio:&nbsp;&nbsp;</label>
                    <input type="textarea" class="form-control" rows="3" id="txtDescripcion" placeholder="Ingrese la Descripci&oacute;n Completa del Sitio."/>
                </div>
                <div class="form-group">
                    <label for="txtHistoria">Historia del Sitio:&nbsp;&nbsp;</label>
                    <input type="textarea" class="form-control" rows="4" id="txtHistoria" placeholder="Ingrese la Descripci&oacute;n Hist&oacute;rica del Sitio."/>
                </div>
                <div class="form-inline">
                    <label for="txtCoordenadas">Coordenadas del Sitio:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="txtCoordenadas" placeholder="Ingrese las Coordenadas del Sitio: Latitud, Longitud."/>
                    <button type="button" class="btn btn-default btn-primary" id="btnMap" data-toggle="modal" data-target="#divMap">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;Mostrar Ubicaci&oacute;n en Mapa
                    </button>
                </div>
<!--                <div class="container" style="padding:10px;" id="divMap">
                </div>-->
            </form>
            <div id="divData">
                <table id="tabData" class="table table-hover table-bordered">
                    <thead>
                        <tr class="success resaltadon">
                            <td style="width: 3%;" class="text-center"></td>
                            <td style="width: 5%;" class="text-center">ID</td>
                            <td style="width: 25%;" class="text-center">Nombre del Sitio</td>
                            <td style="width: 25%;" class="text-center">Ubicaci&oacute;n</td>
                            <td style="width: 15%;" class="text-center">Coordenadas</td>
                            <!--<td style="width: 10%;">Acciones Disponibles</td>-->
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
        <div class="modal fade" id="divMap" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding: 2px;margin-top: 5px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubicaci&oacute;n en Mapa</h4>
              </div>
              <div class="modal-body">
                  <img id="Mapa" src="" class="img-responsive">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->        
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/cust_sitios.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    </body>
</html>
