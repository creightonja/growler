<?php

    require_once __DIR__."/../vendor/autoload.php";
<<<<<<< HEAD
    require_once __DIR__."/../src/Beer.php";
    require_once __DIR__."/../src/User.php";

    $app = new Silex\Application();

=======
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Beer.php";
    require_once __DIR__."/../src/Review.php";
    require_once __DIR__."/../src/User.php";

    $app = new Silex\Application();
>>>>>>> fdf90617ea4e3a9c5969dd093aefc09d29500704
    $app['debug']=true;

    $server = 'mysql:host=localhost;dbname=growler';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

<<<<<<< HEAD
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
=======
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views')
    );
>>>>>>> fdf90617ea4e3a9c5969dd093aefc09d29500704

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

<<<<<<< HEAD
    //index page
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    //route from user login on index page.  find the user by name and
    //show that user's profile page.
    $app->get("/login", function() use ($app) {
        $user = User::findName($_GET['user_name']);
        return $app['twig']->render('profile.html.twig', array('user' => $user));
    });

    //route from create user on index page.  create a new user, save, and show
    //that user's profile page.
    $app->post("/create_user", function() use ($app) {
        $user = new User($_POST['user_name'], $_POST['preferred_style'], $_POST['region']);
        $user->save();
        return $app['twig']->render('profile.html.twig', array('user' => $user));
    });

    //route from user profile page.  go to profile edit page.
    $app->get("/edit_profile/{id}", function($id) use ($app) {
        $user = User::find($id);
        return $app['twig']->render('profile_edit.html.twig', array('user' => $user));
    });

    $app->patch("/user/{id}", function ($id) use ($app) {
        $user = User::find($id);
        $user->updateUserName($_POST['user_name']);
        $user->updatePreferredStyle($_POST['preferred_style']);
        $user->updateRegion($_POST['region']);
        return $app['twig']->render('profile.html.twig', array('user' => $user));
    });

    // //all beers
    // $app->get("/stores", function() use ($app) {
    // return $app['twig']->render('beers.html.twig', array('beers' => Beer::getAll()));
    // });
    //
    // //adding beer
    // $app->post("/beers", function() use ($app) {
    // $beer_name = $_POST['beer_name'];
    // $style = $_POST['style'];
    // $abv = $_POST['abv'];
    // $ibu = $_POST['ibu'];
    // $container = $_POST['container'];
    // $brewery = $_POST['brewery'];
    // $beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery);
    // $beer->save();
    // return $app['twig']->render('beers.html.twig', array('beers' => Beer::getAll()));
    // });
    //
    // //view beer
    // $app->get("/beers/{id}", function($id) use ($app) {
    // $beer = Beer::find($id);
    // return $app['twig']->render('beer.html.twig', array('beer' => $beer, 'beers' => Beer::getAll(), 'users' => $beer->getUsers(), 'all_users' => User::getAll()));
    // });

    return $app;
=======
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

>>>>>>> fdf90617ea4e3a9c5969dd093aefc09d29500704
?>
