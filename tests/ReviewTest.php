    <?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Review.php";

    $server = 'mysql:host=localhost;dbname=growler_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ReviewTest extends PHPUnit_Framework_TestCase {



        protected function tearDown() {
            Review::deleteAll();
            //Beer::deleteAll();
            //User::deleteAll();
        }

        function test_getBeerId() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 1;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            //Act
            $test = $beer_id;
            $result = $test_review->getBeerId();

            //Assert
            $this->assertEquals($test, $result);
        }

        function test_getUserId() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 1;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            //Act
            $test = $user_id;
            $result = $test_review->getUserId();

            //Assert
            $this->assertEquals($test, $result);
        }

        function test_getReview() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 1;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            //Act
            $test = $review;
            $result = $test_review->getReview();

            //Assert
            $this->assertEquals($test, $result);
        }

        function test_getDate() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 1;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            //Act
            $test = $date;
            $result = $test_review->getReviewDate();

            //Assert
            $this->assertEquals($test, $result);
        }

        function test_getId() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 1;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            //Act
            $test = true;
            $result = is_numeric($test_review->getId());

            //Assert
            $this->assertEquals($test, $result);
        }

        function test_saveAndgetAll() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 3;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals([$test_review], $result);
        }

        function test_deleteAll() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 3;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            //Act
            $test = Review::deleteAll();
            $result = Review::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_update() {
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 3;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();
            $new_review = "Bad beer";
            $new_review_date = "2015-10-09";

            //Act
            $test_review->update($new_review, $new_review_date);
            $updated_review = $test_review->getReview();
            $updated_review_date = $test_review->getReviewDate();
            $result = [$updated_review, $updated_review_date];

            //Assert
            $this->assertEquals([$new_review, $new_review_date], $result);
        }

        function test_Find(){
            //Arrange
            $beer_id = 1;
            $user_id = 1;
            $review = "Great beer";
            $date = "2015-10-08";
            $id = 3;
            $test_review = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review->save();

            $beer_id = 2;
            $user_id = 2;
            $review = "Bad beer";
            $date = "2015-10-09";
            $id = 3;
            $test_review2 = new Review($beer_id, $user_id, $review, $date, $id);
            $test_review2->save();

            //Act
            $column_id = "review";
            $search_id = "Bad beer";
            $result = Review::find($column_id, $search_id);

            //Assert
            $this->assertEquals([$test_review2], $result);
        }

        function test_findReview(){
                //Arrange
                $beer_id = 1;
                $user_id = 1;
                $review = "Great beer";
                $date = "2015-10-08";
                $id = 3;
                $test_review = new Review($beer_id, $user_id, $review, $date, $id);
                $test_review->save();

                $beer_id = 2;
                $user_id = 2;
                $review = "Bad beer";
                $date = "2015-10-09";
                $id = 3;
                $test_review2 = new Review($beer_id, $user_id, $review, $date, $id);
                $test_review2->save();

                //Act
                $search_beer_id = $test_review2->getBeerId();
                $search_user_id = $test_review2->getUserId();
                $result = Review::findReview($search_beer_id, $search_user_id);

                //Assert
                $this->assertEquals([$test_review2], $result);
        }


    }

?>
