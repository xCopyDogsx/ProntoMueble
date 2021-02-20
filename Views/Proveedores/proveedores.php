<?php 
    headerAdmin($data); 
    getModal('modalProveedores',$data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fas fa-parachute-box"></i> <?= $data['page_title'] ?>
              <?php if($_SESSION['permisosMod']['Perm_Crear']){ ?>
                <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
              <?php } ?>
              <?php if($_SESSION['permisosMod']['Perm_Elim']){ ?>
                <button class="btn btn-danger" type="button" onclick="resetear();" ><i class="fas fa-exclamation-triangle"></i> Resetear envios de los proveedores</button>
              <?php } ?>  
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/proveedores"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableProveedores">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Dirección</th>
                          <th>Email</th>
                          <th>Telefono</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    