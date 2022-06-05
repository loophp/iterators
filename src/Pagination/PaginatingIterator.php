<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators\Pagination;

use Iterator;
use loophp\iterators\Contract\Pagination\PaginatedResultsInterface;
use loophp\iterators\Contract\Pagination\ResultsGeneratorInterface;
use function count;

/**
 * @template T
 * @template U
 *
 * @implements Iterator<int, list<T>>
 */
final class PaginatingIterator implements Iterator
{
    /**
     * @var ResultsGeneratorInterface<U>
     */
    private ResultsGeneratorInterface $fetch;

    private int $initialPage;

    private int $page;

    /**
     * @psalm-suppress PropertyNotSetInConstructor
     *
     * @var PaginatedResultsInterface<T>
     */
    private PaginatedResultsInterface $results;

    private bool $valid = true;

    /**
     * @param ResultsGeneratorInterface<U> $fetch
     */
    public function __construct(ResultsGeneratorInterface $fetch, int $page = 0)
    {
        $this->initialPage = $page;
        $this->page = $page;
        $this->fetch = $fetch;
    }

    /**
     * @return list<T>
     */
    public function current(): array
    {
        return $this->results->getContent();
    }

    public function key(): int
    {
        return $this->page;
    }

    public function next(): void
    {
        ++$this->page;

        if (count($this->results->getContent()) === $this->results->getSize()) {
            $this->fetchData();
        } else {
            $this->valid = false;
        }
    }

    public function rewind(): void
    {
        $this->page = $this->initialPage;
    }

    public function valid(): bool
    {
        if ($this->page === $this->initialPage) {
            $this->fetchData();
        }

        return $this->valid && [] !== $this->results->getContent();
    }

    private function fetchData(): void
    {
        $this->results = ($this->fetch)($this->page);
    }
}
