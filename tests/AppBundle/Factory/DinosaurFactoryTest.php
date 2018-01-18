<?php
namespace tests\AppBundle\Factory;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;
use AppBundle\Factory\DinosaurFactory;

class DinosaurFactoryTest extends TestCase{
  /**
   * @var DinosaurFactory
   */
  private $factory;
  
  public function setUp(){
    $this->factory = new DinosaurFactory();
  }

  public function testItGrowsAVelociraptor(){
    $dinosaur = $this->factory->growVelociraptor(5);
    
    $this->assertInstanceOf(Dinosaur::class, $dinosaur);
    $this->assertInternalType('string', $dinosaur->getGenus());
    $this->assertSame('Velociraptor', $dinosaur->getGenus());
    $this->assertSame(5, $dinosaur->getLength());
  }
}
