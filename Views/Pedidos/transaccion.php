<?php headerAdmin($data); ?>
<div id="divModal">
  
</div>
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
              $trs = $data['objTransaccion']->purchase_units[0];
              $cl = $data['objTransaccion']->payer;
              $idTransaccion = $trs->payments->captures[0]->id;
              $fecha = $trs->payments->captures[0]->create_time;
              $estado = $trs->payments->captures[0]->status;
              $monto = $trs->payments->captures[0]->amount->value;
              $moneda = $trs->payments->captures[0]->amount->currency_code;
              //Datos del cliente
              $nombreCliente = $cl->name->given_name.' '.$cl->name->surname;
              $emailCliente = $cl->email_address;
              $telCliente = isset($cl->phone)?$cl->phone->phone_number->national_number:"";
              $codCiudad = $cl->address->country_code;
              //Dirección
              $direccion1 = $trs->shipping->address->address_line_1;
              $direccion2 = $trs->shipping->address->admin_area_2;
              $direccion3 = $trs->shipping->address->admin_area_1;
              $codigoPostal = $trs->shipping->address->postal_code;
              $codigoPais = $trs->shipping->address->country_code;
              //Pagado a 
              $emailP = $trs->payee->email_address;
              //Pedido
              $descripcion=$trs->description;
              $montoDetalle=$trs->amount->value;
              $totalcompra=$trs->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
              $comision=$trs->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value;
              $importe=$trs->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
              //Reembolsos
              $reembolso=false;
              if(isset($trs->payments->refunds)){
                $reembolso=true;
                $bruto=$trs->payments->refunds[0]->seller_payable_breakdown->gross_amount->value;
                $comision2=$trs->payments->refunds[0]->seller_payable_breakdown->paypal_fee->value;
                $importe2=$trs->payments->refunds[0]->seller_payable_breakdown->net_amount->value;
                $reembolsoF=$trs->payments->refunds[0]->update_time;
              }
          	?>
            <section id="sPedido" class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><img src="<?= media();?>/images/img-paypal.jpg" alt="" style="width: 15%;height: 15%;"> </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Fecha de impresión: <?= date('d')."/".date('m')."/".date('y');?></h5>
                  <div class="text-right">
                   <?php if(!$reembolso){
                      if($_SESSION['permisosMod']['Perm_Act']&&$_SESSION['userData']['Rol_Nom']!="Cliente"){
                    ?>
                  <button class="btn btn-outline-primary" onClick="fntTransaccion('<?=$idTransaccion?>');"><i class="fa fa-reply-all" aria-hidden="true"></i> Reembolsar</button>
                  <?php }
                    } ?>
                </div>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">
                  <address><strong>Transacción:</strong><br><br>
                  <address><strong>ID. de la transacción: <?= $idTransaccion;?></strong><br>
                  	<strong>Fecha: <?= $fecha;?></strong><br>
                    <strong>Estado: <?=$estado;?></strong><br>
                    <strong>Total: <?= $monto;?></strong><br>
                    <strong>Moneda usada: <?= $moneda;?></strong><br>
                  </address>
                </div>
                <div class="col-4">
                  <address><strong>Enviado por:</strong><br><br>
                    <strong>Nombre: </strong><?= $nombreCliente;?><br>
                    <strong>Email cliente: </strong><?= $emailCliente;?><br>
                    <strong>Telefono cliente: </strong><?= $telCliente;?><br>
                    <strong>Dirección cliente: </strong><?= $direccion1;?><br>
                    <?= $direccion2.', '.$direccion3.' '.$codigoPostal;?><br>
                  </address>
                </div>
                <div class="col-4">
                  <address><strong>Enviado a:</strong><br><br>
                    <strong>Email: </strong><?= $emailP;?><br>
                  </address>
                			</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  
                  <?php if($reembolso){?>
                  <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                           <th>Movimientos</th>
                           <th class="text-right">Importe bruto</th>
                           <th class="text-right">Comisión</th>
                           <th class="text-right">Importe neto</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if($_SESSION['userData']['Rol_Nom']=="Cliente"){?>
                      <tr>
                        <td><?= $reembolsoF.' Reembolso para '.$nombreCliente?></td>
                        <td class="text-right">- <?= $bruto.' '.$moneda;?></td>
                        <td class="text-right">0.00 </td>
                        <td class="text-right">- <?= $bruto.' '.$moneda;?></td>
                      </tr>
                        <?php }else{?>
                      <tr>
                        <td> <?= $reembolsoF;?> Cancelación de la comisión de PayPal</td>
                        <td class="text-right"> <?= $comision2.' '.$moneda;?></td>
                        <td class="text-right">0.0 <?= $moneda;?></td>
                        <td class="text-right">  <?= $comision2.' '.$moneda;?></td>
                      </tr>
                     <?php } ?>
                    </tbody>
                  </table>
                  <?php } ?>
                  <table class="table table-sm">
                    <thead class="thead-light">
                      <tr>
                        <th>Detalle pedido</th>
                        <th class="text-right">Cantidad</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<td><?= $descripcion;?></td>
                      <td class="text-right">1</td>
                      <td class="text-right"><?= $monto.' '.$moneda;?></td>
                      <td class="text-right"><?= $monto.' '.$moneda;?></td>
                    </tbody>
                    <tfoot>
                    	<tr>
                       <th colspan="3" class="text-right">Total</th>
                       <td class="text-right"><?= $monto.' '.$moneda;?></td> 
                      </tr>
                    </tfoot>
                  </table>
                  <?php if($_SESSION['userData']['Rol_Nom']!="Cliente"){?>
                  <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                          <th colspan="2">Detalles del pago</th>
                        </tr>

                    </thead>
                      <tbody>
                        <tr>
                        <td width="250"><strong>Total de la compra</strong></td>
                        <td><?= $totalcompra.' '.$moneda;?></td>
                        </tr>
                        <tr>
                        <td><strong>Comision de paypal</strong></td>
                        <td>- <?= $comision.' '.$moneda;?></td>
                        </tr>
                        <tr>
                        <td><strong>Importe neto</strong></td>
                        <td>- <?= $importe.' '.$moneda;?></td>
                        </tr>
                      </tbody>
                  </table>
                   <?php } ?>
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