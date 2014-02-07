<?php
  require_once __DIR__ . '/vendor/php-SAI-0.1.2/lib/Curl.php';
  require_once __DIR__ . '/vendor/simple_html_dom.php';
  require_once __DIR__ . '/vendor/firebase/firebaseLib.php';

  class Lego {
    private $_setNumber;
    private $_curlObject;
    private $_firebaseObject;

    public function __construct($setNumber, $curlObject=null, $firebaseObject=null) {
      $this->setLegoSetNumber($setNumber);
      $this->setCurlObject($curlObject);
      $this->setFirebaseObject($firebaseObject);
    }

    public function getLegoSetInformation() {
      $ch = $this->_curlObject->curl_init();
      $this->_curlObject->curl_setopt($ch, CURLOPT_URL , $this->buildTheBrickSetUrl());
      $this->_curlObject->curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $htmlString = $this->_curlObject->curl_exec($ch);
      $this->_curlObject->curl_close($ch);

      $domObject = str_get_html($htmlString);
      foreach($domObject->find('img') as $element)
        $element->src . "\n";
    }

    public function persistSetToFirebase() {
      echo $this->_firebaseObject->set('legoSet/67011', '{"set": 67011, "price": 19.99, "year": 1999}');
    }

    public function getSetFromFirebase() {
      echo $this->_firebaseObject->get('legoSet/67011');
    }

    private function isTheLegoSetInTheDatabase() {
      return true;
    }

    private function buildTheBrickSetUrl() {
      return "http://brickset.com/detail/?set={$this->getLegoSetNumber()}";
    }

    private function setCurlObject($curlResource) {
      $this->_curlObject = ($curlResource ? $curlResource : new SAI_Curl());
    }

    private function setFirebaseObject($firebaseObject) {
      $this->_firebaseObject = ($firebaseObject ? $firebaseObject : new Firebase('https://radiant-fire-2427.firebaseio.com', 'czvEX8vMU8FZn4wYCvf466P3J6zH5ZlKQeuwxmEZ'));
    }

    private function setLegoSetNumber($setNumber) {
      $this->_setNumber = $setNumber;
    }

    private function getLegoSetNumber() {
      return $this->_setNumber;
    }

  }
?>
