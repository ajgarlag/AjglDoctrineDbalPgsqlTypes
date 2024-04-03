<?php

declare(strict_types=1);

/*
 * AJGL Doctrine DBAL Types
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\TextType;
use SimpleXMLElement;

final class XmlType extends TextType
{
    public const XML = 'xml';

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
