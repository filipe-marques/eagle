<?php
/*Ver os vídeos do canal do YouTube phpacademy sobre mini shopping cart e start review system para implementar na página
   details.php e mostrar na página shop o resultado e também na página details.php.
 */
require_once 'init.php';
if(!Session::exists('id'))
{
    Redirect::to('index.php');
}
if(Session::get('nickname') === "admin")
{
    Redirect::to('admin.php');
}
$data = Database::getInstance();
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
	require_once($files["header"]);
    ?>
    <div class="container">
        <div class="row">
            <br>
            <p><h4>Verifique o Carrinho de Compras e a sua morada, pois será para este endereço que irá ser enviada a sua encomenda !</h4></p>
            <br>
            <p><h4>A sua encomenda só será registada na nossa base de dados, quando completar o pagamento !</h4></p>
            <br>
            <p><h4>Até completar o pagamento a sua lista de compras será guardada !</h4></p>
            <br>
            <?php
            $price_total = NULL;
            $shipping = NULL;
            echo("<br><div class=\"table-responsive\">
                    <h4>1- Carrinho de Compras</h4><br>
                    <table class=\"table table-striped\">
                    <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Referência</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Custo de Envio</th>
                    <th>Acção</th>
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
                        $price_total = $price_total+($e['price_of_product']);
                        $shipping = $shipping+($e['shipping']);
                        echo("<tr><td>" . $e['name_of_product']  . "</td>
                            <td>" . $e['ref_of_product']  . "</td>
                            <td>" . $e['price_of_product']  . " €</td>
                            <td>" . $e['description']  . "</td>
                            <td>" . $e['category_of_product']  . "</td>
                            <td>" . $e['shipping']  . " €</td>
                            <td><a href=\"shop.php?q=". Validation::get('q') ."&r=". $op['id'] ."\"><strong>Remover ?</strong></a></td>
                            </tr>");
                    }
                }
                echo("</tbody>
                    </table>
                    </div>");
                echo("<strong>Total: ".$price_total." €<br>Custo de Envio: ".$shipping."€</strong>");
            }
            //echo("<br><br><h4>Poderá alterar a sua morada na sua página de <a href=\"profile.php\">utilizador</a></h4>");
            echo("<br><br><div class=\"table-responsive\">
                    <h4>2- A sua Morada</h4><br>
                    <table class=\"table table-striped\">
                    <thead>
                    <tr>
                    <th>Nome Completo</th>
                    <th>Endereço</th>
                    </tr>
                    </thead>
                    <tbody>");
            $query = $data->select('users', array('id', '=', Session::get('id')));
            if(!empty($query))
            {
                foreach($query as $op)
                {
                    if(empty($op['full_name']) and empty($op['address']))
                    {
                        echo("<h4>Adicione a sua morada na sua página de <a href=\"profile.php\">utilizador</a> !</h4>");
                    }
                    else
                    {
                        echo("<tr><td>" . $op['full_name']  . "</td>
                            <td>" . $op['address']  . "</td>
                            </tr>");
                    }
                }
                echo("</tbody>
                    </table>
                    </div>");
                echo("<br>Paypal ou Multibanco AQUI !");
                /*
                   Depois de fazer o pagamento redirecciona para esta página e regista os produtos do carrinho de compras
                   na tabela products e apaga os produtos da tabela cart.
                 */
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

