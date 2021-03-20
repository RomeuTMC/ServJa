<link href="<?php echo URL; ?>css/login.css" rel="stylesheet">
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
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
                <form method="POST" action="<?php echo URL; ?>login/criaconta" onsubmit="spinner.show();">
                    <div class="input-group mb-3" data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Preencha com seu nome e sobrenome, da maneira que 
                        gostaria de ser chamado ou visualizado em nosso sistema!">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="text" name="nome" id="nome" 
                        value="<?php echo $data['NOME']; ?>"
                        class="form-control input_user"
                        placeholder="Nome Completo" required >
                    </div>
                    <div class="input-group mb-3" data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Preencha com um e-mail válido, e que possa ser 
                        verificado, pois será necessário validar seu email para ter
                        acesso ao nosso sistema.">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="email" name="login" id="login" 
                        class="form-control input_user" 
                        value="<?php echo $data['LOGIN']; ?>" 
                        placeholder="username (e-mail)" required >
                    </div>
                    <div class="input-group mb-2" data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Utilize uma senha segura, preferivelmente com letras, 
                        números, simbolos e caracteres especiais.">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-key"></i>
                            </span>
                        </div>
                        <input type="password" name="passw" id="passw" 
                        class="form-control input_pass" 
                        value="<?php echo $data['PASSW']; ?>" 
                        placeholder="password" required>
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" name="button" 
                            class="btn login_btn">Fazer Cadastro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>