<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators\Contract;

use IteratorAggregate;
use Traversable;

/**
 * @template TKey
 * @template T
 *
 * @extends IteratorAggregate<TKey, T>
 */
interface PausableIteratorAggregateInterface extends IteratorAggregate
{
    /**
     * @return Traversable<TKey, T>
     */
    public function rest(): Traversable;
}
