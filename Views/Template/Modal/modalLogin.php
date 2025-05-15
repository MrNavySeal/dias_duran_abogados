<div class="modal fade" id="modalLogin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="login">
                <div class="container">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="login">
                            <form id="formLogin" name="formLogin">
                                <h2 class="mb-4">Iniciar sesión</h2>
                                <div class="mb-3 d-flex">
                                    <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-envelope"></i></div>
                                    <input type="email" class="form-control" id="txtLoginEmail" name="txtEmail" placeholder="Email" required>
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-lock"></i></div>
                                    <input type="password" class="form-control" id="txtLoginPassword" name="txtPassword" placeholder="Contraseña" required></textarea>
                                </div>
                                <div class="d-flex justify-content-end mb-3 t-p">
                                    <div class="c-p" id="forgotBtn">¿Olvidaste tu contraseña?</div>
                                </div>
                                <button type="submit" id="loginSubmit" class="btn btn-bg-2 w-100 mb-4" >Iniciar sesión</button>
                            </form>
                            <form id="formReset" class="d-none">
                                <h2 class="mb-4">Recuperar contraseña</h2>
                                <div class="mb-3 d-flex">
                                    <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-envelope"></i></div>
                                    <input type="email" class="form-control" id="txtEmailReset" name="txtEmailReset" placeholder="Email" required>
                                </div>
                                <p>Te enviaremos un correo electrónico con las instrucciones a seguir.</p>
                                <div class="d-flex justify-content-end mb-3 t-p" >
                                    <div class="c-p loginBtn">Iniciar sesión</div>
                                </div>
                                <button type="submit" id="resetSubmit" class="btn btn-bg-2 w-100 mb-4" >Recuperar contraseña</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>