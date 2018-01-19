<?php
namespace tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Enclosure;

class EnclosureTest extends TestCase{
  public function testItHasNoDinosaursByDefault(){
    $enclosure = new Enclosure();
    
    $this->assertCount(0, $enclosure->getDinosaurs());
  }
}
