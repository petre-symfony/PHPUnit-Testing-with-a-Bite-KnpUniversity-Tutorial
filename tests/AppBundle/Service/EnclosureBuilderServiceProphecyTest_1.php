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
    
    $dinoFactory = $this->prophesize(DinosaurFactory::class);
    $dinoFactory->growFromSpecification(Argument::type('string'))
      ->shouldBeCalledTimes(2)
      ->willReturn(new Dinosaur());  
    
    $builder = new EnclosureBuilderService($em, $dinoFactory);
    $enclosure = $builder->buildEnclosure(1, 2);
    
    $this->assertCount(1, $enclosure->getSecurities());
    $this->assertCount(2, $enclosure->getDinosaurs());
  }    
}
