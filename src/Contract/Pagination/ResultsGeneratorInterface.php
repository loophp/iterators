<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators\Contract\Pagination;

use Closure;

/**
 * @template T
 */
interface ResultsGeneratorInterface
{
    /**
     * @param Closure(int): T $generator
     */
    public function __construct(Closure $generator);

    /**
     * @return T
     */
    public function __invoke(int $page = 0);
}
