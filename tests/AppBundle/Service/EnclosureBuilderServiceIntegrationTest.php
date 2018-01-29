<?php
namespace tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Service\EnclosureBuilderService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Security;
use AppBundle\Entity\Dinosaur;

class EnclosureBuilderServiceIntegrationTest extends KernelTestCase{
  public function testItBuildsEnclosureWithDefaultSpecification(){
    self::bootKernel();
    
    /** @var EnclosureBuilderService $enclosureBuilderService */
    $enclosureBuilderService = self::$kernel->getContainer()
      ->get('test.'.EnclosureBuilderService::class);
    $enclosureBuilderService->buildEnclosure();
    
    /** @var EntityManager $em */
    $em = self::$kernel->getContainer()
      ->get('doctrine')->getManager();
    
    $count = (int) $em->getRepository(Security::class)
      ->createQueryBuilder('s')
      ->select('COUNT(s.id)')
      ->getQuery()
      ->getSingleScalarResult();
    
    $this->assertSame(1, $count, 'Amount of security system is not the same');
    
    $count = (int) $em->getRepository(Dinosaur::class)
      ->createQueryBuilder('d')
      ->select('COUNT(d.id)')
      ->getQuery()
      ->getSingleScalarResult();
    
    $this->assertSame(3, $count, 'Amount of dinosaurs is not the same');
  }
}
