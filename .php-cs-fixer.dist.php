<?php

use PhpCsFixer\Config;
USE PhpCsFixer\Finder;

$header = <<<'EOF'
AJGL Doctrine DBAL Types

Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PER-CS' => true,
            '@PER-CS:risky' => true,
            '@PHP81Migration' => true,
            '@PHP80Migration:risky' => true,
            'header_comment' => ['header' => $header],
        ]
    )
    ->setFinder(Finder::create()->in(__DIR__))
;
