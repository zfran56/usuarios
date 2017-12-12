<?php
    require("config/config.php");
    require("config/usuarios_config.php");
    $id_nivel = "";
    $cmbTipoUsuario = cmbTipoUsuario($id_nivel,"id_nivel","","class='form-control'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
        require("panel.head.php");
    ?>
    <script src="class/admin.usuarios.js"></script>
</head>
<body class="page-body" data-url="<?php echo sitioWebCliente(); ?>">

<div class="page-container">

	<?php
        require("sidebar.php");
    ?>

	<div class="main-content">
        <?php
            require("breadcrumb.php");
        ?>


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
        <!-- Inicio Contenido -->
		<div class="row">
			<div class="col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="entypo-users"></i>
        				    <span class="title">Administraci&oacute;n de Usuarios</span>
						</div>
					</div>

					<div class="panel-body">
                            <form role="form" onsubmit="return false;" class="form-horizontal form-groups-bordered">
							<div class="form-group">
                                <label for="field-1" class="col-sm-4 control-label">Criterio de busqueda por nombre, apellido o usuario:</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                                <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="criterio" name="criterio" placeholder="Criterio de Busqueda">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-green btn-icon">Buscar <i class="entypo-check"></i> </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 table-responsive">

                                        <table class="table table-bordered responsive table-condensed">
                                            <thead>
                                                <tr>
                                                    <td colspan="6" align="right">
                                                        <button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-blue btn-icon">Agregar Nuevo <i class="entypo-user-add"></i> </button>
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
        <!-- Fin Contenido -->
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
                                      <i class="entypo-user"></i>
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
                                      <i class="entypo-info"></i>
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
                                      <i class="entypo-info"></i>
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
                                      <i class="entypo-key"></i>
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
                                      <i class="entypo-key"></i>
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

                  <div class="form-group">
                      <label for="field-1" class="col-sm-2 control-label">Rol:</label>
                      <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">
                                      <i class="entypo-user"></i>
                              </span>
                              <?php
                                    echo $cmbTipoUsuario;
                              ?>
                          </div>
                      </div>
                      <div class="col-sm-1"><div id="resultados">&nbsp;</div></div>
                  </div>

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


        <?php
            require("pie.php");
        ?>
	</div>
</div>
	<?php
        require("scriptsbottom.php");
    ?>
</body>
</html>