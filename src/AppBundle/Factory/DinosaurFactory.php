<?php
namespace AppBundle\Factory;

use AppBundle\Entity\Dinosaur;

class DinosaurFactory {
  public function growVelociraptor(int $length): Dinosaur{
    return $this->createDinosaur('Velociraptor', true, $length);
  }
  
  public function growFromSpecification(string $specification): Dinosaur{
    //defaults
    $codeName = 'ING-' . random_int(1, 99999);
    $length = random_int(1, Dinosaur::LARGE - 1);
    $IsCarnivorous = FALSE;
    
    if (stripos($specification, 'large') !== false) {
      $length = random_int(Dinosaur::LARGE, 100);
    }
    
    $dinosaur = $this->createDinosaur($codeName, $IsCarnivorous, $length);
    return $dinosaur;
  }
  
  private function createDinosaur(string $genus, bool $isCarnivorous, int $length) {
    $dinosaur = new Dinosaur($genus, $isCarnivorous);
    
    $dinosaur->setLength($length);
    
    return $dinosaur;
  }
}
