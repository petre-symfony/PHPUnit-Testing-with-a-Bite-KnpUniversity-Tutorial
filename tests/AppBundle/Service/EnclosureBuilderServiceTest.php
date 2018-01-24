<?php
namespace tests\AppBundle\Service;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\EnclosureBuilderService;

class EnclosureBuilderServiceTest extends TestCase{
  public function testItBuildsAndPersistsEnclosure(){
    $builder = new EnclosureBuilderService();
    $enclosure = $builder->buildEnclosure(1, 2);  
    
    $this->assertCount(1, $enclosure->getSecurities());
    $this->assertCount(2, $enclosure->getDinosaurs());
  }    
}
