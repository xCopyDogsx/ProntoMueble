
<?php 
headerTienda($data);
?>
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?= media() ?>/tienda/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Contactanos
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form>
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Dejanos tu mensaje
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Tu email">
							<img class="how-pos4 pointer-none" src="<?= media() ?>/tienda/images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Tu opinión cuenta"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Enviar
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Dirección
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
									Calle 13 #17-54, Bogotá Colombia <br>
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Llamanos
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								12345678910
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Correo electronico
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								admin@prontomueble.store
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
	footerTienda($data);
 ?>
		