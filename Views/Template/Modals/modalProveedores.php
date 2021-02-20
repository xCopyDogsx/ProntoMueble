<!-- Modal -->
<div class="modal fade" id="modalFormProveedores" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formProveedores" name="formProveedores" class="form-horizontal">
              <input type="hidden" id="idProveedor" name="idProveedor" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md">
                    <div class="form-group">
                      <label class="control-label">Nombre del proveedor<span class="required">*</span></label>
                      <input class="form-control" id="txtNombre" name="txtNombre" type="text" required="">
                      <label class="control-label">Dirección principal del proveedor</label>
                      <input class="form-control" id="txtDireccion" name="txtDireccion" ></textarea>
                        <label class="control-label">Telefono fijo <span class="required">*</span></label>
                        <input class="form-control" id="txtFijo" name="txtFijo" type="text" placeholder="Telefono fijo" required="">
                      <label class="control-label">Telefono celular <span class="required">*</span></label>
                      <input class="form-control" id="txtCelular" name="txtCelular" type="text" required="">
                      <label class="control-label">Persona de contacto <span class="required">*</span></label>
                      <input class="form-control" id="txtContacto" name="txtContacto" type="text" required="">
                        <label class="control-label">Email <span class="required">*</span></label>
                      <input class="form-control" id="txtEmail" name="txtEmail" type="text" required="">
                      <label for="listStatus">Estado <span class="required">*</span></label>
                            <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                              <option value="1">Activo</option>
                              <option value="2">Inactivo</option>
                            </select>
                            </br>
                            </br>
                           <button id="btnActionForm" class="btn btn-primary btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                           <button class="btn btn-danger  btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                     </div>
                    </div>
                </div>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewProveedor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Nombre:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Telefono fijo:</td>
              <td id="celFijo"></td>
            </tr>
            <tr>
              <td>Celular:</td>
              <td id="celCel"></td>
            </tr>
            <tr>
              <td>Dirección de oficina:</td>
              <td id="celOficina"></td>
            </tr>
            <tr>
              <td>Persona que responde:</td>
              <td id="celContacto"></td>
            </tr>
            <tr>
              <td>Status:</td>
              <td id="celStatus"></td>
            </tr>
            <tr>
              <td>Email:</td>
              <td id="celEmail"></td>
            </tr>
            <tr>
              <td>Categoria de producto ofrecida:</td>
              <td id="celCat">
              </td>
            </tr>
             <tr>
              <td>Cantidad de envios realizados mensualmente:</td>
              <td id="celCant">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalEnvio" tabindex="-1" role="dialog" aria-labelledby="modalEnvio" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="exampleModalLabel">Insertar envio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form id="formEnvio" name="formEnvio">
  <div class="form-group">
    <input type="hidden" class="form-control" id="txtIdpro" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Ingrese la cantidad del envio <span class="required">*</span></label>
    <input type="number" class="form-control" id="txtCantidadx" required="">
  </div>
  <div class="form-group">
  <label for="listCategoria">Categoría en la que se especializa (Ingrese el ID) <span class="required">*</span></label>
  <input type="number" class="form-control" id="xdCategoria" name="xdCategoria" required="">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cerrar</button>
        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Enviar</button>
      </div>
    </form>
    </div>
  </div>
</div>
