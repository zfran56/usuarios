<?php
    require("config/config.php");
    require("config/usuarios_config.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        require("head.php");
    ?>
    <script src="class/admin.usuarios.js"></script>

  </head>
  <body>

    <?php
        require("topbar.php");
    ?>

    <div class="container-fluid">
      <div class="row">
        <?php
            require("menu.php");
        ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Aplicativo para mantenimiento de Usuarios</h1>

          <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;Administraci&oacute;n de Datos</div>
            <div class="panel-body">
                <form class="form-horizontal">
                <!--<div class="form-group">
                  <label for="Username" class="col-sm-1 control-label">Usuario</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Username">
                  </div>
                  <label for="Correo" class="col-sm-1 control-label">Correo</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Correo">
                  </div>
                </div>-->
                <div class="form-group">
                      <h5><label class="col-md-5">Criterio de busqueda por nombre, apellido o usuario:</label></h5>
                      <div class="col-md-5">
                          <div class="input-group input-group-sm">
                              <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-search"></i>
                              </span>
                              <input type="text" class="form-control" id="criterio" name="criterio" placeholder="Criterio de Busqueda">
                          </div>
                      </div>
                      <div class="col-sm-2">
                          <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm">Buscar <i class="glyphicon glyphicon-search"></i> </button>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="table-responsive">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <td colspan="6" align="right">
                                              <button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-success btn-sm">Agregar Nuevo </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <th width="3%"><b>#</b></th>
                                          <th width="35%"><b>Nombre Completo</b></th>
                                          <th><b>Usuario</b></th>
                                          <th><b>Nivel</b></th>
                                          <th><center><b>Estado</b></center></th>
                                          <th><center><b>Acciones</b></center></th>
                                      </tr>
                                  </thead>
                                  <tbody id="miTabla">

                                  </tbody>
                              </table>
                              <div class="col-md-12 text-right">
                					<ul class="pagination" id="paginador"></ul>
                				</div>
                      </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
        <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Informaci&oacute;n del Usuario</b></h4>
            </div>
            <form id="formulario" role="form" class="form-horizontal form-groups-bordered">
            <div class="modal-body">

                    <div class="form-group">
                      <label for="field-1" class="col-sm-2 control-label">Usuario:</label>
                      <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                              </span>
                              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                          </div>
                      </div>
                      <div class="col-sm-1"></div>
                  </div>

                  <div class="form-group">
                      <label for="field-1" class="col-sm-2 control-label">Nombre:</label>
                      <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                              </span>
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Usuario">
                          </div>
                      </div>
                      <div class="col-sm-1"></div>
                  </div>

                  <div class="form-group">
                      <label for="field-1" class="col-sm-2 control-label">Apellido:</label>
                      <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                              </span>
                              <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido del Usuario">
                          </div>
                      </div>
                      <div class="col-sm-1"></div>
                  </div>

                  <div class="form-group">
                      <label for="field-1" class="col-sm-2 control-label">Contrase&ntilde;a:</label>
                      <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                              </span>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                          </div>
                      </div>
                      <div class="col-sm-1"></div>
                  </div>

                  <div class="form-group">
                      <label for="field-1" class="col-sm-2 control-label">Confirmar:</label>
                      <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                              </span>
                              <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Confirmar Password">
                          </div>
                      </div>
                      <div class="col-sm-1"></div>
                  </div>

                  <div class="form-group" id="cambiarPassword" style="display: none;">
                      <div class="col-md-11" style="text-align: right;">
                                Cambiar Password: <input type="checkbox" id="chkCambiar" name="chkCambiar" value="1">
                      </div>
                      <div class="col-sm-1"></div>
                  </div>
                  <input type="hidden" name="id_nivel" id="id_nivel" value="1">

            </div>

            <div class="modal-footer">
            	<input type="submit" value="Guardar" class="btn btn-success" id="btnAgregar"/>
                <button type="button" class="btn btn-black" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Fin Modal Registros -->

      <!-- Modal Confirmacion -->
      <div aria-hidden="true" style="display: none;" class="modal fade" id="frmConfirmar" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Esta a punto de eliminar este registro!</h4>
                    </div>
                    <div class="modal-body">
                            Al eliminar los datos, estos no podr&aacute;n ser recuperados. &iquest; Est&aacute; seguro de hacer este procedimiento?
                            <input type="hidden" name="id_registro" id="id_registro" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal" id="btnConfirmar">Si Estoy Seguro</button>
                        <button type="button" class="btn btn-black" data-dismiss="modal">Cancelar Operaci&oacute;n</button>
                    </div>
                </div>
            </div>
      </div>

      <!-- Fin Modal Confirmacion -->

    <?php
        require("scripts.php");
    ?>
  </body>
</html>
