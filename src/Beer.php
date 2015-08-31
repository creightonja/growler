<?php

    class Beer {

        private $beer_name;
        private $style;
        private $abv;
        private $ibu;
        private $container;
        private $brewery;
        private $id;

      function __construct($beer_name, $style, $abv, $ibu, $container, $brewery, $id = null )
      {
          $this->beer_name = $beer_name;
          $this->style = $style;
          $this->abv = $abv;
          $this->ibu = $ibu;
          $this->container= $container;
          $this->brewery = $brewery;
          $this->id = $id;
      }

      function setBeer_Name($new_beer_name)
      {
          $this->beer_name = (string) $new_beer_name;
      }

      function getBeer_Name()
      {
          return $this->beer_name;
      }

      function setStyle ($new_style)
      {
          $this->style = (string) $new_style;
      }

      function getStyle()
      {
          return $this->style;
      }

      function setAbv($new_abv)
      {
          $this->abv = (string) $new_abv;
      }

      function getAbv()
      {
          return $this->abv;
      }

      function setIbu($new_ibu)
      {
          $this->ibu = (string) $new_ibu;
      }

      function getIbu()
      {
          return $this->ibu;
      }

      function setContainer($new_container)
      {
          $this->container = (string) $new_container;
      }

      function getContainer()
      {
          return $this->container;
      }

      function setBrewery($new_brewery)
      {
          $this->brewery = (string) $new_brewery;
      }

      function getBrewery()
      {
          return $this->brewery;
      }

      function getId()
      {
          return $this->id;
      }


      function save()
      {
          $GLOBALS['DB']->exec("INSERT INTO beers (beer_name, style, abv, ibu, container, brewery) VALUES ('{$this->getBeer_Name()}', '{$this->getStyle()}', {$this->getAbv()}, {$this->getIbu()}, '{$this->getContainer()}', '{$this->getBrewery()}');");
           $this->id = $GLOBALS['DB']->lastInsertId();
      }

      static function getAll()
      {
          $returned_beers = $GLOBALS['DB']->query("SELECT * FROM beers;");
          $beers = array();
          foreach($returned_beers as $beer) {
              $beer_name = $beer['beer_name'];
              $style = $beer['style'];
              $abv = $beer['abv'];
              $ibu = $beer['ibu'];
              $container = $beer['container'];
              $brewery = $beer['brewery'];
              $id = $beer['id'];
              $new_beer = new Beer($beer_name, $style, $abv, $ibu, $container, $brewery, $id);
              array_push($beers, $new_beer);
          }
          return $beers;
      }

      static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE FROM beers;");
      }

      static function find($search_id)
      {
          $found_beer = null;
          $beers = Beer::getAll();
          foreach($beers as $beer) {
              $beer_id = $beer->getId();
              if ($beer_id == $search_id) {
                  $found_beer = $beer;
              }
          }
          return $found_beer;
      }

      function addUser($user)
      {
          $GLOBALS['DB']->exec("INSERT INTO reviews ( beer_id, user_id) VALUES ({$this->getId()}, {$user->getId()});");
      }

       function getUsers()
      {
          $beer_id = $this->getId();
          $returned_users = $GLOBALS['DB']->query("SELECT users.* FROM beers JOIN reviews ON (beers.id = reviews.beer_id) JOIN users  ON(reviews.user_id = users.id) WHERE beers.id = {$beer_id}");

          $users = array();
          foreach($returned_users as $user) {
              $user_name = $user['user_name'];
              $preferred_style = $user ['preferred_style'];
              $region = $user ['region'];
              $id = $user['id'];
              $new_user = new User($user_name, $preferred_style, $region, $id);
              array_push($users, $new_user);
          }
          return $users;
      }

      function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM beers WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE beer_id = {$this->getId()};");
        }
    }
?>