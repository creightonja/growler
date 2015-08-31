<?

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

    function save(){
        $statement = $GLOBALS['DB']->exec("INSERT INTO reviews (beer_id, user_id, review, date)
                    VALUES ({$this->getBeerId()}, {$this->getUserId()}, '{$this->getReview()}', '{$this->getDate()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }


    function update($new_review, $new_date) {
        $GLOBALS['DB']->exec("UPDATE reviews SET review = '{$new_review}',
                    date = {$new_date} WHERE id = {$this->getId()};");
        $this->setDueDate($new_due_date);
        $this->setCheckoutPatronId($new_checkout_patron_id);
    }
    


} //End class
