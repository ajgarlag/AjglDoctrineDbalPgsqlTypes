<?php

namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;

/**
 * Test class for BooleanArrayType.
 * Generated by PHPUnit on 2012-07-18 at 09:03:09.
 */
final class BooleanArrayTypeTest
    extends TestCase
{
    /**
     * @var BooleanArrayType
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
         if (!Type::hasType('boolean[]')) {
            Type::addType('boolean[]', 'Ajgl\Doctrine\DBAL\Types\BooleanArrayType');
        } else {
            Type::overrideType('boolean[]', 'Ajgl\Doctrine\DBAL\Types\BooleanArrayType');
        }
        $this->object = Type::getType('boolean[]');
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\BooleanArrayType::getName
     */
    public function testGetName()
    {
        $this->assertEquals(BooleanArrayType::BOOLEANARRAY, $this->object->getName());
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\BooleanArrayType::getInnerType
     */
    public function testGetInnerType()
    {
        $this->assertInstanceOf('Doctrine\DBAL\Types\BooleanType', $this->object->getInnerType());
    }

}
