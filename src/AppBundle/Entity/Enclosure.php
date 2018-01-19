<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
  
  public function __construct() {
    $this->dinosaurs = new ArrayCollection();
  }
  
  public function getDinosaurs(): Collection{
    return $this->dinosaurs;
  }
}
