<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Beer.php";
    require_once __DIR__."/../src/Review.php";
    require_once __DIR__."/../src/User.php";

    $app = new Silex\Application();
    $app['debug']=true;

    $server = 'mysql:host=localhost;dbname=growler';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views')
    );

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //homepage
    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("create_user", function() use ($app) {
        $user = new User($_POST['user_name'], $_POST['preferred_style'], $_POST['region']);
        $user->save();
        return $app['twig']->render('user.html.twig', array('user' => $user));
    });

    return $app;

?>
