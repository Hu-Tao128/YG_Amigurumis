<form id="frmTarjeta" id="frmTarjeta" action="UsuarioCliente/addTarjeta.php" method="POST">
    <input type="hidden" name="accion" id="accion" value="addTarjeta" />
	<input type="hidden" name="IDUsuario" id="IDUsuario" value="<?=$_SESSION['cliente_session']?>" />

    <div class="tab-registrar">
        <div class="login-head" >
    	    <p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/mis-tarjetas-title.svg"/>Agrega una Tarjeta</p>
			<p class="subtitulo-carrito">Introduce los datos de tu tarjeta.</p>
		</div>
            <div class="tab-form-registrar" >
                <div class="input-registrar">
                    <label class="form-label-registrar" >Nombre del Titular</label>
                    <input class="form-input-registrar" type="text" name="NombreTitular" id="NombreTitular" required />
                </div>
                <div class="input-registrar">
                    <label class="form-label-registrar" >N&uacute;mero</label>
                    <input class="form-input-registrar" type="text" pattern="[0-9]{16}" name="Numero" id="Numero" title="Tiene que tener 16 car&aacute;cteres." maxlength="16" required/>
                </div>
                <div class="input-registrar">
                    <label class="form-label-registrar" >Vencimiento</label>
                    <input class="form-input-registrar" type="date" name="FechaVencimiento" id="FechaVencimiento" maxlength="8" required/>
                </div>
                <div class="input-registrar">
                    <label class="form-label-registrar" >CVC</label>
                    <input class="form-input-registrar" type="password" pattern="[0-9]{3}" name="CVC" id="CVC" title="Tiene que tener 3 car&aacute;cteres." maxlength="3" required/>
                </div>
                <input type="reset" id="btnReset" value="Borrar">
                <label class="form-relink-02 f-r-registrar" >
                    <input class="f-r-checkbox" type="checkbox" onclick="showPassword()" >
                    <p>Mostrar CVC</p>
                    <script>
                        function showPassword(){
                            var x = document.getElementById("CVC");
                            
                        if(x.type === "password"){
                            x.type = "text";
                        }else{
                            x.type = "password";
                        }
                    }
                    </script>
                </label>
            </div>

            <div class="f-l-btns" >
                <div class="cta-btn" >
                    <button type="button" class="c-c-btn" id="prevBtn" onclick=self.location="<?=ROOTURL?>?accion=listTarjetas">Cancelar</button>
                    <input type="submit" class="c-btn btn-crear" name="submit" id="submit" value="Agregar"/> <!-- Enviar -->
                </div>
            </div>
    </div>
</form>
