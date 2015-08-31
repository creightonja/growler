<?php
    class User {

        private $user_name;
        private $preferred_style;
        private $region
        private $id;

        function __construct($user_name, $preferred_style, $region, $id=null) {
            $this->user_name = $user_name;
            $this->preferred_style = $preferred_style;
            $this->region = $region;
            $this->id = $id;
        }

        function setUserName($new_name) {
            $this->user_name = $new_name;
        }

        function getUserName() {
            return $this->user_name;
        }

        function setPreferredStyle($preferred_style) {
            $this->preferred_style = $preferred_style;
        }

        function getPreferredStyle() {
            return $this->preferred_style;
        }

        function setRegion($region) {
            $this->region = $region;
        }

        function getRegion() {
            return $this->region;
        }

        function getId() {
            return $this->id;
        }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO users (user_name, preferred_style, region) VALUES ('{$this->getUserName()}', '{$this->getPreferredStyle()}', '{$this->getRegion()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users;");
            $users = array();
            foreach($returned_users as $user) {
                $user_name = $user['user_name'];
                $preferred_style = $user['preferred_style'];
                $region = $user['region'];
                $id = $brand['id'];
                $new_user = new User($user_name, $preferred_style, $region, $id);
                array_push($user, $new_user);
            }
            return $users;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM users;");
        }

        function updateUserName($user_name)
        {
            $GLOBALS['DB']->exec("UPDATE users SET name = '{$user_name}' WHERE id = {$this->getId()};");
            $this->setName($user_name);
        }

        function updatePreferredStyle($preferred_style)
        {
            $GLOBALS['DB']->exec("UPDATE users SET preferred_style = '{$preferred_style}' WHERE id = {$this->getId()};");
            $this->setPreferredStyle($preferred_style);
        }

        function updateRegion($region)
        {
            $GLOBALS['DB']->exec("UPDATE users SET region = '{$region}' WHERE id = {$this->getId()};");
            $this->setPreferredStyle($region);
        }

        static function find($search_id)
        {
            $found_user = null;
            $users = User::getAll();
            foreach($users as $user) {
                $brand_id = $user->getId();
                if ($user_id == $search_id) {
                    $found_user = $user;
                }
            }
            return $found_user;
        }

        function delete() {
            $GLOBALS['DB']->exec("DELETE FROM users WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE user_id = {$this->getId()};");
        }

        function addBeer($beer, $review, $date)
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

        function getStores()
        {
            $query = $GLOBALS['DB']->query("SELECT stores.* FROM
                brands JOIN brands_stores ON (brands.id = brands_stores.brand_id)
                        JOIN stores ON (brands_stores.store_id = stores.id)
                        WHERE brands.id =     {$this->getId()};");
            $stores = $query->fetchAll(PDO::FETCH_ASSOC);
            $stores_array = array();
            foreach($stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores_array, $new_store);
            }
            return $stores_array;
        }
    }
 ?>
