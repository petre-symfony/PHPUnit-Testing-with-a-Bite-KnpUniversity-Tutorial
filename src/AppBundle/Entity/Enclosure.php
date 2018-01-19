<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Enclosure {
  /**
   * @var Collection
   */
  private $dinosaurs;
  
  public function __construct() {
    $this->dinosaurs = new ArrayCollection();
  }
}
