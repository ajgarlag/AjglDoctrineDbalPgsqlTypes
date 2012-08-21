<?php

namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class ArrayTypeAbstract extends Type {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $innerTypeName;

    /**
     * @var Type
     */
    protected $innerType;

    /**
     * @inheritdoc
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function canRequireSQLConversion() {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) {
        array_walk_recursive($value, array($this, 'convertToDatabaseCallback', $platform));
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) {
        $value = self::parsePgArray($value);
        array_walk_recursive($value, array($this, 'convertToPhpCallback', $platform));
        return $value;
    }

    /**
     * @see http://www.php.net/manual/es/ref.pgsql.php#89841
     * @param string $text
     * @param array $output
     * @param boolean $limit
     * @param integer $offset
     * @return array
     */
    public static function parsePgToArray($text, &$output=null, $limit=false, $offset=1)
    {
        if (false === $limit) {
            $limit = strlen($text) - 1;
            $output = array();
        }
        if ('{}' != $text)
            do {
                if ('{' != $text{$offset}) {
                    preg_match("/(\\{?\"([^\"\\\\]|\\\\.)*\"|[^,{}]+)+([,}]+)/", $text, $match, 0, $offset);
                    $offset += strlen($match[0]);
                    $output[] = ( '"' != $match[1]{0} ? $match[1] : stripcslashes(substr($match[1], 1, -1)) );
                    if ('},' == $match[3])
                        return $offset;
                }
                else
                    $offset = self::parsePgToArray($text, $output[], $limit, $offset + 1);
            }
            while ($limit > $offset);
        return $output;
    }

    public function parseArrayToPg(array $input, &$output = '')
    {
        foreach ($input as $value)
        {
            if (is_array($value)) {

            }
        }
    }

    /**
     * @return Type
     */
    protected function getInnerType()
    {
        if (null === $this->innerType) {
            $this->innerType = Type::getType($this->innerTypeName);
        }

        return $this->innerType;
    }

    /**
     * @param scalar $v
     * @param string $k
     * @param mixed $userData
     */
    protected function convertToPhpCallback(&$v, $k, AbstractPlatform $platform)
    {
        $v = $this->getInnerType()->convertToPHPValue($v, $platform);
    }

    /**
     * @param scalar $v
     * @param string $k
     * @param mixed $userData
     */
    protected function convertToDatabaseCallback(&$v, $k, AbstractPlatform $platform)
    {
        $v = $this->getInnerType()->convertToDatabaseValue($v, $platform);
    }
}
