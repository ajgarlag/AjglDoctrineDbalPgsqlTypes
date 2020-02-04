<?php

namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class ArrayTypeAbstract extends Type
{
    /**
     * @var string
     * @override
     */
    protected $name;

    /**
     * @var string
     * @override
     */
    protected $innerTypeName;

    /**
     * @var Type
     */
    protected $innerType;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  array            $fieldDeclaration
     * @param  AbstractPlatform $platform
     * @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $innerDeclaration = $this->getInnerType()->getSQLDeclaration($fieldDeclaration, $platform);
        if (substr($innerDeclaration, -2) == '()') {
            $innerDeclaration = substr($innerDeclaration, 0, -2);
        }

        return $innerDeclaration . '[]';
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
        array_walk_recursive($value, array($this, 'convertToDatabaseCallback'), $platform);

        return self::parseArrayToPg($value);
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null !== $value) {
            $value = self::parsePgToArray($value);
            array_walk_recursive($value, array($this, 'convertToPhpCallback'), $platform);
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    /**
     * @see https://web.archive.org/web/20120721205048/http://www.php.net/manual/es/ref.pgsql.php#89841
     * @author cc+php@c2se.com
     * @param  string  $input
     * @param  array   $output
     * @param  boolean $limit
     * @param  integer $offset
     * @return array
     */
    public static function parsePgToArray($input, &$output=null, $limit=false, $offset=1)
    {
        if (false === $limit) {
            $limit = strlen($input) - 1;
            $output = array();
        }
        if ('{}' != $input) {
            do {
                if ('{' != $input{$offset}) {
                    preg_match("/(\\{?\"([^\"\\\\]|\\\\.)*\"|[^,{}]+)+([,}]+)/", $input, $match, 0, $offset);
                    $offset += strlen($match[0]);
                    $output[] = ( '"' != $match[1]{0} ? $match[1] : stripcslashes(substr($match[1], 1, -1)) );
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

    public static function parseArrayToPg($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::parseArrayToPg($value);
            }
        }

        return '{' . implode(',', $array) . '}';
    }

    /**
     * @return Type
     */
    public function getInnerType()
    {
        if (null === $this->innerType) {
            $this->innerType = Type::getType($this->innerTypeName);
        }

        return $this->innerType;
    }

    /**
     * @param scalar $v
     * @param string $k
     * @param mixed  $userData
     */
    protected function convertToPhpCallback(&$v, $k, AbstractPlatform $platform)
    {
        $v = $this->getInnerType()->convertToPHPValue($v, $platform);
    }

    /**
     * @param scalar $v
     * @param string $k
     * @param mixed  $userData
     */
    protected function convertToDatabaseCallback(&$v, $k, AbstractPlatform $platform)
    {
        $v = $this->getInnerType()->convertToDatabaseValue($v, $platform);
    }
}
