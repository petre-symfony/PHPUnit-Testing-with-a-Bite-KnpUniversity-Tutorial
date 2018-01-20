<?php
namespace tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Enclosure;
use AppBundle\Entity\Dinosaur;
use AppBundle\Exception\NotABuffetException;
use AppBundle\Exception\DinosaursAreRunningRampantException;

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
  
  public function testItDoesNotAllowCarnivorousDinosaursToMixWithHerbivores(){
    $enclosure = new Enclosure();
    $enclosure->addDinosaur(new Dinosaur());
    
    $this->expectException(NotABuffetException::class);
    
    $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
  }
  
  /**
   * @expectedException \AppBundle\Exception\NotABuffetException
   */
  public function testItDoesNotAllowToAddNonCarnivorousDinosaursToCarnivorousEnclosure(){
    $enclosure = new Enclosure();
    $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    
    $enclosure->addDinosaur(new Dinosaur());
  }
  
  public function testItDoesNotAllowToAddDinosToUnsecureEnclosures(){
    $enclosure = new Enclosure();
    $this->expectException(DinosaursAreRunningRampantException::class);
    $this->expectExceptionMessage('Are you craaazy?!?');
    $enclosure->addDinosaur(new Dinosaur());
  }
}
