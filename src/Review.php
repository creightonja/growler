<?php

    class Review {

        private $beer_id;
        private $user_id;
        private $review;
        private $date;
        private $id;

        function __construct($beer_id, $user_id, $review = null, $date = null, $id = null) {
            $this->beer_id = $beer_id;
            $this->user_id = $user_id;
            $this->review = $review;
            $this->date = $date;
            $this->id = $id;
        }

        //Setters for review, and date
        function setReview(){
            $this->review = (string) $review;
        }

        function setDate(){
            $this->date = (string) $date;
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

        function getDate(){
            return $this->date;
        }

        function getId(){
            return $this->id;
        }

        //Saves new user into database
        function save(){
            $statement = $GLOBALS['DB']->exec("INSERT INTO reviews (beer_id, user_id, review, date)
                        VALUES ({$this->getBeerId()}, {$this->getUserId()}, '{$this->getReview()}', '{$this->getDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Updating review and date
        function update($new_review, $new_date) {
            $GLOBALS['DB']->exec("UPDATE reviews SET review = '{$new_review}',
                        date = {$new_date} WHERE id = {$this->getId()};");
            $this->setDueDate($new_due_date);
            $this->setCheckoutPatronId($new_checkout_patron_id);
        }

        static function getAll(){
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach ($returned_reviews as $review) {
                $beer_id = $review['beer_id'];
                $user_id = $review['user_id'];
                $review = $review['review'];
                $date = $review['date'];
                $id = $review['id'];
                $new_review = new Review($beer_id, $user_id, $review, $date, $id);
                array_push($reviews, $new_review);
            }
        return $review;
        }


        //Searching book_list database with column_id as a variable
        static function find($column_id, $search_id) {
            //$column_id is what column to search, example user_id etc
            //if $search_id is an ID or date, it will be a string, else it will be an int
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
                $review = $review['review'];
                $date = $review['date'];
                $id = $review['id'];
                $new_review = new Review($beer_id, $user_id, $review, $date, $id);
                array_push($found_reviews, $new_review);
            }
            //returned output is in an array incase there is more than one book found.
            return $found_reviews;
        }

        //Searching for reviews where a user_id and beer_id intersect.
        static function findBookList($id1, $id2) {
            $search_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews WHERE beer_id = {$id1} AND user_id = {$id2}");
            $found_reviews = array();
            $found_review = $search_book_list->fetchAll(PDO::FETCH_ASSOC);
            foreach ($found_review as $review){
                $beer_id = $review['beer_id'];
                $user_id = $review['user_id'];
                $review = $review['review'];
                $date = $review['date'];
                $id = $review['id'];
                $new_review = new Review($beer_id, $user_id, $review, $date, $id);
                array_push($found_reviews, $new_review);
            }
            return $found_reviews;
        }

        //Deletes everything from reviews, mostly for testing.
        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }


    } //End class

} //End class
?>
