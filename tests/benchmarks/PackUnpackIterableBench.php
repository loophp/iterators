<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\PackIterableAggregate;
use loophp\iterators\UnpackIterableAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Traversable;

/**
 * @Groups({"PackUnpackIterableBench"})
 * @Iterations(10)
 * @Warmup(1)
 * @Revs(100)
 */
class PackUnpackIterableBench
{
    public function benchIterators(): void
    {
        $generator = static fn (): Generator => yield from range(0, 10000);

        $iterator = new UnpackIterableAggregate((new PackIterableAggregate($generator()))->getIterator());

        $this->test($iterator);
    }

    private function test(Traversable $input): void
    {
        foreach ($input as $key => $value);
    }
}
