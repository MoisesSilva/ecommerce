<?php

    session_start();
    require_once("vendor/autoload.php");

    //use \Rain\Tpl;
    use \Slim\Slim;
    use \Hcode\Page;
    use \Hcode\PageAdmin;
    use \Hcode\Model\User;

    $app = new Slim();

    $app->config('debug', true);

    // Rota para a home
    $app->get('/', function() {

        $page = new Hcode\Page();
        $page->setTpl("index");
        

    });
    // Rota para a tela index da área admin
    $app->get('/admin', function() {

        // Verificar Login Usuário
        User::verifyLogin();

        $page = new Hcode\PageAdmin();
     
        $page ->setTpl("index");
     
    });
    // Rota para a tela de Login
    $app->get('/admin/login', function(){

        $page = new Hcode\PageAdmin([
            "header"=>false,
            "footer"=>false
        ]);

        $page->setTpl("login");

    });

    // Rota de envio POST do admin/login
    $app->post("/admin/login", function(){
        //User::login($_POST["login"], $_POST["password"]);
        User::login(post('deslogin'), post('despassword'));
        header("Location: /admin");
        exit;
    });

    $app->get('/admin/logout', function(){
        User::logout();

        header("Location : /admin/login");
        exit;
    });
     
    $app->run();

?>