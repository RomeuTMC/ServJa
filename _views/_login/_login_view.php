<link href="<?php echo URL; ?>css/login.css" rel="stylesheet">
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="<?php echo URL; ?>resources/logo/logo-full.png" 
                        class="brand_logo" alt="Logo ServJa">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form method="POST" action="<?php echo URL; ?>login/login" onsubmit="spinner.show();">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="email" name="login" id="login" 
                        class="form-control input_user" value="" 
                        placeholder="username (e-mail)" required >
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-key"></i>
                            </span>
                        </div>
                        <input type="password" name="passw" id="passw" 
                        class="form-control input_pass" value="" 
                        placeholder="password" required>
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" name="button" 
                            class="btn login_btn">Fazer Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    Ainda não tem uma Conta? <a href="<?php echo URL;?>login/cadastro" class="ml-2">CRIAR CONTA</a>
                </div>
                <div class="d-flex justify-content-center links">
                    Esqueceu a Senha? <a href="#">RECUPERAR SENHA</a>
                </div>
            </div>
        </div>
    </div>
</div>