<?php
namespace AppBundle\Factory;

use AppBundle\Entity\Dinosaur;

class DinosaurFactory {
  public function growVelociraptor(int $length): Dinosaur{
    return $this->createDinosaur('Velociraptor', true, $length);
  }
  
  private function createDinosaur(string $genus, bool $isCarnivorous, int $length) {
    $dinosaur = new Dinosaur($genus, $isCarnivorous);
    
    $dinosaur->setLength($length);
  }
}
