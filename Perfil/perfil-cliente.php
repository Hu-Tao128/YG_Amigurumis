<?php 
        require_once 'funciones-cliente.php';

        $IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
        $datosFotoPerfil = obtenerDatosUsuarioCliente($IDUsuarioCliente);

        if($datosFotoPerfil!=null){ 
            $Perfil=$datosFotoPerfil['mostrarPerfil'];
            $NombreUsuario=$datosFotoPerfil['NombreUsuarioCliente'];
            $Nombre=$datosFotoPerfil['Nombre'];
            $APaterno=$datosFotoPerfil['APaterno'];
            ?>
<section class="foto-perfil">
    <div class="f-p-usuario-box">
        <p class="f-p-usuario" >@<?=$NombreUsuario?></p>
    </div>
    <div class="f-p-foto-box">
        <img class="f-p-foto-img" src="<?=$Perfil?>" />  
        <p class="f-p-foto-txt" ><?=$Nombre?> <?=$APaterno?></p>
    </div>
    <div class="f-p-moreActions-box">
        <button type="button" class="open-modal f-p-moreActions-btn" data-open="modal1"><img class="icons" src="<?=IMG?>Perfil/editar-2.svg"/>Editar</button>
    </div>
            
        <div class="modal" id="modal1">
            <div class="modal-dialog">
                <header class="modal-header">
                    <p class="f-p-moreActions-txtmodal" ><img class="icons perfil-ico" src="<?=IMG?>Perfil/editar-2.svg"/>Cambiar foto de perfil</p>
                    <button class="close-modal" aria-label="close modal" data-close><img class="icons perfil-ico" src="<?=IMG?>Perfil/editar-2.svg"/></button>
                </header>
                <section class="modal-content">
                    <form name="frmAgregarFoto" id="frmAgregarFoto" action="Perfil/subirFotoPerfilCliente.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="IDCambioFoto" name="IDCambioFoto" value="<?=$IDUsuarioCliente?>" />
                        <div class="drop-zone">
                            <span class="soltar-img-perfil__modal">Suelte el archivo aquí o haga clic para subirlo a YG</span>
                            <input type="file" id="changeFotoPerfil" name="changeFotoPerfil" class="drop-zone__input" accept="image/*">
                        </div>
                        <input type="submit" name="btnCambiarFotoPerfil" id="btnCambiarFotoPerfil" value="Si" />
                        <input type="button" value="No" onclick=self.location="<?=ROOTURL?>?accion=perfil" />
                    </form>
                </section>
            </div>
            <script>
                const openEls = document.querySelectorAll("[data-open]");
                const closeEls = document.querySelectorAll("[data-close]");
                const isVisible = "is-visible";

                for (const el of openEls) {
                el.addEventListener("click", function() {
                    const modalId = this.dataset.open;
                    document.getElementById(modalId).classList.add(isVisible);
                });
                }

                for (const el of closeEls) {
                el.addEventListener("click", function() {
                    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
                });
                }

                document.addEventListener("click", e => {
                if (e.target == document.querySelector(".modal.is-visible")) {
                    document.querySelector(".modal.is-visible").classList.remove(isVisible);
                }
                });

                document.addEventListener("keyup", e => {
                // if we press the ESC
                if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
                    document.querySelector(".modal.is-visible").classList.remove(isVisible);
                }
                });
            </script>
        </div>        

</section>
<section class="p-link-box">
    <a class="p-link" href="<?=ROOTURL?>?accion=formEditAjustes&IDUsuario=<?=$datosFotoPerfil['IDUsuario']?>" >
        <div class="p-link-container" >
            <img class="p-l-c-icon" src="<?=IMG?>Perfil/mi-infos.svg"/>
            <p class="p-l-c-txt">Mi Informaci&oacute;n</p>
        </div>
        <img class="p-l-c-icon" src="<?=IMG?>Perfil/link-ir.svg"/>
    </a>
    
    <a class="p-link" href="<?=ROOTURL?>?accion=listTarjetas" >
        <div class="p-link-container" >
            <img class="p-l-c-icon" src="<?=IMG?>Perfil/mis-tarjetas.svg"/>
            <p class="p-l-c-txt">Mis Tarjetas</p>
        </div>
        <img class="p-l-c-icon" src="<?=IMG?>Perfil/link-ir.svg"/>
    </a>
    
    <a class="p-link" href="<?=ROOTURL?>?accion=mis-pedidos">
        <div class="p-link-container" >
            <img class="p-l-c-icon" src="<?=IMG?>Perfil/mis-compras.svg"/>
            <p class="p-l-c-txt">Mis Pedidos</p>
        </div>
        <img class="p-l-c-icon" src="<?=IMG?>Perfil/link-ir.svg"/>
    </a>
    
    <a class="p-link" href="<?=ROOTURL?>?accion=formEditCuenta">
        <div class="p-link-container" >
            <img class="p-l-c-icon" src="<?=IMG?>Perfil/mi-cuentas.svg"/>
            <p class="p-l-c-txt">Mi Cuenta</p>
        </div>
        <img class="p-l-c-icon" src="<?=IMG?>Perfil/link-ir.svg"/>
    </a>

    <a class="p-link-eliminar" href="<?=ROOTURL?>?accion=form-eliminar-cuenta">
        <div class="p-link-container-eliminar" >
            <img class="p-l-c-icon-eliminar" src="<?=IMG?>Perfil/eliminar-cuenta.svg"/>
            <p class="p-l-c-txt-eliminar">Eliminar Cuenta</p>
        </div>
        <img class="p-l-c-icon-eliminar" src="<?=IMG?>Perfil/link-ir-eliminar.svg"/>
    </a>
</section>
<?php	
    }	
?>




<script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");
  
    dropZoneElement.addEventListener("click", (e) => {
      inputElement.click();
    });
  
    inputElement.addEventListener("change", (e) => {
      if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
      }
    });
  
    dropZoneElement.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropZoneElement.classList.add("drop-zone--over");
    });
  
    ["dragleave", "dragend"].forEach((type) => {
      dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
      });
    });
  
    dropZoneElement.addEventListener("drop", (e) => {
      e.preventDefault();
  
      if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
      }
  
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });
  
  /**
   * Updates the thumbnail on a drop zone element.
   *
   * @param {HTMLElement} dropZoneElement
   * @param {File} file
   */
  function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
  
    // First time - remove the prompt
    if (dropZoneElement.querySelector(".soltar-img-perfil__modal")) {
      dropZoneElement.querySelector(".soltar-img-perfil__modal").remove();
    }
  
    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
      thumbnailElement = document.createElement("div");
      thumbnailElement.classList.add("drop-zone__thumb");
      dropZoneElement.appendChild(thumbnailElement);
    }
  
    thumbnailElement.dataset.label = file.name;
  
    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();
  
      reader.readAsDataURL(file);
      reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
      };
    } else {
      thumbnailElement.style.backgroundImage = null;
    }
  }
  
</script>