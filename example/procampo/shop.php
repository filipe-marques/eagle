<?php
require_once 'init.php';
$data = Database::getInstance();
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
    require_once($files["header"]);
    ?>
    <!-- Page Content -->
    <div class="container">
        <br>
        <h2>
            Shop
        </h2>
        <br>
        <br>
        <!--<div class="col-sm-3 col-md-2 sidebar">-->
        <ul class="nav nav-sidebar">
            <li class="active"><a href="shop.php?q=campo">Campo</a></li>
            <li><a href="shop.php?q=jardim">Jardim</a></li>
            <li><a href="shop.php?q=pecuaria">Pecuária</a></li>
            <!--<li><a href="#">Export</a></li>-->
        </ul>
        <br>
        <!--</div>-->

        <div class="container">
            <?php
            if(Validation::active('r'))
            {
                $io = NULL;
                $quan = NULL;
                $remove_id = Validation::escapeValue('r');
                $tu = $data->select('cart', array('id', '=', $remove_id));
                foreach($tu as $r)
                {
                    $io = $r['product_id'];
                }
                $data->delete('cart', array('id', '=', $remove_id));
                $ty = $data->select('products', array('id', '=', $io));
                foreach($ty as $d)
                {
                    $er = $d['quantity'];
                    $quan = $er+1;
                }
                $qu = intval($quan);
                $data->update('products', $io, array('quantity' => $qu));
            }
            if(Validation::active('t'))
            {
                $id_prod = Validation::escapeValue('t');
                $data->insert('cart', array('user_id' => Session::get('id'), 'product_id' => $id_prod));
                $er = $data->select('products', array('id', '=', $id_prod));
                foreach($er as $t)
                {
                    $res = ($t['quantity'])-1;
                }
                $resu = intval($res);
                if($resu >= 0)
                {
                    $data->update('products', $id_prod, array('quantity' => $resu));
                }
                else
                {
                    echo("O produto esgotou !");
                }
            }
            if(Session::exists('id'))
            {
                echo("<br><div class=\"table-responsive\">
                    <h4>Carrinho de Compras</h4><br>
                    <table class=\"table table-striped\">
                    <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Referência</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Custo de Envio</th>
                    </tr>
                    </thead>
                    <tbody>");
                $query = $data->select('cart', array('user_id', '=', Session::get('id')));
                if(!empty($query))
                {
                    foreach($query as $op)
                    {
                        $qu = $data->select('products', array('id', '=', $op['product_id']));
                        foreach($qu as $e)
                        {
                            echo("<tr><td>" . $e['name_of_product']  . "</td>
                            <td>" . $e['ref_of_product']  . "</td>
                            <td>" . $e['price_of_product']  . " €</td>
                            <td>" . $e['description']  . "</td>
                            <td>" . $e['category_of_product']  . "</td>
                            <td>" . $e['shipping']  . " €</td>
                            <td><a href=\"shop.php?q=". Validation::get('q') ."&r=". $op['id'] ."\">Remover ?</a></td>
                            </tr>");
                        }
                    }
                    echo("</tbody>
                    </table>
                    </div>");
                    echo("<h4><a class=\"pull-right btn btn-lg btn-success\" href=\"checkout.php\">Checkout</a><br><br><br></h4>");
                }
                else
                {
                    echo("<p>Carrinho de Compras Vazio !!!<br>Adicione um produto !</p>");
                }
            }
            /*
               pega nos produtos adicionados e faz o checkout
               que é fazer o sumatório do preço a pagar e no
               fim do processo registar os produtos na tabela orders
             */
            ?>
        </div>
        <?php
        if(Validation::active('q'))
        {
            switch(Validation::get('q'))
            {
                case 'campo':
                $query = $data->select('products', array('category_of_product', '=', 'campo'));
                break;
                case 'jardim':
                $query = $data->select('products', array('category_of_product', '=', 'jardim'));
                break;
                case 'pecuaria':
                $query = $data->select('products', array('category_of_product', '=', 'pecuaria'));
                break;
            }
            foreach($query as $q)
            {
                $que = $data->select('reviews', array('products_id', '=', $q['id']));
                echo("<div class=\"col-sm-4 col-lg-4 col-md-4\">
                            <div class=\"thumbnail\">
                                <img src=".$q['image_path']." alt=\"\">
                                <div class=\"caption\">
                                    <h4 class=\"pull-right\">€ " . $q['price_of_product']  . "</h4>
                                    <h4>".$q['name_of_product']."</h4>
                                    <h4><a href=\"details.php?u=".urlencode($q['ref_of_product'])."\">".$q['ref_of_product']."</a></h4>
                                    <p>".$q['description']."</p>
                                </div>");
                if(Session::exists('id'))
                {
                    if($q['quantity'] === '0')
                    {
                        $quantity = "Produto Esgotado!";
                    }
                    else
                    {
                        $quantity = $q['quantity'];
                        if(!(Session::get('nickname') === "admin"))
                        {
                            echo("<h4><a class=\"btn btn-success\" href=\"shop.php?q=".Validation::get('q')."&t=".$q['id']."\">Adicionar ao carrinho</a></h4>");
                        }
                    }
                }
                else
                {
                    echo("<h4>Entre ou <a href=\"registar.php\">Registe-se</a> para comprar</h4>");
                }
                $quantity = $q['quantity'];
                echo("<div class=\"ratings\">
                                    <p class=\"pull-right\"><a href=\"details.php?u=".urlencode($q['ref_of_product'])."\">Comentar ?</a></p><!-- Contador de reviews por produto -->
                                    <p>Quantidade:  " . $quantity  . "</p><!--<span class=\"glyphicon glyphicon-star\"></span>
                                       <span class=\"glyphicon glyphicon-star\"></span>
                                       <span class=\"glyphicon glyphicon-star\"></span>
                                       <span class=\"glyphicon glyphicon-star\"></span>
                                       <span class=\"glyphicon glyphicon-star\"></span>-->
                                       <p>" . count($que) . " comentário(s)
                                    </p>
                                </div>
                          </div>
                     </div>");
            }
          }
          ?>
    </div>
    <!-- Features Section -->
    <div class="container">
        <?php
        if(Validation::active('q'))
            echo("<br><p><a class=\"btn btn-lg btn-success\" href=\"shop.php?q=" . Validation::get('q') . "#\">Voltar Acima !</a></p>");
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
    <!-- Script to Activate the Carousel -->
</body>
</html>

