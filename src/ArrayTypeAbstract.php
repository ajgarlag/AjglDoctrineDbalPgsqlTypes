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

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class ArrayTypeAbstract extends Type
{
    protected string $name;

    protected string $innerTypeName;

    protected Type $innerType;

    public function getName(): string
    {
        return $this->name;
    }

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $innerDeclaration = $this->getInnerType()->getSQLDeclaration($fieldDeclaration, $platform);
        if (substr($innerDeclaration, -2) == '()') {
            $innerDeclaration = substr($innerDeclaration, 0, -2);
        }

        return $innerDeclaration . '[]';
    }

    public function canRequireSQLConversion(): bool
    {
        return true;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        array_walk_recursive($value, [$this, 'convertToDatabaseCallback'], $platform);

        return self::parseArrayToPg($value);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?array
    {
        if (null !== $value) {
            $value = self::parsePgToArray($value);
            array_walk_recursive($value, [$this, 'convertToPhpCallback'], $platform);
        }

        return $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    /**
     * @see https://web.archive.org/web/20120721205048/http://www.php.net/manual/es/ref.pgsql.php#89841
     * @author cc+php@c2se.com
     */
    protected static function parsePgToArray(string $input, &$output = null, int $limit = null, int $offset = 1)
    {
        if (null === $limit) {
            $limit = strlen($input) - 1;
            $output = [];
        }
        if ('{}' != $input) {
            do {
                if ('{' != $input[$offset]) {
                    preg_match("/(\\{?\"([^\"\\\\]|\\\\.)*\"|[^,{}]+)+([,}]+)/", $input, $match, 0, $offset);
                    $offset += strlen($match[0]);
                    $output[] = ('"' != $match[1][0] ? $match[1] : stripcslashes(substr($match[1], 1, -1)));
                    if ('},' == $match[3]) {
                        return $offset;
                    }
                } else {
                    $offset = self::parsePgToArray($input, $output[], $limit, $offset + 1);
                }
            } while ($limit > $offset);
        }

        return $output;
    }

    public static function parseArrayToPg(array $array): string
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::parseArrayToPg($value);
            }
        }

        return '{' . implode(',', $array) . '}';
    }

    public function getInnerType(): Type
    {
        if (!isset($this->innerType)) {
            $this->innerType = Type::getType($this->innerTypeName);
        }

        return $this->innerType;
    }

    /**
     * @param mixed $v
     * @return mixed
     */
    protected function convertToPhpCallback(&$v, string $k, AbstractPlatform $platform)
    {
        $v = $this->getInnerType()->convertToPHPValue($v, $platform);
    }

    /**
     * @param mixed $v
     * @return mixed
     */
    protected function convertToDatabaseCallback(&$v, string $k, AbstractPlatform $platform)
    {
        $v = $this->getInnerType()->convertToDatabaseValue($v, $platform);
    }
}
