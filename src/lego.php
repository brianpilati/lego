<?php
  require_once __DIR__ . '/lib/php-SAI-0.1.2/lib/Curl.php';
  require_once __DIR__ . '/lib/simple_html_dom.php';
  require_once __DIR__ . '/lib/firebaseLib.php';

  class Lego {
    public function __construct($setNumber, $curlObject=null) {
      $this->setNumber = $setNumber;
      $this->curlObject = $this->getCurlObject($curlObject);
    }

    public function getLegoSetInformation() {
      $ch = $this->curlObject->curl_init();
      $this->curlObject->curl_setopt($ch, CURLOPT_URL , $this->buildTheBrickSetUrl());
      $this->curlObject->curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $htmlString = $this->curlObject->curl_exec($ch);
      $this->curlObject->curl_close($ch);

      $domObject = str_get_html($htmlString);
      foreach($domObject->find('img') as $element)
             echo $element->src . "\n";
    }

    public function persistSetToFirebase() {
      $firebase = new Firebase('https://radiant-fire-2427.firebaseio.com', 'czvEX8vMU8FZn4wYCvf466P3J6zH5ZlKQeuwxmEZ');
      echo $firebase->set('legoSet/67011', "{'set': 67011, 'price': 19.99, 'year': 1999}");
    }

    public function getSetFromFirebase() {
      $firebase = new Firebase('https://radiant-fire-2427.firebaseio.com', 'czvEX8vMU8FZn4wYCvf466P3J6zH5ZlKQeuwxmEZ');
      echo $firebase->get('legoSet/67011');
    }

    private function isTheLegoSetInTheDatabase() {
      return true;
    }

    private function buildTheBrickSetUrl() {
      return "http://brickset.com/detail/?set={$this->getSetNumber()}";
    }

    private function getCurlObject($curlResource) {
      return ($curlResource ? $curlResource : new SAI_Curl());
    }

    private function getSetNumber() {
      return $this->setNumber;
    }

  }
?>