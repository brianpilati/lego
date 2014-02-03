<?php
  class LegoTest extends PHPUnit_Framework_TestCase
  {

    public function setUp()
    {
      $this->_curl = new SAI_CurlStub();
      $this->_firebase = new FirebaseStub("https://myfirebase.firebaseio.com");
    }

    public function testGetLegoSetInformation() {
      // Set up the CurlStub
      $defaultOptions = array(
          CURLOPT_URL => 'http://brickset.com/detail/?set=76011',
          CURLOPT_RETURNTRANSFER => true
      );

      //$curl->setResponse('fallback response');
      $this->_curl->setResponse('<html><header></header><body><img src="bingo"></body></html>', $defaultOptions);

      $legoObj = new Lego(76011, $this->_curl, $this->_firebase);
      $legoObj->getLegoSetInformation();
    }

    public function testPersistSetToFirebase() {
      $legoObj = new Lego(76011, $this->_curl, $this->_firebase);
      $legoObj->persistSetToFirebase();
    }

    public function testGetSetFromFirebase() {
      $legoObj = new Lego(76011, $this->_curl, $this->_firebase);
      $legoObj->getSetFromFirebase();
    }
  }
?>
