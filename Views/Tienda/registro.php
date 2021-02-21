<?php 
headerTienda($data);
?>
 
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?= base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Inicio
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			
		</div>
	</div>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
					<div>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item ">
						    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="profile" aria-selected="true">Crear cuenta</a>
						  </li>
						</ul>
					</div>
						  <div class="tab-pane active" id="registro" role="tabpanel" aria-labelledby="profile-tab">
						  	<br>
						  	<form id="formRegister"> 
						 		<div class="row">
									<div class="col col-md-6 form-group">
										<label for="txtNombre">Nombres</label>
										<input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
									</div>
									<div class="col col-md-6 form-group">
										<label for="txtApellido">Apellidos</label>
										<input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
									</div>
						 		</div>
						 		<div class="row">
						 				
						 		</div>
						 		<div class="row">
						 			<div class="col col-md-6 form-group">
										<label for="txtDoc">Documento de identidad</label>
										<input type="text" class="form-control valid validNumber" id="txtDoc" name="txtDoc" required="">
									</div>
									<div class="col col-md-6 form-group">
										<label for="txtTelefono">Teléfono</label>
										<input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
									</div>
									<div class="col col-md-6 form-group">
										<label for="txtEmailCliente">Email</label>
										<input type="email" class="form-control valid validEmail" id="txtEmailCliente" name="txtEmailCliente" required="">
									</div>
						 		</div>
								<button type="submit" class="btn btn-primary">Regístrate</button>
						 	</form>
						  </div>
		

	
					</div>
				</div>
			</div>

			
		</div>


<?php 
	footerTienda($data);
 ?>
	