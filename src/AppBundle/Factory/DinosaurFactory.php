<?php
namespace AppBundle\Factory;

use AppBundle\Entity\Dinosaur;

class DinosaurFactory {
  public function growVelociraptor(int $length): Dinosaur{
    $dinosaur = new Dinosaur('Velociraptor', true);
    
    $dinosaur->setLength($length);
    
    return $dinosaur;
  }
}
