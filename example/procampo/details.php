<?php
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
    require_once($files["header"]);
    ?>
    <br>
    <!-- Page Content -->
    <div class="container">
        <?php
        $u = Validation::escapeValue('u');
        echo("<h3>Detalhes do produto: Ref: ".$u."</h3><div class=\"col-md-12\">");
        
        $data = Database::getInstance();
        $query = $data->select('products', array('ref_of_product', '=', $u));
        foreach($query as $r)
        {
            $q = $data->select('reviews', array('products_id', '=', $r['id']));
            $product_id = $r['id'];
            echo("<div class=\"thumbnail\">
                  <img class=\"img-responsive\" src=\"".$r['image_path']."\" alt=\"\">
                  <div class=\"caption-full\">
                  <h4 class=\"pull-right\">€ ". $r['price_of_product']."</h4>
                  <h4>".$r['name_of_product']."</h4>
                  <p>".$r['description']."</p>
                  <p>Categoria do produto: ".$r['category_of_product']."</p>
                  <p><h4><a class=\"btn btn-success\" href=\"shop.php?t=".$r['id']."\">Adicionar ao carrinho</a></h4></p>
                  </div>
                  <div class=\"ratings\">
                  <p class=\"pull-right\">" . count($q)  . " comentário(s)</p><!--Contador de reviews para cada produto -->
                  <p>
                  <span class=\"glyphicon glyphicon-star\"></span>
                  <span class=\"glyphicon glyphicon-star\"></span>
                  <span class=\"glyphicon glyphicon-star\"></span>
                  <span class=\"glyphicon glyphicon-star\"></span>
                  <span class=\"glyphicon glyphicon-star-empty\"></span>
                  4.0 stars
                  </p>
                  </div>
                  </div>");
        }
        ?>
        <div class="well">
            <?php
            if(!Session::exists('id'))
            {
            ?>
                <div class="text-center">
                    Para comentar o produto tem de entrar</a> ou <a href="registar.php">registar-se</a> !
                </div>
            <?php
            }
            else
            {
                if(Validation::wasClicked('submit_comment'))
                {
                    // Anti-CSRF protection
                    if(Token::check(Validation::get('token'), 'token_form'))
                    {
                        $data = Database::getInstance();
                        $valid = new Validation;

                        $stars = '2';
                        $message = Validation::escapeValue('comment_of_product');

                        $valid->checkBounds($message,'Mensagem', 30, 100);

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
                            $now = date("Y-m-d");
                            $query = $data->insert('reviews', array('stars' => $stars,
                                                                    'comments' => $message,
                                                                    'products_id' => $product_id,
                                                                    'users_id' => Session::get('id'),
                                                                    'comment_in' => $now));
                            if(!$query)
                            {
                                //Session::flash("comment", "O seu comentário foi inserido com sucesso !");
                                //echo("<meta http-equiv=\"refresh\" content=\"3\">");
                                echo("Algum erro aconteceu !!!");
                            }
                            // <meta http-equiv=\"refresh\" content=\"1\">
                        }
                    }
                }
                else
                {
                    if(!(Session::get('nickname') === 'admin'))
                    {
            ?>
                <form action="<?php echo("details.php?u=".urlencode($u)); ?>" method="post" name="comment" id="comment" validate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label for="comment_of_product">Comente este produto:</label>
                            <textarea rows="5" cols="100" class="form-control" name="comment_of_product" id="comment_of_product" required data-validation-required-message="Por favor insira o seu comentário" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <input type="hidden" name="token" value="<?php echo Token::generate('token_form'); ?>">
                    <button type="submit" name="submit_comment" id="submit_comment" class="btn btn-success">Comentar</button>
                </form><br><br>
            <?php
                    }
                }
            }
            if(Validation::wasClicked('submit_apaga_coment'))
            {
                $op = Validation::escapeValue('op');
                if($op === "delete")
                {
                    $id = Validation::escapeValue('rt');
                    $query = $data->delete('reviews', array('id', '=', $id));
                    if($query)
                    {
                        echo("Comentário apagado com sucesso !<br><a href=\"details.php?u=".urlencode($u)."\">Refrescar página !</a>");
                    }
                }
            }
            $que = $data->select('reviews', array('products_id', '=', $product_id));
            if(!empty($que))
            {
                foreach($que as $ru)
                {
                    $q = $data->select('users', array('id', '=', $ru['users_id']));
                    foreach($q as $ty)
                    {
                        echo("<div class=\"row\">
                              <div class=\"col-md-12\">
                              <!--<span class=\"glyphicon glyphicon-star\"></span>
                              <span class=\"glyphicon glyphicon-star\"></span>
                              <span class=\"glyphicon glyphicon-star\"></span>
                              <span class=\"glyphicon glyphicon-star\"></span>
                              <span class=\"glyphicon glyphicon-star-empty\"></span>-->
                              <br>Utilizador: ". $ty['nickname']  ."
                              <span class=\"pull-right\">" . $ru['comment_in']  . "</span>
                              <p>Mensagem: " . $ru['comments']  . "</p>");
                        if(Session::get('nickname') === 'admin')
                        {
                            echo("<p>
                                  <form action=details.php?u=".urlencode($u)."&op=delete&rt=".urlencode($ru['id'])." method=\"post\" name=\"apaga_coment\" id=\"apaga_coment\">
                                  <button type=\"submit\" name=\"submit_apaga_coment\" id=\"submit_apaga_coment\" class=\"btn btn-danger\">Apagar Comentário</button>
                                  </form>
                                  </p>");
                        }
                        echo("
                     </div>
                     </div><hr>");
                    }
                }
            }
            ?>
        </div>
    </div>
    <!-- /.container -->
    <?php
	require_once($files["footer"]);
    ?>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="<?= $files["js-query"]; ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $files["js"]; ?>"></script>
    <!-- Script to Activate the Carousel -->
</body>
</html>
