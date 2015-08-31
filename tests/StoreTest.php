<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=growler_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();

        }

        function testGetId()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function testGetName()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals($store_name, $result);
        }

        function testSetName()
        {
            //Arrange
            $store_name = "Growler Guys";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $test_store->setStoreName("Chill N Fill");
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals("Chill N Fill", $result);
        }

        function testGetCategory()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $result = $test_store->getCategory();

            //Assert
            $this->assertEquals($category, $result);
        }

        function testSetCategory()
        {
            //Arrange
            $store_name = "Growler Guys";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $test_store->setCategory("bottle shop");
            $result = $test_store->getCategory();

            //Assert
            $this->assertEquals("bottle shop", $result);
        }

        function testGetRegion()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $result = $test_store->getRegion();

            //Assert
            $this->assertEquals($region, $result);
        }

        function testSetRegion()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $test_store->setRegion("NE Portland");
            $result = $test_store->getRegion();

            //Assert
            $this->assertEquals("NE Portland", $result);
        }

        function testGetAddress()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $result = $test_store->getAddress();

            //Assert
            $this->assertEquals($address, $result);
        }

        function testSetAddress()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);

            //Act
            $test_store->setAddress("5553 N Lombard Portland, OR 97203");
            $result = $test_store->getAddress();

            //Assert
            $this->assertEquals("5553 N Lombard Portland, OR 97203", $result);
        }

        function testSave()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function testDeleteAll()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($id, $store_name, $category, $region, $address);
            $test_store->save();

            $store_name2 = "Growler Guys";
            $id2 = 1;
            $category2 = "bottle shop";
            $region2 = "NE Portland";
            $address2 = "5553 N Lombard Portland, OR 97444";
            $test_store2 = new Store($id2, $store_name2, $category2, $region2, $address2);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }












    }

?>
