<?php


namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\TextType;
use SimpleXMLElement;

final class XmlType extends TextType
{
    const XML = 'xml';

    public function getName(): string
    {
        return self::XML;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        switch (true) {
            case $platform instanceof PostgreSqlPlatform:
                return 'XML';
            default:
                parent::getSQLDeclaration($fieldDeclaration, $platform);
        }
    }

    /**
     * @inheritdoc
     */
    public function canRequireSQLConversion()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return $value;
        }

        if ($value instanceof SimpleXMLElement) {
            return $value->asXML();
        }

        throw ConversionException::conversionFailedInvalidType(
            $value,
            $this->getName(),
            ['null', SimpleXMLElement::class]
        );
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof SimpleXMLElement) {
            return $value;
        }

        $xml = simplexml_load_string($value);

        if (! $xml) {
            throw ConversionException::conversionFailed($value, $this->getName());
        }

        return $xml;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
