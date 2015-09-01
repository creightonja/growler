 <?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Beer.php";
    require_once "src/User.php";
    require_once "src/Store.php";
    require_once "src/Review.php";

    $server = 'mysql:host=localhost; dbname=growler_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BeerTest extends PHPUnit_Framework_TestCase
    {

         protected function tearDown()
        {
            Beer::deleteAll();
            Store::deleteAll();
        }

        function test_save()
        {
            //arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);

            //act
            $test_beer->save();

            //assert
            $result = Beer::getAll();
            $this->assertEquals($test_beer, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery);
            $test_beer->save();

            $beer_name2 = "Your mom2";
            $style2 = "IPA2";
            $abv2 = 12;
            $ibu2 = 7;
            $container2 = "bottle2";
            $brewery2 = "daddy2";
            $test_beer2 = new Beer($beer_name2, $style2, $abv2, $ibu2, $container2, $brewery2);
            $test_beer2->save();

            //act
            $result = Beer::getAll();

            //assert
            $this->assertEquals([$test_beer, $test_beer2], $result);
        }

        function test_deleteAll()
        {
            //arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery);
            $test_beer->save();

            $beer_name2 = "Your mom2";
            $style2 = "IPA2";
            $abv2 = 12;
            $ibu2 = 7;
            $container2 = "bottle2";
            $brewery2 = "daddy2";
            $test_beer2 = new Beer($beer_name2, $style2, $abv2, $ibu2, $container2, $brewery2);
            $test_beer2->save();

            //Act
            Beer::deleteAll();

            //Assert
            $result = Beer::getAll();
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            //Arrange
             $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            $beer_name2 = "Your mom2";
            $style2 = "IPA2";
            $abv2 = 12;
            $ibu2 = 7;
            $container2 = "bottle2";
            $brewery2 = "daddy2";
            $id2 = 2;
            $test_beer2 = new Beer($beer_name2, $style2, $abv2, $ibu2, $container2, $brewery2, $id2);
            $test_beer2->save();

            //Act
            $id = $test_beer->getId();
            $result = Beer::find($id);

            //Assert
            $this->assertEquals($test_beer, $result);
        }


        function testUpdate()
        {
            //Arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            $new_beer_name = "Lame";
            $new_style = "IPO";
            $new_abv = 5;
            $new_ibu = 7;
            $new_container = "pitcher";
            $new_brewery = "fullsail";

            //Act
            $test_beer->update($new_beer_name, $new_style, $new_abv, $new_ibu, $new_container, $new_brewery);

            //Assert
            $this->assertEquals("Lame", $test_beer->getBeer_Name());
            $this->assertEquals("IPO", $test_beer->getStyle());
            $this->assertEquals(5, $test_beer->getAbv());
            $this->assertEquals(7, $test_beer->getIbu());
            $this->assertEquals("pitcher", $test_beer->getContainer());
            $this->assertEquals("fullsail", $test_beer->getBrewery());
        }


        function testAddUser()
        {
            //Arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4.00;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            $user_name = "Bob";
            $preferred_style = "IPA";
            $region = "NW";
            $test_user = new User($user_name, $preferred_style, $region);
            $test_user->save();
            $test_user_id = $test_user->getId();


            //Act
            $test_beer->addUser($test_user_id);
            $result = $test_user->getBeers();

            //Assert
            $this->assertEquals([$test_beer], $result);
        }


        function testAddStore()
        {
            //Arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();


            $store_name = "M&M";
            $id = 1;
            $category = "Black Market";
            $region = "unknown";
            $address = "SW";
            $test_store = new Store($store_name, $category, $region, $address, $id);
            $test_store->save();
            $test_store_id = $test_store->getId();

            //Act
            $test_beer->addStore($test_store_id);
            $result = $test_beer->getStores();


            //Assert
            $this->assertEquals([$test_store], $result);
        }


        function testGetStores()
        {
            //Arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            $store_name = "M&M";
            $category = "Black Market";
            $region = "unknown";
            $address = "SW";
            $id2 = 2;
            $test_store = new Store($store_name, $category, $region, $address);
            $test_store->save();


            $store_name2 = "M&M2";
            $category2 = "Black Market2";
            $region2 = "unknown2";
            $address2 = "SW2";
            $id3 = 3;
            $test_store2 = new Store($store_name2, $category2, $region2, $address2);
            $test_store2->save();

            //Act
            $test_beer->addStore($test_store->getId());
            $test_beer->addStore($test_store2->getId());

            $result = $test_beer->getStores();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testGetUsers()
        {
            //Arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery);
            $test_beer->save();

            $user_name = "Wings";
            $preferred_style = "IPA";
            $region = "NW";
            $id2 = 2;
            $test_user = new User($user_name, $preferred_style, $region);
            $test_user->save();

            $user_name2 = "Wings";
            $preferred_style2 = "IPA2";
            $region2 = "NW2";
            $id3 = 3;
            $test_user2 = new User($user_name2, $preferred_style2, $region2);
            $test_user2->save();



            //Act
            $test_beer->addUser($test_user->getId());
            $test_beer->addUser($test_user2->getId());

            //Assert
            $this->assertEquals([$test_user, $test_user2], $test_beer->getUsers());
        }


        function testDelete()
        {
            //Arrange
            $beer_name = "Your mom";
            $style = "IPA";
            $abv = 4;
            $ibu = 6;
            $container = "bottle";
            $brewery = "daddy";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            $user_name = "Wings";
            $preferred_style = "IPA";
            $region = "NW";
            $id2 = 2;
            $test_user = new User($user_name, $preferred_style, $region,  $id2);
            $test_user->save();

            //Act
            $test_beer->addUser($test_user->getId());
            $test_beer->delete();


            //Assert
            $this->assertEquals([], $test_user->getBeers());
        }


    }

?>
