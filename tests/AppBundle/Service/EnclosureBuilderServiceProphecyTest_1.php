<?php
namespace tests\AppBundle\Service;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\EnclosureBuilderService;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Factory\DinosaurFactory;
use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use Prophecy\Argument;

class EnclosureBuilderServiceProphecyTest extends TestCase{
  public function testItBuildsAndPersistsEnclosure(){
    $em = $this->prophesize(EntityManager::class);
    
    $em->persist(Argument::type(Enclosure::class))->shouldBeCalledTimes(1);
    $em->flush()->shouldBeCalled();
  }    
}
