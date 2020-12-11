<?php
namespace Ajgl\Doctrine\DBAL\Types;

class XmlArrayType extends ArrayTypeAbstract
{
    const XMLARRAY = 'xml[]';

    protected $name = self::XMLARRAY;

    protected $innerTypeName = 'xml';
}
