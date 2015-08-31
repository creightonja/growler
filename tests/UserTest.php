<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/User.php";
    require_once "src/Beer.php";
    $server = 'mysql:host=localhost;dbname=growler_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    Class UserTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            User::deleteAll();
            Beer::deleteAll();
        }

        function testGetUserName()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);

            //Act
            $result = $test_user->getUserName();

            //Assert
            $this->assertEquals($user_name, $result);
        }

        function testSetUserName()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);

            //Act
            $test_user->setUserName("Miley Cyrus");
            $result = $test_user->getUserName();

            //Assert
            $this->assertEquals("Miley Cyrus", $result);
        }

        function testGetPreferredStyle()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);

            //Act
            $result = $test_user->getPreferredStyle();

            //Assert
            $this->assertEquals($preferred_style, $result);
        }

        function testSetPreferredStyle()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);

            //Act
            $test_user->setPreferredStyle("Stout");
            $result = $test_user->getPreferredStyle();

            //Assert
            $this->assertEquals("Stout", $result);
        }
        function testGetRegion()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);

            //Act
            $result = $test_user->getRegion();

            //Assert
            $this->assertEquals($region, $result);
        }

        function testSetRegion()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);

            //Act
            $test_user->setRegion("Southeast");
            $result = $test_user->getRegion();

            //Assert
            $this->assertEquals("Southeast", $result);
        }

        function testGetId()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);

            //Act
            $result = $test_user->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function testSave()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            //Act
            $result = User::getAll();

            //Assert
            $this->assertEquals($test_user, $result[0]);
        }

        function testDeleteAll()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            $user_name2 = "Miley Cyrus";
            $preferred_style2 = "Stout";
            $region2 =  "Southeast";
            $id2 = 2;
            $test_user2 = new User($user_name2, $preferred_style2, $region2, $id2);
            $test_user2->save();

            //Act
            User::deleteAll();
            $result = User::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testUpdateUserName()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            //Act
            $test_user->updateUserName("Miley Cyrus");
            //Assert
            $this->assertEquals("Miley Cyrus", $test_user->getUserName());
        }

        function testUpdatePreferredStyle()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            //Act
            $test_user->updatePreferredStyle("Stout");
            //Assert
            $this->assertEquals("Stout", $test_user->getPreferredStyle());
        }

        function testUpdateRegion()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            //Act
            $test_user->updateRegion("Southeast");
            //Assert
            $this->assertEquals("Southeast", $test_user->getRegion());
        }

        function testFind()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            $user_name2 = "Miley Cyrus";
            $preferred_style2 = "Stout";
            $region2 =  "Southeast";
            $id2 = 2;
            $test_user2 = new User($user_name2, $preferred_style2, $region2, $id2);
            $test_user2->save();

            //Act
            $result = User::find($test_user2->getId());

            //Assert
            $this->assertEquals($test_user2, $result);
        }

        function testAddBeer()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            $id = 1;
            $beer_name = "Fat Tire";
            $style = "Belgian";
            $abv = 6.12;
            $ibu = 40;
            $container = "Bottle";
            $brewery = "New Belgium";
            $test_beer = new Beer($id, $beer_name, $style, $abv, $ibu, $container, $brewery);
            $test_beer->save();

            //Act
            $test_user->addBeer($test_beer);

            //Assert
            $this->assertEquals($test_beer->getUsers(),[$test_user]);
        }

        function testGetBeers()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            $id = 1;
            $beer_name = "Fat Tire";
            $style = "Belgian";
            $abv = 6.12;
            $ibu = 40;
            $container = "Bottle";
            $brewery = "New Belgium";
            $test_beer = new Beer($id, $beer_name, $style, $abv, $ibu, $container, $brewery);
            $test_beer->save();

            $id2 = 2;
            $beer_name2 = "60 Minute IPA";
            $style2 = "IPA";
            $abv2 = 7.01;
            $ibu2 = 75;
            $container2 = "Growler";
            $brewery2 = "Dogfish Head";
            $test_beer2 = new Beer($id2, $beer_name2, $style2, $abv2, $ibu2, $container2, $brewery2);
            $test_beer2->save();

            //Act
            $test_user->addBeer($test_beer);
            $test_user->addBeer($test_beer2);
            $result = $test_user->getBeers();
            //Assert
            $this->assertEquals([$test_beer, $test_beer2], $result);
        }

        function testDelete()
        {
            //Arrange
            $user_name = "Barack Obama";
            $preferred_style = "IPA";
            $region =  "Northwest";
            $id = 1;
            $test_user = new User($user_name, $preferred_style, $region, $id);
            $test_user->save();

            $id = 1;
            $beer_name = "Fat Tire";
            $style = "Belgian";
            $abv = 6.12;
            $ibu = 40;
            $container = "Bottle";
            $brewery = "New Belgium";
            $test_beer = new Beer($id, $beer_name, $style, $abv, $ibu, $container, $brewery);
            $test_beer->save();

            //Act
            $test_user->addBeer($test_beer);
            $test_user->delete();

            //Assert
            $this->assertEquals([], $test_beer->getUsers());
        }
    }
?>
