<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

use loophp\iterators\ClosureIterator;

include __DIR__ . '/../../vendor/autoload.php';

/**
 * @param Iterator<int, int> $iterator
 */
function closureIterator_checkList(Iterator $iterator): void
{
}

/**
 * @param Iterator<string, bool> $iterator
 */
function closureIterator_checkMap(Iterator $iterator): void
{
}

$callableIntInt =
    /**
     * @return Generator<int, int>
     */
    static fn () => yield from range(1, 3);

$callableStringBool =
    /**
     * @return Generator<string, bool>
     */
    static fn () => yield uniqid() => (mt_rand(0, 1) === 1 ? true : false);

closureIterator_checkList(new ClosureIterator($callableIntInt));
closureIterator_checkMap(new ClosureIterator($callableStringBool));
