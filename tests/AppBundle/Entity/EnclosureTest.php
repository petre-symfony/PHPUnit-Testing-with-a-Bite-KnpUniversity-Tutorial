<?php
namespace tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Enclosure;
use AppBundle\Entity\Dinosaur;

class EnclosureTest extends TestCase{
  public function testItHasNoDinosaursByDefault(){
    $enclosure = new Enclosure();
    
    $this->assertEmpty($enclosure->getDinosaurs());
  }
  
  public function testItAddDinosaurs(){
    $enclosure = new Enclosure();
    
    $enclosure->addDinosaur(new Dinosaur());
    $enclosure->addDinosaur(new Dinosaur());
    
    $this->assertCount(2, $enclosure->getDinosaurs());
  }
}
