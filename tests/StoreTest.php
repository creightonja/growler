<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Beer.php";

    $server = 'mysql:host=localhost;dbname=growler_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Beer::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);

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
            $test_store = new Store($store_name, $category, $region, $address, $id);
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
            $test_store = new Store($store_name, $category, $region, $address, $id);
            $test_store->save();

            $store_name2 = "Growler Guys";
            $id2 = 1;
            $category2 = "bottle shop";
            $region2 = "NE Portland";
            $address2 = "5553 N Lombard Portland, OR 97444";
            $test_store2 = new Store($store_name2, $category2, $region2, $address2, $id2);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($store_name, $category, $region, $address, $id);
            $test_store->save();

            $new_store_name = "Fill N Chill";
            $new_category = "bottleshop";
            $new_region = "SW Portland";
            $new_address = "5215 N Chautauqua Blvd Portland, OR 97203";

            //Act
            $test_store->update($new_store_name, $new_category, $new_region, $new_address);

            //Assert
            $this->assertEquals("Fill N Chill", $test_store->getStoreName());
            $this->assertEquals("bottleshop", $test_store->getCategory());
            $this->assertEquals("SW Portland", $test_store->getRegion());
            $this->assertEquals("5215 N Chautauqua Blvd Portland, OR 97203", $test_store->getAddress());
        }

        function testFind()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($store_name, $category, $region, $address, $id);
            $test_store->save();

            $store_name2 = "Growler Guys";
            $id2 = 1;
            $category2 = "bottle shop";
            $region2 = "NE Portland";
            $address2 = "5553 N Lombard Portland, OR 97444";
            $test_store2 = new Store($store_name2, $category2, $region2, $address2, $id2);
            $test_store2->save();

            //Act
            $result = Store::find($test_store2->getId());

            //Assert
            $this->assertEquals($test_store2, $result);
        }

        function testAddBeer()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($store_name, $category, $region, $address, $id);
            $test_store->save();


            $beer_name = "Bike Beer";
            $style = "Kolsch";
            $abv = 5.6;
            $ibu = 50;
            $container = "Growler";
            $brewery = "Hopworks";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            //Act
            $test_store->addBeer($test_beer);

            //Assert
            $this->assertEquals($test_store->getBeers(),[$test_beer]);

        }

        function testGetBeers()
        {
            //Arrange
            $store_name = "Chill N Fill";
            $id = 1;
            $category = "bar";
            $region = "North Portland";
            $address = "5215 N Lombard Portland, OR 97203";
            $test_store = new Store($store_name, $category, $region, $address, $id);
            $test_store->save();


            $beer_name = "Bike Beer";
            $style = "Kolsch";
            $abv = 5.6;
            $ibu = 50;
            $container = "Growler";
            $brewery = "Hopworks";
            $id = 1;
            $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
            $test_beer->save();

            $beer_name2 = "Jamaica Sunrise";
            $style2 = "ESB";
            $abv2 = 5.4;
            $ibu2 = 40;
            $container2 = "Bottle";
            $brewery2 = "Mad River";
            $id2 = 1;
            $test_beer2 = new Beer($beer_name2, $style2, $abv2, $ibu2, $container2, $brewery2, $id2);
            $test_beer2->save();

            //Act
            $test_store->addBeer($test_beer);
            $test_store->addBeer($test_beer2);

            $result = $test_store->getBeers();

            //Assert
            $this->assertEquals([$test_beer, $test_beer2], $result);
        }


        //testDelete will not work untill Beer.php has getStores() added.
        // function testDelete()
        // {
        //     //Arrange
        //     $store_name = "Chill N Fill";
        //     $id = 1;
        //     $category = "bar";
        //     $region = "North Portland";
        //     $address = "5215 N Lombard Portland, OR 97203";
        //     $test_store = new Store($id, $store_name, $category, $region, $address);
        //     $test_store->save();
        //
        //
        //     $beer_name = "Bike Beer";
        //     $style = "Kolsch";
        //     $abv = 5.6;
        //     $ibu = 50;
        //     $container = "Growler";
        //     $brewery = "Hopworks";
        //     $id = 1;
        //     $test_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
        //     $test_beer->save();
        //
        //     //Act
        //     $test_store->addBeer($test_beer);
        //     $test_store->delete();
        //
        //     //Assert
        //     $this->assertEquals([], $test_beer->getStores());
        //
        // }
    }

?>
