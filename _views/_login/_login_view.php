<?php
/**
 * BRASAP FRAMEWORK VIEW - TELA DE LOGIN
 *  View com o formulário de login
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_LOGIN
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */
?>
<style>
.user_card {
    height: 400px;
    width: 350px;
    margin-top: auto;
    margin-bottom: auto;
    background: #f39c12;
    position: relative;
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 
        rgba(0, 0, 0, 0.19);
    -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 
        rgba(0, 0, 0, 0.19);
    -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 
        rgba(0, 0, 0, 0.19);
    border-radius: 5px;

}
.brand_logo_container {
    position: absolute;
    height: 170px;
    width: 170px;
    top: -75px;
    border-radius: 50%;
    background: #60a3bc;
    padding: 10px;
    text-align: center;
}
.brand_logo {
    height: 150px;
    width: 150px;
    border-radius: 50%;
    border: 2px solid white;
}
.form_container {
    margin-top: 100px;
}
.login_btn {
    width: 100%;
    background: #c0392b !important;
    color: white !important;
}
.login_btn:focus {
    box-shadow: none !important;
    outline: 0px !important;
}
.login_container {
    padding: 0 2rem;
}
.input-group-text {
    background: #c0392b !important;
    color: white !important;
    border: 0 !important;
    border-radius: 0.25rem 0 0 0.25rem !important;
}
.input_user,
.input_pass:focus {
    box-shadow: none !important;
    outline: 0px !important;
}
.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
    background-color: #c0392b !important;
}
</style>
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
                    Ainda não tem uma Conta? <a href="#" class="ml-2">CRIAR CONTA</a>
                </div>
                <div class="d-flex justify-content-center links">
                    Esqueceu a Senha? <a href="#">RECUPERAR SENHA</a>
                </div>
            </div>
        </div>
    </div>
</div>