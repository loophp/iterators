<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators\Contract;

use Iterator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @extends IteratorAggregate<TKey, T>
 */
interface PausableIteratorAggregateInterface extends IteratorAggregate
{
    /**
     * @return Iterator<TKey, T>
     */
    public function rest(): Iterator;
}
