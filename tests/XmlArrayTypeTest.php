<?php

namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;

/**
 * Test class for TextArrayType.
 * Generated by PHPUnit on 2012-07-18 at 09:03:09.
 */
final class XmlArrayTypeTest
    extends TestCase
{
    /**
     * @var TextArrayType
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        if (!Type::hasType('xml')) {
            Type::addType('xml', 'Ajgl\Doctrine\DBAL\Types\XmlType');
        } else {
            Type::overrideType('xml', 'Ajgl\Doctrine\DBAL\Types\XmlType');
        }
        if (!Type::hasType('xml[]')) {
            Type::addType('xml[]', 'Ajgl\Doctrine\DBAL\Types\XmlArrayType');
        } else {
            Type::overrideType('xml[]', 'Ajgl\Doctrine\DBAL\Types\XmlArrayType');
        }
        $this->object = Type::getType('xml[]');
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\XmlArrayType::getName
     */
    public function testGetName()
    {
        $this->assertEquals(XmlArrayType::XMLARRAY, $this->object->getName());
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\XmlArrayType::getInnerType
     */
    public function testGetInnerType()
    {
        $this->assertInstanceOf('Ajgl\Doctrine\DBAL\Types\XmlType', $this->object->getInnerType());
    }

}
