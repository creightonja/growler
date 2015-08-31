<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/User.php";
    //require_once "src/Store.php";
    $server = 'mysql:host=localhost;dbname=growler_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    Class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            User::deleteAll();
            //Store::deleteAll();
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

        // function testUpdate()
        // {
        //     //Arrange
        //     $name = "Nike";
        //     $id = 1;
        //     $test_brand = new Brand($name, $id);
        //     $test_brand->save();
        //     $new_name = "Reebok";
        //     //Act
        //     $test_brand->update($new_name);
        //     //Assert
        //     $this->assertEquals("Reebok", $test_brand->getName());
        // }
        // function testFind()
        // {
        //     //Arrange
        //     $name = "Nike";
        //     $id = 1;
        //     $test_brand = new Brand($name, $id);
        //     $test_brand->save();
        //     $name2 = "Reebok";
        //     $id2 = 2;
        //     $test_brand2 = new Brand($name2, $id2);
        //     $test_brand2->save();
        //     //Act
        //     $result = Brand::find($test_brand2->getId());
        //     //Assert
        //     $this->assertEquals($test_brand2, $result);
        // }
        // function testAddStore()
        // {
        //     //Arrange
        //     $name = "Nike";
        //     $id = 1;
        //     $test_brand = new Brand($name, $id);
        //     $test_brand->save();
        //     $name = "Foot Locker";
        //     $id = 1;
        //     $test_store = new Store($name, $id);
        //     $test_store->save();
        //     //Act
        //     $test_brand->addStore($test_store);
        //     //Assert
        //     $this->assertEquals($test_brand->getStores(),[$test_store]);
        // }
        // function testGetStores()
        // {
        //     //Arrange
        //     $name = "Nike";
        //     $id = 1;
        //     $test_brand = new Brand($name, $id);
        //     $test_brand->save();
        //     $name = "Foot Locker";
        //     $id = 1;
        //     $test_store = new Store($name, $id);
        //     $test_store->save();
        //     $name2 = "Payless";
        //     $id2 = 2;
        //     $test_store2 = new Store($name2, $id2);
        //     $test_store2->save();
        //     //Act
        //     $test_brand->addStore($test_store);
        //     $test_brand->addStore($test_store2);
        //     $result = $test_brand->getStores();
        //     //Assert
        //     $this->assertEquals([$test_store, $test_store2], $result);
        // }
        // function testDelete()
        // {
        //     //Arrange
        //     $name = "Nike";
        //     $id = 1;
        //     $test_brand = new Brand($name, $id);
        //     $test_brand->save();
        //     $name = "Foot Locker";
        //     $id = 1;
        //     $test_store = new Store($name, $id);
        //     $test_store->save();
        //     //Act
        //     $test_brand->addStore($test_store);
        //     $test_brand->delete();
        //     //Assert
        //     $this->assertEquals([], $test_store->getBrands());
        // }
    }
?>
