<?php
namespace tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;

class DinosaurTest extends TestCase {
  public function testSettingLength(){
    $dinosaur = new Dinosaur();
    
    $this->assertSame(0, $dinosaur->getLength());
    //$this->assertTrue(0 === $dinosaur->getLength())
    
    $dinosaur->setLength(9);
    $this->assertSame(9, $dinosaur->getLength());
  }
  
  public function testDinosaurHasNotShrunk(){
    $dinosaur = new Dinosaur();
    $dinosaur->setLength(15);
    
    $this->assertGreaterThan(16, $dinosaur->getLength(), 'Did you put it in the washing machine?');
  }
}
