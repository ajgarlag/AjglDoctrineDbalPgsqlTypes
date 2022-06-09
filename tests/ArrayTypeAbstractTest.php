<?php

namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;

/**
 * Test class for InetType.
 * Generated by PHPUnit on 2012-07-18 at 09:03:09.
 */
final class ArrayTypeAbstractTest
    extends TestCase
{
    /**
     * @var MockPlatform
     */
    protected $platform;

    /**
     * @var ArrayTypeAbstract
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        if (!Type::hasType('foo')) {
            Type::addType('foo', 'Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstractConcrete');
        } else {
            Type::overrideType('foo', 'Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstractConcrete');
        }
        $this->platform = $this->createMock(AbstractPlatform::class);
        $this->object = Type::getType('foo');
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstract::getSqlDeclaration
     */
    public function testGetSqlDeclaration()
    {
        $this->platform->expects($this->once())
            ->method('getIntegerTypeDeclarationSQL')
            ->willReturn('DUMMYINT');
        $this->assertEquals('DUMMYINT[]', $this->object->getSqlDeclaration(array(), $this->platform));
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstract::getSqlDeclaration
     */
    public function testGetName()
    {
        $this->assertEquals('foo', $this->object->getName());
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstract::canRequireSQLConversion
     */
    public function testCanRequireSQLConversion()
    {
        $this->assertTrue($this->object->canRequireSQLConversion());
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstract::convertToDatabaseValue
     */
    public function testConvertToDatabaseValue()
    {
        $value = [[1,2],[3,4]];
        $expected = '{{1,2},{3,4}}';
        $actual = $this->object->convertToDatabaseValue($value, $this->platform);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstract::convertToPhpValue
     */
    public function testConvertToPhpValue()
    {
        $value = '{{1,2},{3,4}}';;
        $expected = [[1,2],[3,4]];
        $actual = $this->object->convertToPhpValue($value, $this->platform);
        $this->assertEquals($expected, $actual);
    }


    public function testConvertToPhpNullValues()
    {
        $value = null;
        $actual = $this->object->convertToPhpValue($value, $this->platform);
        $this->assertNull($actual);

    }

    /**
     * @covers Ajgl\Doctrine\DBAL\Types\ArrayTypeAbstract::getInnerType
     */
    public function testGetInnerType()
    {
        $this->assertInstanceOf('Doctrine\DBAL\Types\IntegerType', $this->object->getInnerType());
    }
}

final class ArrayTypeAbstractConcrete
    extends ArrayTypeAbstract
{
    protected string $name = 'foo';

    protected string $innerTypeName = 'integer';

}
