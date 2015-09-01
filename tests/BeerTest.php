 <?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Beer.php";

    $server = 'mysql:host=localhost; dbname=growler_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BeerTest extends PHPUnit_Framework_TestCase
    {

         protected function tearDown()
        {
            Beer::deleteAll();
            User::deleteAll();
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

        function testAddUser()
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
            $preffered_style = "IPA";
            $region = "NW";
            $id2 = 2;
            $test_user = new User($user_name, $preffered_style, $region,  $id2);
            $test_user->save();

            //Act
            $test_beer->addUser($test_user);

            //Assert
            $this->assertEquals($test_beer->getUsers(), [$test_user]);
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
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            $user_name = "Wings";
            $preffered_style = "IPA";
            $region = "NW";
            $id2 = 2;
            $test_user = new User($user_name, $preffered_style, $region,  $id2);
            $test_user->save();


            $user_name2 = "Wings2";
            $preffered_style2 = "IPA2";
            $region2 = "NW2";
            $id3 = 3;
            $test_user2 = new User($user_name2, $preffered_style2, $region2,  $id3);
            $test_user2->save();


            //Act
            $test_beer->addUser($test_user);
            $test_beer->addUser($test_user2);

            //Assert
            $this->assertEquals($test_beer->getUsers(), [$test_user, $test_user2]);
        }

        // function testDelete()
        // {
        //     //Arrange
        //     $beer_name = "Your mom";
        //     $style = "IPA";
        //     $abv = 4;
        //     $ibu = 6;
        //     $container = "bottle";
        //     $brewery = "daddy";
        //     $id = 1;
        //     $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
        //     $test_beer->save();
        //
        //     $user_name = "Wings";
        //     $preffered_style = "IPA";
        //     $region = "NW";
        //     $id2 = 2;
        //     $test_user = new User($user_name, $preffered_style, $region,  $id2);
        //     $test_user->save();
        //
        //     //Act
        //     $test_beer->addUser($test_user);
        //     $test_beer->delete();
        //
        //     //Assert
        //     $this->assertEquals([], $test_user->getBeers());
        // }


    }

?>
