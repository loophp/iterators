<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators\Contract\Pagination;

/**
 * @template T
 */
interface PaginatedResultsInterface
{
    /**
     * @return list<T>
     */
    public function getContent(): array;

    public function getPage(): int;

    public function getSize(): int;
}
