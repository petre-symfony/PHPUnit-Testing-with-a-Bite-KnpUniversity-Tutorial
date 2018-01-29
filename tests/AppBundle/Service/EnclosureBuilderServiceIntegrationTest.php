<?php
namespace tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Service\EnclosureBuilderService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Security;
use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Factory\DinosaurFactory;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class EnclosureBuilderServiceIntegrationTest extends KernelTestCase{
  public function setUp() {
    self::bootKernel();
    
    $this->truncateEntities();
  }

  public function testItBuildsEnclosureWithDefaultSpecification(){
    
    /** @var EnclosureBuilderService $enclosureBuilderService 
    $enclosureBuilderService = self::$kernel->getContainer()
      ->get('test.'.EnclosureBuilderService::class);
     */
    
    $dinoFactory = $this->createMock(DinosaurFactory::class);
    $dinoFactory->expects($this->any())
      ->method('growFromSpecification')
      ->willReturn(new Dinosaur());
    
    
    $enclosureBuilderService = new EnclosureBuilderService(
      $this->getEntityManager(),
      $dinoFactory      
    );
      
    $enclosureBuilderService->buildEnclosure();
    
    $em = $this->getEntityManager();
    
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
  
  private function truncateEntities(){
    $purger = new ORMPurger($this->getEntityManager());
    $purger->purge();
  }
  
  /** @return EntityManager */
  private function getEntityManager(){
    return self::$kernel->getContainer()
      ->get('doctrine')
      ->getManager();   
  }
}
