<?php
require_once 'init.php';
/*
   // só dá para fazer o login na página index.php
   if(Validation::wasClicked('submit_login'))
   {
   // Anti-CSRF protection
   if(Token::check(Validation::get('token')))
   {
   $email = Validation::escapeValue('inputEmail');
   $password = Validation::escapeValue('inputPassword');

   //$user = Database::getInstance();
   $valid = new Validation;
   $user = new User;
   
   //$user->insert('users', array('email' => $email, 'password' => $password));

   //$user->select('users', array('email', '=', $email));

   $pass = $valid->hashValue($password);
   if($user->login($email, $pass))
   {
   //echo 'YES';
   Redirect::to('profile.php');
   }
   else
   {
   echo 'mensagem com message twitter bootstrap';
   //echo Session::flash('acount', 'Por favor active a sua conta de utilizador !');
   }
   
   //echo $email . ' ' . $pass;

   //$user->update('users', 8, array('nickname' => 'qwedfg', 'active' => '1'));

   //$user->delete('users', '3');
   
   / *
   $user->selectMultiple('users', array(
   'query1' => array('email', '=', $email),
   'query2' => array('password', '=', $pass),
   'query3' => array('active', '=', '1')
   ));

   if(!empty($user))
   {
   echo 'YES!';
   //print_r($user);
   //echo '<br>'.$user[0]['id'];
   foreach($user as $u)
   {
   echo '<br>id: '.$u['id'].'<br>';
   echo 'email: '.$u['email'].'<br>';
   echo 'password: '.$u['password'].'<br>';
   echo 'nickname: '.$u['nickname'].'<br>';
   echo 'active: '.$u['active'].'<br>';
   }
   }
   else
   {
   echo "Por favor active a sua conta !<br>";
   }
 * /
   }
   }
 */
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
    require_once($files["header"]);
    ?>
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <hr>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i>Promoções aqui !</h4>
                    </div>
                    <div class="panel-body">
                        <p><h2>Publicidade a promoções aqui !</h2></p>
                        <!--<a href="#" class="btn btn-default">Learn More</a>-->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i>Compre com comodidade!</h4>
                    </div>
                    <div class="panel-body">
                        <p><h2>Em X dias, receberá a sua encomenda.</h2></p>
                        <!--<a href="#" class="btn btn-default">Learn More</a>-->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>Este site é só uma demonstração !</h4>
                    </div>
                    <div class="panel-body">
                        <p><h2>Este site é só uma demonstração do que pode vir a ser uma realidade !</h2></p>
                        <!--<a href="#" class="btn btn-default">Learn More</a>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->
        <!--<div class="row">
		<hr>
        <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
        <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
        </div>
        <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
        <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
        </div>
        <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
        <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
        </div>
        <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
        <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
        </div>
        <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
        <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
        </div>
        <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
        <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
        </div>
        </div>-->
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"></h2>
            </div>
            <div class="col-md-6">
                <!--<p></p>
                <ul>
                    <li><strong></strong>
                    </li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <p></p>-->
            </div>
            <div class="col-md-6">
                <!--<img class="img-responsive" src="http://placehold.it/700x450" alt="">-->
            </div>
        </div>
        <!-- /.row -->
        
        <!-- Call to Action Section
        <div class="well">
        <div class="row">
        <div class="col-md-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
        </div>
        <div class="col-md-4">
        <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
        </div>
        
        #07450E
        </div>
        </div>-->
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
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
</body>
</html>

