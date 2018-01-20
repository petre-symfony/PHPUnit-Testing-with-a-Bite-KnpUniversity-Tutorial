<?php
namespace tests\AppBundle\Factory;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;
use AppBundle\Factory\DinosaurFactory;
use AppBundle\Service\DinosaurLengthDeterminator;

class DinosaurFactoryTest extends TestCase{
  /**
   * @var DinosaurFactory
   */
  private $factory;
  
  public function setUp(){
    $mockLengthDeterminator = $this->createMock(DinosaurLengthDeterminator::class); 
    $this->factory = new DinosaurFactory($mockLengthDeterminator);
  }

  public function testItGrowsAVelociraptor(){
    $dinosaur = $this->factory->growVelociraptor(5);
    
    $this->assertInstanceOf(Dinosaur::class, $dinosaur);
    $this->assertInternalType('string', $dinosaur->getGenus());
    $this->assertSame('Velociraptor', $dinosaur->getGenus());
    $this->assertSame(5, $dinosaur->getLength());
  }
  
  public function testItGrowsATriceratops(){
    $this->markTestIncomplete('Waiting for confirmation from GenLab');
  }
  
  public function testItGrowsABabyVelociraptor(){
    if (!class_exists('Nanny')){
      $this->markTestSkipped('There is nobody to watch the baby raptor');
    }
    
    $dinosaur = $this->factory->growVelociraptor(1);
    $this->assertSame(1, $dinosaur->getLength());
  }
  
  /**
    * @dataProvider getSpecificationTests
  */
  public function testItGrowsADinosaurFromSpecification(string $spec, bool $expectedIsCarnivorous){
    $dinosaur = $this->factory->growFromSpecification($spec);
    
    $this->assertSame($expectedIsCarnivorous, $dinosaur->isCarnivorous(), 'Diets do not match');
  }
  

  public function getSpecificationTests(){
    return [
      // specification, is carnivorous
      ['large carnivorous dinosaur', true ],
      'default response' => ['give me all the cookies', false ],
      ['large herbivore', false ]
    ];
  }
}
