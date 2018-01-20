<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppBundle\Entity\Dinosaur;
use AppBundle\Exception\NotABuffetException;

/**
 * @ORM\Entity
 * @ORM\Table(name="enclosure")
 */
class Enclosure {
  /**
   * @var Collection
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dinosaur", mappedBy="enclosure", cascade=["persist"])
   */
  private $dinosaurs;
  
  private $securities;


  public function __construct() {
    $this->dinosaurs = new ArrayCollection();
  }
  
  public function getDinosaurs(): Collection{
    return $this->dinosaurs;
  }
  
  public function addDinosaur(Dinosaur $dinosaur){
    if (!$this->canAddDinosaur($dinosaur)){
      throw new NotABuffetException();
    }
    
    $this->dinosaurs[] = $dinosaur;
  }
  
  private function canAddDinosaur(Dinosaur $dinosaur): bool {
    return count($this->dinosaurs) === 0 
      || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
  }
}
