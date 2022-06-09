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

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        switch (true) {
            case $platform instanceof PostgreSqlPlatform:
                return 'XML';
            default:
                parent::getSQLDeclaration($fieldDeclaration, $platform);
        }
    }

    public function canRequireSQLConversion(): bool
    {
        return true;
    }

    /**
     * @param ?SimpleXMLElement $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
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

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
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

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
