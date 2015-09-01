<?php

    class Store {

        private $store_name;
        private $category;
        private $region;
        private $address;
        private $id;

        function __construct($store_name, $category, $region, $address, $id = null) {

            $this->store_name = $store_name;
            $this->category = $category;
            $this->region = $region;
            $this->address = $address;
            $this->id = $id;

        }

        function setStoreName($new_store_name) {
            $this->store_name = $new_store_name;
        }

        function setCategory($new_category) {
            $this->category = $new_category;
        }

        function setRegion($new_region) {
            $this->region = $new_region;
        }

        function setAddress($new_address) {
            $this->address = $new_address;
        }

        function getStoreName() {
            return $this->store_name;
        }

        function getCategory() {
            return $this->category;
        }

        function getRegion() {
            return $this->region;
        }

        function getAddress() {
            return $this->address;
        }

        function getId() {
            return $this->id;
        }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name, category, region, address) VALUES ('{$this->getStoreName()}', '{$this->getCategory()}', '{$this->getRegion()}', '{$this->getAddress()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $category = $store['category'];
                $region = $store['region'];
                $address = $store['address'];
                $new_store = new Store($store_name, $category, $region, $address, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        function update($new_store_name, $new_category, $new_region, $new_address)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store_name}' WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("UPDATE stores SET category = '{$new_category}' WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("UPDATE stores SET region = '{$new_region}' WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("UPDATE stores SET address = '{$new_address}' WHERE id = {$this->getId()};");
            $this->setStoreName($new_store_name);
            $this->setCategory($new_category);
            $this->setRegion($new_region);
            $this->setAddress($new_address);
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        function addBeer($beer)
        {
            $GLOBALS['DB']->exec("INSERT INTO beers_stores (beer_id, store_id) VALUES ({$beer->getId()}, {$this->getId()});");
        }

        function getBeers()
        {
            $query = $GLOBALS['DB']->query("SELECT beers.* FROM stores
                JOIN beers_stores ON (stores.id = beers_stores.store_id)
                JOIN beers ON (beers_stores.beer_id = beers.id)
                WHERE stores.id =     {$this->getId()};");
            $beers = $query->fetchAll(PDO::FETCH_ASSOC);
            $beers_array = array();

            foreach($beers as $beer) {
                $beer_name = $beer['beer_name'];
                $id = $beer['id'];
                $style = $beer['style'];
                $abv = $beer['abv'];
                $ibu = $beer['ibu'];
                $container = $beer['container'];
                $brewery = $beer['brewery'];
                $new_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
                array_push($beers_array, $new_beer);
            }
            return $beers_array;
        }

        function delete() {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM beers_stores WHERE beer_id = {$this->getId()};");
        }
    }
?>
