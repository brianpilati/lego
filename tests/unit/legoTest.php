<?php
  class LegoTest extends PHPUnit_Framework_TestCase
  {
    public function testGetLegoSetInformation() {

      $curl = new SAI_CurlStub();

      // Set up the CurlStub
      $defaultOptions = array(
          CURLOPT_URL => 'http://brickset.com/detail/?set=76011',
          CURLOPT_RETURNTRANSFER => true
      );

      //$curl->setResponse('fallback response');
      $curl->setResponse('<html><header></header><body><img src="bingo"></body></html>', $defaultOptions);

      $legoObj = new Lego(76011, $curl);
      $legoObj->getLegoSetInformation();
    }

    public function testPersistSetToFirebase() {
      $legoObj = new Lego(76011, $curl);
      $legoObj->persistSetToFirebase();
    }

    public function testGetSetFromFirebase() {
      $legoObj = new Lego(76011, $curl);
      $legoObj->getSetFromFirebase();
    }
  }
?>
