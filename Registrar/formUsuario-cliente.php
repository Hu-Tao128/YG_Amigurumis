<form name="frmUsuario" id="frmUsuario" action="Registrar/addUsuarios-cliente.php" method="POST" >
	<div class="tab tab-registrar">
		<div class="login-head" >
			<p class="titulo-carrito">Crea una cuenta de YG</p>
			<p class="subtitulo-carrito">Introduce tus datos.</p>
		</div>
		<div class="tab-form-registrar" >
			<div class="input-registrar">
				<label class="form-label-registrar" >Nombre</label>
				<input class="form-input-registrar" type="text" name="txtNombre" id="txtNombre" required />
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Apellido Paterno</label>
				<input class="form-input-registrar" type="text" name="txtAPaterno" id="txtAPaterno" required />
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Apellido Materno</label>
				<input class="form-input-registrar" type="text" name="txtAMaterno" id="txtAMaterno" required/>
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Telefono</label>
				<input class="form-input-registrar" type="text" pattern="[0-9]{10}" name="txtTelefono" id="txtTelefono" maxlength="10"/>
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Correo</label>
				<input class="form-input-registrar" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="txtCorreo" id="txtCorreo" />
			</div>

			<input type="reset" id="btnReset" value="Borrar">
			<div class="form-relink" >
				<label>¿Tienes una cuenta?</label>
				<a class="f-r-link" href="<?=ROOTURL?>?accion=formLogin" name="btnRegistrar-Link" id="btnRegistrar-Link">Inicia sesi&oacute;n</a>
			</div>
		</div>

		<div class="f-l-btns" >
			<div class="cta-btn" >
				<button type="button" class="c-btn" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
			</div>
		</div>
	</div>

	<div class="tab tab-registrar">
		<div class="login-head" >
			<p class="titulo-carrito">Crea tu usuario</p>
			<p class="subtitulo-carrito">Crea tu nombre de usuario y contrase&ntilde;a.</p>
		</div>
		<div class="tab-form-registrar" >
			<div class="input-registrar">
				<label class="form-label-registrar" >Usuario</label>
				<input class="form-input-registrar" type="text" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="txtNombreUsuario" id="txtNombreUsuario" required aria-invalid="Este usuario ya existe. Prueba con otro" autocomplete="off" />
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Contrase&ntilde;a</label>
				<input class="form-input-registrar" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="txtContrasena" id="txtContrasena" minlength="8" title="Utiliza ocho caracteres como mínimo con una combinación de letras, números y símbolos" required autocomplete="off"/>
			</div>
		</div>
		<label class="form-relink-02 f-r-registrar" >
			<input class="f-r-checkbox" type="checkbox" onclick="showPassword()" >
			<p>Mostrar contrase&ntilde;a</p>
			<script>
				function showPassword(){
					var x = document.getElementById("txtContrasena");

					if(x.type === "password"){
						x.type = "text";
					}else{
						x.type = "password";
					}
				}
			</script>
		</label>

		<div class="f-l-btns" >
			<div class="cta-btn" >
				<button type="button" class="c-c-btn" id="prevBtn" onclick="nextPrev(-1)">Regresar</button>
				<input type="submit" class="c-btn btn-crear" name="btnRegistrarUsuario" id="btnRegistrarUsuario" value="Crear Cuenta"/>
			</div>
		</div>
			<script>
				// Habilitar el boton de "Crear Cuenta" al comenzar a escribir la Usuario

				document.getElementById('btnRegistrarUsuario').disabled = true;

				document.getElementById('txtContrasena').addEventListener('keyup', e => {
					if (e.target.value == "") {
						document.getElementById('btnRegistrarUsuario').disabled = true;
					}	else {
							document.getElementById('btnRegistrarUsuario').disabled = false;
						}
				});
			</script>
	</div>
	<div>
		<span class="step"></span>
		<span class="step"></span>
	</div>
</form>


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
			document.getElementById("frmUsuario").submit();
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
