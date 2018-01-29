<?php
namespace tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Service\EnclosureBuilderService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Security;
use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;

class EnclosureBuilderServiceIntegrationTest extends KernelTestCase{
  public function setUp() {
    self::bootKernel();
    
    $this->truncateEntities([
      Enclosure::class,
      Dinosaur::class,
      Security::class
    ]);
  }

  public function testItBuildsEnclosureWithDefaultSpecification(){
    
    /** @var EnclosureBuilderService $enclosureBuilderService */
    $enclosureBuilderService = self::$kernel->getContainer()
      ->get('test.'.EnclosureBuilderService::class);
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
  
  private function truncateEntities(array $entities){
    $connection = $this->getEntityManager()->getConnection();
    $databasePlatform = $connection->getDatabasePlatform();

    if ($databasePlatform->supportsForeignKeyConstraints()) {
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
    }

    foreach ($entities as $entity) {
        $query = $databasePlatform->getTruncateTableSQL(
            $this->getEntityManager()->getClassMetadata($entity)->getTableName()
        );

        $connection->executeUpdate($query);
    }

    if ($databasePlatform->supportsForeignKeyConstraints()) {
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }
  }
  
  /** @return EntityManager */
  private function getEntityManager(){
    return self::$kernel->getContainer()
      ->get('doctrine')
      ->getManager();   
  }
}
