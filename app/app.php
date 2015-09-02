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

    //index page
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });


//---------------------------- Begin User Functionality -------------------------------------

    //from index
    //find user (login)
    //show profile
    $app->get("/profile", function() use ($app) {
        $user = User::find("user_name", $_GET['user_name']);
        return $app['twig']->render('profile.html.twig', array('user' => $user[0]));
    });

    //from index
    //create and save new user
    //show profile
    $app->post("/create_user", function() use ($app) {
        $user = new User($_POST['user_name'], $_POST['preferred_style'], $_POST['region']);
        $user->save();
        return $app['twig']->render('profile.html.twig', array('user' => $user));
    });

    //from profile
    //find user
    //show profile_edit
    $app->get("/{user_id}/edit_profile", function($user_id) use ($app) {
        $user = User::find("id", $user_id);
        return $app['twig']->render('profile_edit.html.twig', array('user' => $user[0]));
    });

    //from profile_edit
    //update profile fields
    //show profile
    $app->patch("/{user_id}/user", function ($user_id) use ($app) {
        $user = User::find("id", $user_id);
        $user->updateUserName($_POST['user_name']);
        $user->updatePreferredStyle($_POST['preferred_style']);
        $user->updateRegion($_POST['region']);
        return $app['twig']->render('profile.html.twig', array('user' => $user[0]));
    });


//------------------------------- Begin Beer Functionality -----------------------------------

    //from beers
    //add and save new beer
    //show all beers
    $app->post("/{user_id}/beers", function($user_id) use ($app) {
        $beer = new Beer($_POST['beer_name'], $_POST['style'], $_POST['abv'], $_POST['ibu'], $_POST['container'], $_POST['brewery']);
        $beer->save();
        $user = User::find("id", $user_Id);
        return $app['twig']->render('beers.html.twig', array('all_beers' => Beer::getAll(), 'user' => $user[0]));
    });

    //from profile
    //show all beers
    $app->get("/{user_id}/beers", function($user_id) use ($app) {
        $user = User::find("id", $user_id);
        return $app['twig']->render('beers.html.twig', array('all_beers' => Beer::getAll(), 'user' => $user[0]));
    });

    //from beers
    //display single beer
    //shows beer
    $app->get("/beer/{id}", function($id) use ($app) {
        $beer = Beer::find("id", $id);
        $stores = $beer[0]->getStores();
        return $app['twig']->render('beer.html.twig', array('beer' => $beer[0], 'beers' => Beer::getAll(), 'users' => $beer[0]->getUsers(), 'all_users' => User::getAll(), 'stores'=> $stores));
    });

    //from beer/{id}
    //edit beer name and style etc.
    //shows beer_edit
    $app->get("/beer/{id}/edit", function($id) use($app) {
        $beer = Beer::find("id", $id);
        return $app['twig']->render('beer_edit.html.twig', array('beer' => $beer[0]));
    });

    //from beer/{id}/edit
    //update beer name style etc.
    //shows beer/{id}
    $app->patch("/beer/{id}", function($id) use ($app) {
        $beer = Beer::find("id", $id);
        $beer->update($_POST['beer_name'], $_POST['style'], $_POST['abv'], $_POST['ibu'], $_POST['container'], $_POST['brewery']);
        return $app['twig']->render('beer_edit.html.twig', array('beer' => $beer[0]));
    });

//--------------------------------------------- Begin Store Functionality ----------------------------------------

    //from profile
    //show all stores
    $app->get("/{user_id}/stores", function($user_id) use ($app) {
        $user = User::find("id", $user_id);
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'user' => $user[0]));
    });

    //from stores
    //add and save new store
    //show all stores
    $app->post("/{user_id}/stores", function($user_id) use ($app) {
        $store = new Store($_POST['store_name'], $_POST['category'], $_POST['region'], $_POST['address']);
        $store->save();
        $user = User::find("id", $user_id);
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'user' => $user[0]));
    });

    //from stores
    //find store
    //show store
    $app->get("/{user_id}/store/{store_id}", function ($user_id, $store_id) use ($app) {
        $user = User::find("id", $user_id);
        $store = Store::find("id", $store_id);
        return $app['twig']->render('store.html.twig', array('store' => $store[0], 'user' => $user[0], 'beers' => $store[0]->getBeers(), 'all_beers' => Beer::getAll()));
    });

    //from store
    //add beer to store
    //show store
    $app->post("/{user_id}/store/{store_id}", function ($user_id, $store_id) use ($app) {
        $store = Store::find($store_id);
        $beer = Beer::find($_POST['beer_id']);
        $store->addBeer($beer);
        $user = User::find("id", $user_id);
        $store = Store::find("store", $store_id);
        return $app['twig']->render('store.html.twig', array('store' => Store::find($store_id), 'user' => $user[0], 'beers' => $store[0]->getBeers()->getBeers(), 'all_beers' => Beer::getAll()));
    });




    return $app;  //End of app, do not code below here
?>
