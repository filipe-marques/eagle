<?php
require_once 'init.php';

if(Validation::wasClicked('submit_register'))
{
    // Anti-CSRF protection
    if(Token::check(Validation::get('token_regis'), 'token_register'))
    {
        $email = Validation::escapeValue('email');
        $password = Validation::escapeValue('password');
        $vez_password = Validation::escapeValue('vez_password');
        $name = Validation::escapeValue('nome');

        $valid = new Validation;
        $user = new User;
        
        $valid->equalPassword($password, $vez_password);
        $valid->spamout($email);
        $valid->checkBounds($password, 'Password', 10, 50);
        $valid->checkBounds($name,'Nome de Utilizador', 6, 20);

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
            // no errors
            $pass = $valid->hashValue($password);
            $res = $user->createUser($email, $pass, $name);

            if($res) // mandar o email ou fazer o login do novo utilizador
            {
                // update page
                // echo "<meta http-equiv=\"refresh\" content=\"1\">";
                // send email to $email using PHPMailer
                /*
                $m = new PHPMailer;
                $m->isSMTP;
                $m->SMTPAuth = true;
                $m->SMTPDebug = 2;
                $m->Host = 'smtp.gmail.com';
                $m->Username = '';
                $m->Password = '';
                $m->SMTPSecure = 'ssl';
                $m->Port = 465;

                $m->From = '';
                $m->FromName = 'ProCampo Rural Shop';
			    $m->addReplyTo('reply@portfolio.com', 'Reply Address');
			    $m->addAddress('', 'ProCampo Rural Shop Website');

			    $m->Subject = 'Activação de conta de utilizador em ProCampo Rural Shop Website';
			    $m->Body = $message = "<h4>Your Message:<br><br>
								Nickname: " . $name . "<br>
								Email: " . $email . "<br>
                                Clique <a href=\"http://localhost:8000/activate.php?r=".urlencode($email).">aqui</a> para activar a sua conta de utilizador !<br>
								Thank You! Your message will be answered shortly.
								<br>
								</h4>
							</div>
							</section>";
                $m->AltBody = $message;

                if($m->send())
                {
                    echo "<br><div class=\"container\"><div class=\"row\">Registo efectuado com sucesso !<br> Foi enviado um email para activação da sua conta de utilizador.<br></div></div>";
			    }
                */
            }
        }
    }
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
            <div class="col-md-10">
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
                        <!--<div id="success"></div>-->
                        <br>
                        <!-- For success/fail messages -->
                        <input type="hidden" name="token_regis" value="<?php echo Token::generate('token_register'); ?>">
                        <button type="submit" name="submit_register" id="submit_register" class="btn btn-success">Registar</button>
                </form>
            </div>
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
