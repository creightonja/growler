<?php
    class User {

        private $user_name;
        private $preferred_style;
        private $region;
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
            $GLOBALS['DB']->exec("INSERT INTO users (user_name, preferred_style, region) VALUES ('{$this->getUserName()}',
                            '{$this->getPreferredStyle()}', '{$this->getRegion()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users;");
            $users = array();
            foreach($returned_users as $user) {
                $user_name = $user['user_name'];
                $preferred_style = $user['preferred_style'];
                $region = $user['region'];
                $id = $user['id'];
                $new_user = new User($user_name, $preferred_style, $region, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM users;");
        }

        function updateUserName($user_name)
        {
            $GLOBALS['DB']->exec("UPDATE users SET user_name = '{$user_name}' WHERE id = {$this->getId()};");
            $this->setUserName($user_name);
        }

        function updatePreferredStyle($preferred_style)
        {
            $GLOBALS['DB']->exec("UPDATE users SET preferred_style = '{$preferred_style}' WHERE id = {$this->getId()};");
            $this->setPreferredStyle($preferred_style);
        }

        function updateRegion($region)
        {
            $GLOBALS['DB']->exec("UPDATE users SET region = '{$region}' WHERE id = {$this->getId()};");
            $this->setRegion($region);
        }

        //Searching user table with column_id as a variable
        static function find($column_id, $search_id) {
            //$column_id is what column to search, example user_id etc
            //if $search_id is an ID or review_date, it will be a string, else it will be an int
            if (is_string($search_id)) {
                $search_users = $GLOBALS['DB']->query("SELECT * FROM users WHERE {$column_id} = '{$search_id}'");
            }
            else {
                $search_users = $GLOBALS['DB']->query("SELECT * FROM users WHERE {$column_id} = {$search_id}");
            }
            $returned_users = $search_users->fetchAll(PDO::FETCH_ASSOC);
            $users = array();
            foreach($returned_users as $user) {
                $user_name = $user['user_name'];
                $preferred_style = $user['preferred_style'];
                $region = $user['region'];
                $id = $user['id'];
                $new_user = new User($user_name, $preferred_style, $region, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        function delete() {
            $GLOBALS['DB']->exec("DELETE FROM users WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE user_id = {$this->getId()};");
        }

        function addBeer($beer)
        {
            $user_id = $this->getId();
            if (Review::findReview($beer, $user_id) == false ) {
                $GLOBALS['DB']->exec("INSERT INTO reviews (beer_id, user_id) VALUES ({$beer}, {$this->getId()});");
            }
        }

        function getBeers()
        {
            $query = $GLOBALS['DB']->query("SELECT beers.* FROM
                users JOIN reviews ON (users.id = reviews.user_id)
                        JOIN beers ON (reviews.beer_id = beers.id)
                        WHERE users.id = {$this->getId()};");
            $beers = $query->fetchAll(PDO::FETCH_ASSOC);
            $beers_array = array();
            foreach($beers as $beer) {
                $id = $beer['id'];
                $beer_name = $beer['beer_name'];
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

        static function findBeerStyle($user_id, $preferred_style){
            $query = $GLOBALS['DB']->query("SELECT * FROM beers WHERE style = '{$preferred_style}' AND
                                beers.id NOT IN (SELECT beer_id FROM reviews WHERE user_id = {$user_id});");
            $beers = $query->fetchAll(PDO::FETCH_ASSOC);
            $beers_array = array();
            foreach($beers as $beer) {
                $id = $beer['id'];
                $beer_name = $beer['beer_name'];
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
    }
 ?>
