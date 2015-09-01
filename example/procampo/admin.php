<?php
require_once 'init.php';

if(!Session::exists('id'))
{
    Redirect::to('index.php');
}

/*
if(Validation::wasClicked('file'))
{
    // Anti-CSRF protection
    if(Token::check(Validation::get('token')))
    {
        $validFile = new Files;
        if($validFile->validateName('userfile'))
        {
            $validFile->validateType('image/png', 'userfile');
            $validFile->validateSize('userfile');
        }
        if($validFile->errors())
        {
            foreach($validFile->errors() as $error)
            {
                echo "<br><div class=\"container\"><div class=\"row\">" . $error . "<br></div></div>";
            }
        }
        else
        {
            // no errors
            Files::uploadFile('userfile', '/home/filipe/PHP/procampo/uploads/');
            // insert the path of the image in database table for that effect
            echo Files::getFilePath();
        }
    }
}
*/

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
           <!-- <div class="col-md-10">
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
                        <input type="hidden" name="token" value="< ? php echo Token::generate(); ?>">
                        <button type="submit" name="submit_register" class="btn btn-success">Registar</button>
                </form>
           </div>
                <form action="< ?php Utils::me(); ?>" method="post" enctype="multipart/form-data">
                Upload file:<br />
                <input name="userfile" type="file" />
                <input type="hidden" name="token" value="< ?php echo Token::generate(); ?>">
                <input name="file"  type="submit" value="Send file" />
            </form>-->
            <br>
            <h3>Olá Administrador do WebShop ProCampo Rural Shop</h3>
            <br>
            <?php // Usar Mailgun aqui  ?>
           <!-- <h4>Mandar Newsletter para os Utilizadores Registados</h4>
            <form method="post" action="< ? php Utils::me(); ?>" name="newsletter" id="newsletter" validate>
                <div class="controls">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control" name="title" id="title" value="< ? php Validation::get('title');  ?>" required data-validation-required-message="Por favor insira um título !" autocomplete="off">
                    <p class="help-block"></p>
                </div>
                <div class="controls">
                    <label for="nome">Mensagem:</label>
                    <textarea class="form-control" name="message" id="message" rows="10" value="< ? php Validation::get('message');  ?>" required data-validation-required-message="Por favor insira uma mensagem !" autocomplete="off"></textarea>
                </div>
                < ! --<div id="success"></div>-- >
                <br>
                < ! -- For success/fail messages -- >
                <input type="hidden" name="token" value="< ? php echo Token::generate(); ?>">
                <button type="submit" name="submit_newsletter" class="btn btn-success">Enviar Newsletter</button>
            </form>-->
            <br>
            <h4>Tabelas da Base de Dados</h4>
            <a href="http://localhost:8000/admin.php?t=orders" type="button" class="btn btn-lg btn-success">Ordens de Encomenda</a>
            <a href="http://localhost:8000/admin.php?u=users" type="button" class="btn btn-lg btn-success">Utilizadores</a>
            <a href="http://localhost:8000/admin.php?p=products" type="button" class="btn btn-lg btn-success">Produtos</a>
            <a href="http://localhost:8000/admin.php?r=reviews" type="button" class="btn btn-lg btn-success">Comentários</a>
            <br>
            <!--Cada tabela da base de dados tem um botão: Inserir, Selecionar, Actualizar e Apagar dados-->
            <?php
            if(Validation::active('t'))
            {
            ?>
            <br>
            <h4>Tabela: Ordens de Encomenda</h4>
            <a href="http://localhost:8000/admin.php?t=orders&a=select" type="button" class="btn btn-lg btn-success">Mostrar Ordens</a>
            <a href="http://localhost:8000/admin.php?t=orders&a=delete" type="button" class="btn btn-lg btn-success">Apagar Ordens</a>
            <br>
            <?php
            }

            if(Validation::active('t') && Validation::get('a') === 'select')
            {
                echo("<br><div class=\"col-md-10\">
                    <table class=\"table table-striped\">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>");
            }
            else if(Validation::active('t') && Validation::get('a') === 'delete')
            {
                echo("<form method=\"post\" action=\"admin.php?t=orders&a=delete\" name=\"newsletter\" id=\"newsletter\" validate>
                <div class=\"controls\">
                    <label for=\"title\">Título:</label>
                    <input type=\"text\" class=\"form-control\" name=\"title\" id=\"title\" required data-validation-required-message=\"Por favor insira um título !\" autocomplete=\"off\">
                    <p class=\"help-block\"></p>
                </div>
                <div class=\"controls\">
                    <label for=\"nome\">Mensagem:</label>
                    <textarea class=\"form-control\" name=\"message\" id=\"message\" rows=\"10\" required data-validation-required-message=\"Por favor insira uma mensagem !\" autocomplete=\"off\"></textarea>
                </div>
                <br>
                <input type=\"hidden\" name=\"token\" value=".Token::generate('token_form').">
                <button type=\"submit\" name=\"submit_newsletter\" class=\"btn btn-success\">Enviar Newsletter</button>
                </form>");
            }
            
            if(Validation::active('u'))
            {
            ?>
            <h4>Tabela: Utilizadores</h4>
            <a href="http://localhost:8000/admin.php?u=users&ac=select" type="button" class="btn btn-lg btn-success">Mostrar Utilizadores</a>
            <a href="http://localhost:8000/admin.php?u=users&ac=delete" type="button" class="btn btn-lg btn-success">Apagar Utilizadores</a>
            <br>
            <?php
            }
            if(Validation::active('p'))
            {
            ?>
            <h4>Tabela: Produtos</h4>
            <a href="http://localhost:8000/admin.php?p=products&act=insert" type="button" class="btn btn-lg btn-success">Inserir Novo Produto</a>
            <a href="http://localhost:8000/admin.php?p=products&act=select" type="button" class="btn btn-lg btn-success">Mostrar Produto(s)</a>
            <a href="http://localhost:8000/admin.php?p=products&act=update" type="button" class="btn btn-lg btn-success">Actualizar Produto</a>
            <a href="http://localhost:8000/admin.php?p=products&act=delete" type="button" class="btn btn-lg btn-success">Apagar Produto</a>
            <?php
            }

            if((Validation::get('p') === 'products') && (Validation::get('act') === 'insert'))
            {                
                echo("<h2>Inserir Novo Produto</h2><br><form method=\"post\" action=\"test.php\" name=\"products_insert\" id=\"products_insert\" enctype=\"multipart/form-data\" validate>
                              <div class=\"controls\">
                                  <label for=\"file\">Upload file:</label>
                                  <input name=\"userfile\" id=\"userfile\" type=\"file\">
                              </div>
                              <div class=\"controls\">
                                  <label for=\"ref\">Referência do Produto:</label>
                                  <input type=\"text\" class=\"form-control\" name=\"ref\" id=\"ref\" required data-validation-required-message=\"Por favor insira um título !\" autocomplete=\"off\">
                                  <p class=\"help-block\"></p>
                              </div>
                              <div class=\"controls\">
                                  <label for=\"name\">Nome do Produto:</label>
                                  <input type=\"text\" class=\"form-control\" name=\"name\" id=\"name\" required data-validation-required-message=\"Por favor insira um título !\" autocomplete=\"off\">
                                  <p class=\"help-block\"></p>
                              </div>
                              <div class=\"controls\">
                                  <label for=\"price\">Preço do Produto:</label>
                                  <input type=\"text\" class=\"form-control\" name=\"price\" id=\"price\" required data-validation-required-message=\"Por favor insira um título !\" autocomplete=\"off\">
                                  <p class=\"help-block\"></p>
                              </div>
                              <div class=\"controls\">
                                  <label for=\"descr\">Descrição do Produto:</label>
                                  <input type=\"text\" class=\"form-control\" name=\"descr\" id=\"descr\" required data-validation-required-message=\"Por favor insira um título !\" autocomplete=\"off\">
                                  <p class=\"help-block\"></p>
                              </div>
                              <div class=\"controls\">
                                  <label for=\"category\">Escolha a Categoria do Produto</label>
                                  <br>
                                  <select name=\"category\" id=\"category\" required />
                                      <option value=\"\">Escolha a Categoria do Produto</option>
                                      <option value=\"pecuaria\">Pecuária</option>
                                      <option value=\"campo\">Campo</option>
                                      <option value=\"jardim\">Jardim</option>
                                  </select>
                              </div>
                              <div class=\"controls\">
                                  <label for=\"envio\">Custo de Envio do Produto:</label>
                                  <input type=\"text\" class=\"form-control\" name=\"envio\" id=\"envio\" required data-validation-required-message=\"Por favor insira um título !\" autocomplete=\"off\">
                                  <p class=\"help-block\"></p>
                              </div>
                              <div class=\"controls\">
                                  <label for=\"quantity\">Quantidade do Produto:</label>
                                  <input type=\"number\" class=\"form-control\" name=\"quantity\" id=\"quantity\" required data-validation-required-message=\"Por favor insira um título !\" autocomplete=\"off\">
                                  <p class=\"help-block\"></p>
                              </div>
                              <br>
                              <input type=\"hidden\" name=\"token\" id=\"token\" value=".Token::generate('token_form').">
                              <input type=\"submit\" name=\"submit_new_product\" value=\"Inserir Novo Produto\" id=\"submit_new_product\" class=\"btn btn-success\">
                          </form>");
            }
            
            if(Validation::active('r'))
            {
            ?>
            <br>
            <h4>Tabela: Comentários</h4>
            <a href="http://localhost:8000/admin.php?r=reviews&acti=select" type="button" class="btn btn-lg btn-success">Mostrar Comentários</a>
            <a href="http://localhost:8000/admin.php?r=reviews&acti=delete" type="button" class="btn btn-lg btn-success">Apagar Comentários</a>
            <?php
            }
            
            //Isto é um exemplo do que se pretende: url encode http://localhost:8000/admin.php?t=orders&a=select
            echo '<br>';
            //Depois com base no endereço é que se vai selecionar a operação que se pretende.
            echo '<br>';
            //Adicionar á tabela users um campo isadmin - valor default 0, para depois fazer o login do admin no site - feito
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

