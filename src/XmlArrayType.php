<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class XmlArrayType extends ArrayTypeAbstract
{
    const XMLARRAY = 'xml[]';

    protected $name = self::XMLARRAY;

    protected $innerTypeName = 'xml';
}
