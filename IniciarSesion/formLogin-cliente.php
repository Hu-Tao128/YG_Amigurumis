<body>
	<div class="login-head" >
		<p class="titulo-carrito">Inicia sesi&oacute;n</p>
		<p class="subtitulo-carrito">Para continuar, inicia sesi&oacute;n en YG</p>
	</div>
	<form name="formLogin" id="formLogin" action="IniciarSesion/loginProcess-cliente.php" method="POST">
		<input type="hidden" name="accion" id="accion" value="login" />
		<div class="tab">
			<div class="tab-form" >
				<div class="form-field">
					<input class="form-input" type="text" name="txtNombreUsuario" id="txtNombreUsuario" required />
					<label class="form-label" >Usuario</label>
				</div>
				<div class="form-relink" >
					<label>¿No tienes cuenta?</label>
					<a class="f-r-link" href="<?=ROOTURL?>?accion=formUsuario" name="btnRegistrar-Link" id="btnRegistrar-Link">Reg&iacute;strate en YG</a>
				</div>
			</div>
			<div class="f-l-btns" >
				<div class="cta-btn" >
					<button type="button" class="c-btn" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
				</div>
			</div>
		</div>

		<div class="tab">
			<div class="tab-form" >
				<div class="form-field">
					<input class="form-input" type="password" name="txtContrasena" id="txtContrasena" required />
					<label class="form-label" >Contrase&ntilde;a</label>
				</div>
				<label class="form-relink-02" >
					<input class="f-r-checkbox" type="checkbox" onclick="showPassword()" >
					<p>Mostrar contrase&ntilde;a</p>
					<script>
						function showPassword(){
							var passW = document.getElementById("txtContrasena");

							if(passW.type === "password"){
								passW.type = "text";
							}else{
								passW.type = "password";
							}
						}
					</script>
				</label>
			</div>
			<div class="f-l-btns" >
				<div class="cta-btn" >
					<button type="button" class="c-c-btn" id="prevBtn" onclick="nextPrev(-1)">Regresar</button>
					<input type="submit" class="c-btn" name="btnLogin" id="btnLogin" value="Iniciar sesi&oacute;n" />
				</div>
			</div>
		</div>
		<div>
			<span class="step"></span>
			<span class="step"></span>
		</div>
	</form>
</body>	

	<script>
		var currentTab = 0;
		showTab(currentTab);

		function showTab(n) {
			var x = document.getElementsByClassName("tab");
			x[n].style.display = "block";
			
			if (n == 0) {
				document.getElementById("prevBtn").style.display = "none";
			} else {
					document.getElementById("prevBtn").style.display = "inline";
				}
				if (n == (x.length - 1)) {
					document.getElementById("nextBtn").innerHTML = "Submit";
				} else {
						document.getElementById("nextBtn").innerHTML = "Siguiente";
				}  
			fixStepIndicator(n)
		}

		function nextPrev(n) {
			var x = document.getElementsByClassName("tab");
			if (n == 1 && !validateForm()) return false;
			x[currentTab].style.display = "none";
			currentTab = currentTab + n;
			if (currentTab >= x.length) {
				document.getElementById("formLogin").submit();
				return false;
			}
			showTab(currentTab);
		}

		function validateForm() {
			var x, y, i, valid = true;
			x = document.getElementsByClassName("tab");
			y = x[currentTab].getElementsByTagName("input");
			for (i = 0; i < y.length; i++) {
				if (y[i].value == "") {
					y[i].className += " invalid";
					valid = false;
				}
			}
			if (valid) {
				document.getElementsByClassName("step")[currentTab].className += " finish";
			}
			return valid;
		}

		function fixStepIndicator(n) {
			var i, x = document.getElementsByClassName("step");
			for (i = 0; i < x.length; i++) {
				x[i].className = x[i].className.replace(" active", "");
			}
			x[n].className += " active";
		}
	</script>