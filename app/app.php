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
        $reviews = Review::find("user_id", $user[0]->getId());
        $new_beers = User::findBeerStyle($user[0]->getId(), $user[0]->getPreferredStyle());
        $local_stores = Store::find("region",$user[0]->getRegion());
        return $app['twig']->render('profile.html.twig', array('user' => $user[0], 'reviews' => $reviews, 'new_beers' => $new_beers, 'local_stores' => $local_stores));
    });

    //from index
    //create and save new user
    //show profile
    $app->post("/create_user", function() use ($app) {
        $user = new User($_POST['user_name'], $_POST['preferred_style'], $_POST['region']);
        $user->save();
        $reviews = Review::find("user_id", $user->getId());
        $new_beers = User::findBeerStyle($user->getId(), $user->getPreferredStyle());
        $local_stores = Store::find("region",$user->getRegion());
        return $app['twig']->render('profile.html.twig', array('user' => $user, 'reviews' => $reviews, 'new_beers' => $new_beers, 'local_stores' => $local_stores));
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
        $user[0]->updateUserName($_POST['user_name']);
        $user[0]->updatePreferredStyle($_POST['preferred_style']);
        $user[0]->updateRegion($_POST['region']);
        $reviews = Review::find("user_id", $user[0]->getId());
        $new_beers = User::findBeerStyle($user[0]->getId(), $user[0]->getPreferredStyle());
        $local_stores = Store::find("region",$user[0]->getRegion());
        return $app['twig']->render('profile.html.twig', array('user' => $user[0], 'reviews' => $reviews, 'new_beers' => $new_beers, 'local_stores' => $local_stores));
    });


//------------------------------- Begin Beer Functionality -----------------------------------

    //from beers
    //add and save new beer
    //show all beers
    $app->post("/{user_id}/beers", function($user_id) use ($app) {
        $beer = new Beer($_POST['beer_name'], $_POST['style'], $_POST['abv'], $_POST['ibu'], $_POST['container'], $_POST['brewery'], $_POST['image']);
        $beer->save();
        $user = User::find("id", $user_id);
        return $app['twig']->render('beers.html.twig', array('all_beers' => Beer::getAll(), 'user' => $user[0]));
    });

    //from profile
    //show all beers
    $app->get("/{user_id}/beers", function($user_id) use ($app) {
        $user = User::find("id", $user_id);
        return $app['twig']->render('beers.html.twig', array('all_beers' => Beer::getAll(), 'user' => $user[0]));
    });

    //from beer
    //add store to beer
    //show updated beer
    $app->post("/{user_id}/beer/{beer_id}", function($user_id, $beer_id) use ($app) {
        $beer = Beer::find("id", $beer_id);
        $beer[0]->addStore($_POST['store_id']);
        $reviews = Review::find("beer_id",$beer[0]->getId());
        $user = User::find("id", $user_id);
        return $app['twig']->render('beer.html.twig', array('beer' => $beer[0], 'beers' => Beer::getAll(), 'users' => $beer[0]->getUsers(), 'all_users' => User::getAll(), 'stores'=> $beer[0]->getStores(), 'user'=> User::find("id", $user_id)[0], 'all_stores' => Store::getAll(), 'reviews' => $reviews));
    });

    //from beer
    //add beer to user
    //show review
    $app->post("/{user_id}/drank_beer/{beer_id}", function ($user_id, $beer_id) use ($app) {
        $user = User::find("id", $user_id);
        $user[0]->addBeer($beer_id);
        $reviews = Review::find("user_id", $user[0]->getId());
        $new_beers = User::findBeerStyle($user[0]->getId(), $user[0]->getPreferredStyle());
        $local_stores = Store::find("region",$user[0]->getRegion());
        return $app['twig']->render('profile.html.twig', array('user' => $user[0], 'reviews' => $reviews, 'new_beers' => $new_beers, 'local_stores' => $local_stores));
      });

    //from beers
    //display single beer
    //shows beer
    $app->get("/{user_id}/beer/{beer_id}", function($user_id, $beer_id) use ($app) {
        $beer = Beer::find("id", $beer_id);
        $user = User::find("id", $user_id);
        $stores = $beer[0]->getStores();
        $reviews = Review::find("beer_id",$beer[0]->getId());
        return $app['twig']->render('beer.html.twig', array('beer' => $beer[0], 'beers' => Beer::getAll(), 'users' => $beer[0]->getUsers(), 'all_users' => User::getAll(), 'stores'=> $beer[0]->getStores(), 'user'=> $user[0], 'all_stores' => Store::getAll(), 'reviews' => $reviews));
    });

    //from beer/{id}
    //edit beer name and style etc.
    //shows beer_edit
    $app->get("/{user_id}/beer/{id}/edit", function($user_id, $id) use($app) {
        $beer = Beer::find("id", $id);
        $user = User::find("id", $user_id);
        return $app['twig']->render('beer_edit.html.twig', array('beer' => $beer[0], 'user' => $user[0]));
    });

    //from beer/{id}/edit
    //update beer name style etc.
    //shows beer/{id}
    $app->patch("/{user_id}/beer/{id}", function($user_id, $id) use ($app) {
        $beer = Beer::find("id", $id);
        $user = User::find("id", $user_id);
        $beer->update($_POST['beer_name'], $_POST['style'], $_POST['abv'], $_POST['ibu'], $_POST['container'], $_POST['brewery'], $_POST['image']);
        return $app['twig']->render('beer_edit.html.twig', array('beer' => $beer[0], 'user' => $user[0]));
    });

    //From /{userId}/beers
    //Beer search function
    //Finds matching search beers
    $app->post("/{user_id}/search_beer", function($user_id) use ($app) {
        $search_beer = Beer::find($_POST['search_field'], $_POST['search_term']);
        $user = User::find("id", $user_id);
        return $app['twig']->render('beer_search.html.twig', array('search_beer' => $search_beer, 'user' => $user[0]));
    });

