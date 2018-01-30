<?php
namespace tests\AppBundle\Service;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\DinosaurLengthDeterminator;
use AppBundle\Entity\Dinosaur;

class DinosaurLengthDeterminatorTest extends TestCase{
  /**
   * 
   * @dataProvider getSpecLengthTests
   */  
  public function testItReturnsCorrectLengthRange($spec, $minExpectedSize, $maxExpectedSize){
    $determinator = new DinosaurLengthDeterminator();
    $actualSize = $determinator->getLengthFromSpecification($spec);
    
    $this->assertGreaterThanOrEqual($minExpectedSize, $actualSize);
    $this->assertLessThanOrEqual($maxExpectedSize, $actualSize);
  }
  
  public function getSpecLengthTests(){
    return [
      // specification, minLength, maxLength
      ['large carnivorous dinosaur', Dinosaur::LARGE, Dinosaur::HUGE - 1],
      'default response' => ['give me all the cookies', 0, Dinosaur::LARGE - 1],
      ['large herbivore', Dinosaur::LARGE, Dinosaur::HUGE - 1],
      ['huge dinosaur', Dinosaur::HUGE, 100],
      ['huge dino', Dinosaur::HUGE, 100],
      ['huge', Dinosaur::HUGE, 100],
      ['OMG', Dinosaur::HUGE, 100],
      ['😱', Dinosaur::HUGE, 100]   
    ];  
  }
}
