<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Beer.php";

    $app = new Silex\Application();
    $server = 'mysql:host=localhost;dbname=growler';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => array (
           __DIR__.'/../views'
      )
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //landing page
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array( 'beers'=> Beer::getAll()));
    });

    //beers routes

    //all beers
    $app->get("/stores", function() use ($app) {
    return $app['twig']->render('beers.html.twig', array('beers' => Beer::getAll()));
    });

    //adding beer
    $app->post("/beers", function() use ($app) {
    $beer_name = $_POST['beer_name'];
    $style = $_POST['style'];
    $abv = $_POST['abv'];
    $ibu = $_POST['ibu'];
    $container = $_POST['container'];
    $brewery = $_POST['brewery'];
    $beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery);
    $beer->save();
    return $app['twig']->render('beers.html.twig', array('beers' => Beer::getAll()));
    });

    //view beer
    $app->get("/beers/{id}", function($id) use ($app) {
    $beer = Beer::find($id);
    return $app['twig']->render('beer.html.twig', array('beer' => $beer, 'beers' => Beer::getAll(), 'users' => $beer->getUsers(), 'all_users' => User::getAll()));
    });

    return $app;
?>