//--------------------------------------------- Begin Store Functionality ----------------------------------------

    //from profile
    //show all stores
    $app->get("/{user_id}/stores", function($user_id) use ($app) {
        $user = User::find("id", $user_id);
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'user' => $user[0]));
    });

    //
    $app->get("/{user_id}/search_store", function($user_id) use ($app) {
        $search_store = Store::find($_GET['search_field'], $_GET['search_term']);
        $user = User::find("id", $user_id);
        return $app['twig']->render('store_search.html.twig', array('search_store' => $search_store, 'user' => $user[0]));
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
        $store = Store::find("id", $store_id);
        $beer = Beer::find("id", $_POST['beer_id']);
        $store[0]->addBeer($beer[0]->getId());
        $user = User::find("id", $user_id);
        return $app['twig']->render('store.html.twig', array('store' => $store[0], 'user' => $user[0], 'beers' => $store[0]->getBeers(), 'all_beers' => Beer::getAll()));
    });

    //--------------------------------------------- Begin Review Functionality ----------------------------------------

    $app->get("/{user_id}/review/{beer_id}", function ($user_id,$beer_id) use($app) {
        $user = User::find("id", $user_id);
        $beer = Beer::find("id", $beer_id);
        return $app['twig']->render('review.html.twig',array('user' => $user[0], 'beer' => $beer[0]));
    });


    $app->post("/{user_id}/review/{beer_id}", function ($user_id, $beer_id) use ($app) {
        $user = User::find("id", $user_id);
        $review = Review::findReview($beer_id, $user_id);
        $review[0]->update($_POST['beer_review'], $_POST['review_date']);
        $reviews = Review::find("user_id", $user[0]->getId());
        $new_beers = User::findBeerStyle($user[0]->getId(), $user[0]->getPreferredStyle());
        $local_stores = Store::find("region",$user[0]->getRegion());
        return $app['twig']->render('profile.html.twig', array('user' => $user[0], 'reviews' => $reviews, 'new_beers' => $new_beers, 'local_stores' => $local_stores));
      });


    return $app;  //End of app, do not code below here
?>
