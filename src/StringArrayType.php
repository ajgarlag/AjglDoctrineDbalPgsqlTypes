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

final class StringArrayType extends ArrayTypeAbstract
{
    public const STRINGARRAY = 'string[]';

    protected string $name = self::STRINGARRAY;

    protected string $innerTypeName = 'string';
}
