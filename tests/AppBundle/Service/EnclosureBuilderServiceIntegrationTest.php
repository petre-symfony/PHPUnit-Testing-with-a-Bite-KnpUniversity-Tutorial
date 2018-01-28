<?php
namespace tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Service\EnclosureBuilderService;

class EnclosureBuilderServiceIntegrationTest extends KernelTestCase{
  public function testItBuildsEnclosureWithDefaultSpecification(){
    self::bootKernel();
    
    $enclosureBuilderService = self::$kernel->getContainer()
      ->get('test.'.EnclosureBuilderService::class);
  }
}
