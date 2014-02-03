<?php
  class LegoTest extends PHPUnit_Framework_TestCase
  {
    public function testGetLegoSetInformation() {

      $curl = new SAI_CurlStub();
      $firebase = new FirebaseStub("https://myfirebase.firebaseio.com");

      // Set up the CurlStub
      $defaultOptions = array(
          CURLOPT_URL => 'http://brickset.com/detail/?set=76011',
          CURLOPT_RETURNTRANSFER => true
      );

      //$curl->setResponse('fallback response');
      $curl->setResponse('<html><header></header><body><img src="bingo"></body></html>', $defaultOptions);

      $legoObj = new Lego(76011, $curl, $firebase);
      $legoObj->getLegoSetInformation();
    }

    public function testPersistSetToFirebase() {
      $firebase = new FirebaseStub("https://myfirebase.firebaseio.com");
      $legoObj = new Lego(76011, $curl, $firebase);
      $legoObj->persistSetToFirebase();
    }

    public function testGetSetFromFirebase() {
      $firebase = new FirebaseStub("https://myfirebase.firebaseio.com");
      $legoObj = new Lego(76011, $curl, $firebase);
      $legoObj->getSetFromFirebase();
    }
  }
?>
