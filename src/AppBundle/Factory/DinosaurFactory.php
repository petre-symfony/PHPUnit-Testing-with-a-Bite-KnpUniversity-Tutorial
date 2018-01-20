<?php
namespace AppBundle\Factory;

use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;

class DinosaurFactory {
  private $lengthDeterminator;  
    
  public function __construct(DinosaurLengthDeterminator $lengthDeterminator) {
    $this->lengthDeterminator = $lengthDeterminator;
  }


  public function growVelociraptor(int $length): Dinosaur{
    return $this->createDinosaur('Velociraptor', true, $length);
  }
  
  public function growFromSpecification(string $specification): Dinosaur{
    //defaults
    $codeName = 'ING-' . random_int(1, 99999);
    //$length = $this->lengthDeterminator->getLengthFromSpecification($specification);
    $length = $this->lengthDeterminator->getLengthFromSpecification('foo');
    $isCarnivorous = FALSE;
    
    
    if (stripos($specification, 'carnivorous') !== false) {
      $isCarnivorous = true;
    }
    
    $dinosaur = $this->createDinosaur($codeName, $isCarnivorous, $length);
    return $dinosaur;
  }
  
  private function createDinosaur(string $genus, bool $isCarnivorous, int $length) {
    $dinosaur = new Dinosaur($genus, $isCarnivorous);
    
    $dinosaur->setLength($length);
    
    return $dinosaur;
  }
}
