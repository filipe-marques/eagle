<?php
require_once 'init.php';
if(!Session::exists('id'))
{
    Redirect::to('index.php');
}
if(Session::get('nickname') === "admin")
{
    Redirect::to('admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php 
	require_once($files["header"]);
?>
    <div class="container">
    <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <!--<div class="col-md-10">
                <h3>Registe-se é fácil !</h3><h4>Quando terminar, receberá um email para proceder á confirmação da sua conta !</h4>
                <form method="post" action="" name="register" id="register" validate>
                        <div class="controls">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php Validation::get('email');  ?>" required data-validation-required-message="Por favor insira um email !" autocomplete="off">
                            <p class="help-block"></p>
                        </div>
                        <div class="controls">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required data-validation-required-message="Por favor insira uma password de 10 a 25 caracteres !" autocomplete="off">
                        </div>
                        <div class="controls">
                            <label for="vez_password">Insira outra vez a Password</label>
                            <input type="password" class="form-control" name="vez_password" id="vez_password" required data-validation-required-message="Por favor insira outra vez a password escolhida acima !" autocomplete="off">
                        </div>
                        <div class="controls">
                            <label for="nome">Nome de utilizador: (nickname)</label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?php Validation::get('nome');  ?>" required data-validation-required-message="Por favor insira um nome de utilizador (nickname)!" autocomplete="off">
                        </div>
                        < ! --<div id="success"></div>-- >
                        <br>
                    < ! -- For success/fail messages -- >
                    <button type="submit" name="submit_register" class="btn btn-success">Registar</button>
            </form>
            </div>-->
            <br>
            <br>
            <!--<form action="" method="post" name="actualizar_info" id="actualizar_info">
                <button type="submit" name="submit_actualizar_info" id="submit_actualizar_info" class="btn btn-success">Actualizar Informação </button>
            </form>-->
            <br>
            <?php
            $data = Database::getInstance();
            if(Validation::active('rt'))
            {
                $id = Validation::escapeValue('rt');
                $que = $data->delete('reviews', array('users_id', '=', $id));
                $query = $data->delete('orders', array('users_id', '=', $id));
                $qu = $data->delete('users', array('id', '=', $id));

                if($que and $query and $qu)
                {
                    echo("<h4>Apagou com sucesso a sua conta de utilizador !</h4><a href=\"logout.php\" class=\"btn btn-success\">Sair em Segurança</a>");
                }
                else
                {
                    echo("Pedimos desculpa ! Por Favor, tenta outra vez !");
                }
            }
            else
            {
            ?>
                <h4>Então já vai embora ?</h4>
                <a href="profile.php?rt=<?php echo(Session::get('id'));?>" class="btn btn-danger"><h4>Apagar Conta de Utilizador</h4></a>
            <?php
            }
            if(Validation::active('add') and Validation::get('add') === "ress")
            {
                if(Validation::wasClicked('submit_address'))
                {
                    // Anti-CSRF protection
                    if(Token::check(Validation::get('token_add'), 'token_address'))
                    {
                        $full = Validation::escapeValue('fullname');
                        $address = Validation::escapeValue('address');
                        
                        $valid = new Validation;
                        $user = new User;
                        
                        $valid->checkBounds($full, 'Nome Completo', 10, 60);
                        $valid->checkBounds($address,'Morada', 10, 90);

                        if(!empty($valid->errors()))
                        {
                            echo "<br><div class=\"container\">";
                            foreach($valid->errors() as $error)
                            {
                                echo "<div class=\"row\">" . $error . "</div><br>";
                            }
                            echo "</div>";
                        }
                        else
                        {
                            $que = $data->update('users', Session::get('id'), array('full_name' => $full, 'address' => $address));
                            if($que)
                            {
                                echo("<br><br><h4>Morada adicionada ou actualizada com sucesso !!!</h4>");
                            }
                        }
                    }
                }
            }
            else
                {
            ?>
                <br>
                <br>
                <h3>Adicionar ou Actualizar Morada</h3>
                <form method="post" action="profile.php?add=ress" name="complete_info" id="complete_info" validate>
                    <div class="controls">
                        <label for="fullname">Nome Completo</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" value="<?php Validation::get('fullname'); ?>" required data-validation-required-message="Por favor insira o nome completo !" autocomplete="off">
                        <p class="help-block"></p>
                    </div>
                    <div class="controls">
                        <label for="address">Morada Completa</label>
                        <input type="text" class="form-control" name="address" id="address" required data-validation-required-message="Por favor insira a sua morada completa !" autocomplete="off">
                    </div>
                    <br>
                    <input type="hidden" name="token_add" value="<?php echo Token::generate('token_address'); ?>">
                    <button type="submit" name="submit_address" id="submit_address" class="btn btn-success"><h4>Adicionar ou Actualizar Morada</h4></button>
                </form>
            <?php
                }
            ?>
        </div>
    </div>
    <?php
	require_once($files["footer"]);
    ?>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="<?= $files["js-query"]; ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $files["js"]; ?>"></script>
</body>
</html>

