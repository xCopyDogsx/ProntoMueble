<?php headerAdmin($data); ?>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> <?=$data['page_title']?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/pedidos"> Pedidos</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">	
          	<?php 
          		$cliente = $data['arrPedido']['cliente'];
          		$orden =  $data['arrPedido']['orden'];
          		$detalle = $data['arrPedido']['detalle'];
          	?>
            <section id="sPedido" class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><img src="<?= media();?>/tienda/images/logo.png" alt="" style="width: 15%;height: 15%;"> </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Fecha de impresión: <?= date('d')."/".date('m')."/".date('y');?></h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">Desde
                  <address><strong><?= NOMBRE_EMPRESA;?></strong><br>
                  	<?= DIRECCION; ?><br>
                  	<?= TELEMPRESA; ?><br>
                  	<?= WEB_EMPRESA; ?><br>
                  	<?= EMAIL_EMPRESA; ?><br>
                  </address>
                </div>
                <div class="col-4">Para
                  <address><strong><?=$cliente['Per_Nom']." ".$cliente['Per_Ape']?></strong><br><?=$orden['Ped_Dest'];?><br>Doc: <?=$cliente['Per_Doc']?><br>Telefono: (+57)<?=$cliente['Per_Tel']?> <br>Email: <?=$cliente['Per_Email']?></address>
                </div>
                <div class="col-4"><b>Nro. de pedido: #<?=$orden['Ped_ID'];?></b>
                	<br><b>Metódo de pago: <?=$orden['Pag_Nom'];?>
                	<?php if($orden['Pag_Nom']=="PayPal"){
                			echo '<br>Referencia PayPal: '.$orden['Ped_IDPayPal'];
                			}else{
                				echo '<br><br>Referencia : '. $orden['Ped_RefCobro'];
                			} ?>
                	<br>Fecha de transacción: <?=$orden['fecha'];?><br><b>Estado:</b> 
                	<?php if($orden['Ped_Status']!="Aprobado"){
                			echo '<span class="badge badge-pill badge-danger">Sin aprobar</span>';
                			}else{
							echo '<span class="badge badge-pill badge-success">Aprobado</span>';
                			}?>
                			<p>
                			</p>
                			</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    		$subtotal = 0;
                    		if(count($detalle)>0){
                    			foreach ($detalle as $producto) {
                    				
                    		
                    	?>
                      <tr>
                        <td><?= $producto['producto']?></td>
                        <td><?= SMONEY.' '.formatMoney($producto['Det_Precio'])?></td>
                        <td><?= $producto['Det_Cant']?></td>
                        <td><?= SMONEY.' '.formatMoney($producto['Det_Precio']*$producto['Det_Cant']) ?></td>
                      <?php $subtotal=$producto['Det_Precio']*$producto['Det_Cant'];?>
                      </tr>
                      <?php 	}
                    		}
                    		?>

                    </tbody>
                    <tfoot>
                    	<tr>
                    		<th colspan="3" class="text-right">Subtotal:</th>
                    		<td class="text-right"><?= SMONEY.' '.formatMoney($subtotal)?></td>
                    	</tr>
                    	<tr>
                    		<th colspan="3" class="text-right">Envio:</th>
                    		<td class="text-right"><?= SMONEY.' '.formatMoney($orden['Ped_CostEnv'])?></td>
                    	</tr>
                    	<tr>
                    		<th colspan="3" class="text-right">Total:</th>
                    		<td class="text-right"><?= SMONEY.' '.formatMoney($orden['Ped_CostEnv']+$subtotal)?></td>
                    	</tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');"><i class="fa fa-print"></i> Imprimir</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
    <?php footerAdmin($data); ?>