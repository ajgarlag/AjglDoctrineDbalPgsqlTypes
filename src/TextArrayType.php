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

final class TextArrayType extends ArrayTypeAbstract
{
    public const TEXTARRAY = 'text[]';

    protected string $name = self::TEXTARRAY;

    protected string $innerTypeName = 'text';
}
