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

        // protected function setUp() {
        //     $beer_id = 1;
        //     $user_id = 1;
        //     $review = "Great beer";
        //     $date = "2015-10-08";
        //     $id = 1;
        //     $test_review = new Review($beer_id, $user_id, $review, $date, $id);
        //     $test_review->save();
        // }

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
            $test = $test_review;
            $result = Review::getAll();

            //Assert
            $this->assertEquals([$test], $result);
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


    }

?>
