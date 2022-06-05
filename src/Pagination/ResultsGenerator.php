<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators\Pagination;

use Closure;
use loophp\iterators\Contract\Pagination\ResultsGeneratorInterface;

/**
 * @template T
 *
 * @implements ResultsGeneratorInterface<T>
 *
 * @immutable
 */
final class ResultsGenerator implements ResultsGeneratorInterface
{
    /**
     * @var Closure(int): T
     */
    private Closure $generator;

    /**
     * @param Closure(int): T $generator
     */
    public function __construct(Closure $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return T
     */
    public function __invoke(int $page = 0)
    {
        return ($this->generator)($page);
    }
}
