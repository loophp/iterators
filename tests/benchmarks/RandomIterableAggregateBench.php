<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\RandomIterable;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Traversable;

/**
 * @Groups({"GeneratorCache"})
 * @Iterations(10)
 * @Warmup(1)
 * @Revs(100)
 */
class RandomIterableAggregateBench
{
    public function benchIteratorAggregate(): void
    {
        $input = static function (): Generator {
            yield from array_combine(range('a', 'z'), range('a', 'z'));
        };

        $seed = 4321;

        $iterator = new RandomIterable($input(), $seed);

        $this->test($iterator);
    }

    private function test(Traversable $input): void
    {
        foreach ($input as $key => $value);
    }
}
