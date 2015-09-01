<?php

    class Review {

        private $beer_id;
        private $user_id;
        private $review;
        private $review_date;
        private $id;

        function __construct($beer_id, $user_id, $review = null, $review_date = null, $id = null) {
            $this->beer_id = $beer_id;
            $this->user_id = $user_id;
            $this->review = $review;
            $this->review_date = $review_date;
            $this->id = $id;
        }

        //Setters for review, and review_date
        function setReview($new_review){
            $this->review = (string) $new_review;
        }

        function setReviewDate($new_review_date){
            $this->review_date = (string) $new_review_date;
        }

        //Getters for all variables.
        function getBeerId(){
            return $this->beer_id;
        }

        function getUserId(){
            return $this->user_id;
        }

        function getReview(){
            return $this->review;
        }

        function getReviewDate(){
            return $this->review_date;
        }

        function getId(){
            return $this->id;
        }

        //Saves new user into database
        function save(){
            $statement = $GLOBALS['DB']->exec("INSERT INTO reviews (beer_id, user_id, review, review_date)
                        VALUES ({$this->getBeerId()}, {$this->getUserId()}, '{$this->getReview()}', '{$this->getReviewDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Updating review and review_date
        function update($new_review, $new_review_date) {
            $GLOBALS['DB']->exec("UPDATE reviews SET review = '{$new_review}',
                        review_date = {$new_review_date} WHERE id = {$this->getId()};");
            $this->setReview($new_review);
            $this->setReviewDate($new_review_date);
        }

        static function getAll(){
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach ($returned_reviews as $review) {
                $beer_id = $review['beer_id'];
                $user_id = $review['user_id'];
                $text = $review['review'];
                $date = $review['review_date'];
                $id = $review['id'];
                $new_review = new Review($beer_id, $user_id, $text, $date, $id);
                array_push($reviews, $new_review);
            }
        return $reviews;
        }


        //Searching review table with column_id as a variable
        static function find($column_id, $search_id) {
            //$column_id is what column to search, example user_id etc
            //if $search_id is an ID or review_date, it will be a string, else it will be an int
            if (is_string($search_id)) {
                $search_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews WHERE {$column_id} = '{$search_id}'");
            }
            else {
                $search_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews WHERE {$column_id} = {$search_id}");
            }
            $found_review = $search_reviews->fetchAll(PDO::FETCH_ASSOC);
            $found_reviews = array();
            foreach ($found_review as $review){
                $beer_id = $review['beer_id'];
                $user_id = $review['user_id'];
                $text = $review['review'];
                $review_date = $review['review_date'];
                $id = $review['id'];
                $new_review = new Review($beer_id, $user_id, $text, $review_date, $id);
                array_push($found_reviews, $new_review);
            }
            //returned output is in an array incase there is more than one book found.
            return $found_reviews;
        }

        //Searching for reviews where a user_id and beer_id intersect.
        static function findReview($id1, $id2) {
            $search_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews WHERE beer_id = {$id1} AND user_id = {$id2}");
            $found_reviews = array();
            $found_review = $search_reviews->fetchAll(PDO::FETCH_ASSOC);
            foreach ($found_review as $review){
                $beer_id = $review['beer_id'];
                $user_id = $review['user_id'];
                $text = $review['review'];
                $review_date = $review['review_date'];
                $id = $review['id'];
                $new_review = new Review($beer_id, $user_id, $text, $review_date, $id);
                array_push($found_reviews, $new_review);
            }
            return $found_reviews;
        }

        //Deletes everything from reviews, mostly for testing.
        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }


    } //End class
?>
