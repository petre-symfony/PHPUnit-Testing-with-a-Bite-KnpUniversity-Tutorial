<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dinosaurs")
 */
class Dinosaur
{
   const LARGE = 20;
    /**
     * @ORM\Column(type="integer")
     */
    private $length = 0;
    /**
     * @ORM\Column(type="integer")
     */
    private $genus;
    /**
     * @ORM\Column(type="bollean")
     */
    private $isCarnivorous;
    
    public function __construct(string $genus = 'Unknown', bool $isCarnivorous = false){
      $this->genus = $genus;
      $this->isCarnivorous = $isCarnivorous;
    }
    
    public function getLength(): int{
      return $this->length;
    }
    
    public function setLength(int $length){
      $this->length = $length;
    }
    
    public function getGenus(): string{
      return $this->genus;
    }

    public function getSpecification(): string{
      return sprintf(
        'The %s %scarnivorous dinosaur is %d meters long',
        $this->genus,
        $this->isCarnivorous ? '' : 'non-',
        $this->length
      );
    }
    
    public function isCarnivorous() {
      return $this->isCarnivorous;
    }
}
