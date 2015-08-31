<?php

    class Store {

        private $id;
        private $store_name;
        private $category;
        private $region;
        private $address;

        function __construct($id = null, $store_name, $category, $region, $address) {

            $this->store_name = $store_name;
            $this->id = $id;
            $this->category = $category;
            $this->region = $region;
            $this->address = $address;

        }

        function getId() {
            return $this->id;
        }

        function setStoreName($new_store_name) {
            $this->store_name = $new_store_name;
        }

        function getStoreName() {
            return $this->store_name;
        }

        function setCategory($new_category) {
            $this->category = $new_category;
        }

        function getCategory() {
            return $this->category;
        }

        function setRegion($new_region) {
            $this->region = $new_region;
        }

        function getRegion() {
            return $this->region;
        }

        function setAddress($new_address) {
            $this->address = $new_address;
        }

        function getAddress() {
            return $this->address;
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
                $new_store = new Store($id, $store_name, $category, $region, $address);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        // function update($new_name)
        // {
        //     $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
        //     $this->setName($new_name);
        // }
        //
        // static function find($search_id)
        // {
        //     $found_store = null;
        //     $stores = Store::getAll();
        //     foreach($stores as $store) {
        //         $store_id = $store->getId();
        //         if ($store_id == $search_id) {
        //             $found_store = $store;
        //         }
        //     }
        //     return $found_store;
        // }
        //
        // function addBrand($brand)
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
        // }
        //
        // function getBrands()
        // {
        //     $query = $GLOBALS['DB']->query("SELECT brands.* FROM stores
        //         JOIN stores_brands ON (stores.id = stores_brands.store_id)
        //         JOIN brands ON (stores_brands.brand_id = brands.id)
        //         WHERE stores.id =     {$this->getId()};");
        //     $brands = $query->fetchAll(PDO::FETCH_ASSOC);
        //     $brands_array = array();
        //
        //     foreach($brands as $brand) {
        //         $name = $brand['name'];
        //         $id = $brand['id'];
        //         $new_brand = new Brand($name, $id);
        //         array_push($brands_array, $new_brand);
        //     }
        //     return $brands_array;
        // }
        //
        // function delete() {
        //     $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        //     $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->getId()};");
        // }



    }
?>
