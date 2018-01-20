<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppBundle\Entity\Dinosaur;
use AppBundle\Exception\NotABuffetException;
use AppBundle\Entity\Security;
use AppBundle\Exception\DinosaursAreRunningRampantException;

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
  
  /**
   * @var Collection|Security[]
   */
  private $securities;


  public function __construct() {
    $this->dinosaurs = new ArrayCollection();
    $this->securities = new ArrayCollection();
  }
  
  public function getDinosaurs(): Collection{
    return $this->dinosaurs;
  }
  
  public function addDinosaur(Dinosaur $dinosaur){
    if (!$this->canAddDinosaur($dinosaur)){
      throw new NotABuffetException();
    }
    if (!$this->isSecurityActive()){
      throw new DinosaursAreRunningRampantException('Are you craaazy?!?');
    }
    
    $this->dinosaurs[] = $dinosaur;
  }
  
  public function isSecurityActive():bool {
    foreach ($this->securities as $security){
      if ($security->getIsActive()){
        return TRUE;    
      }
    }
    
    return FALSE;
  }

  private function canAddDinosaur(Dinosaur $dinosaur): bool {
    return count($this->dinosaurs) === 0 
      || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
  }
}
