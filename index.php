<?php
    require_once("vendor/autoload.php");

    //use \Slim\Slim;
    use \Hcode\Page;

    $app = new \Slim\Slim();

    $app->config('debug', false);

    $app->get('/', function() {

        $page = new Page();
        $page->setTpl("index");

    });

    $app->run();

?>