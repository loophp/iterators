<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Exception;
use Generator;
use loophp\iterators\CachingIteratorAggregate;
use loophp\iterators\SimpleCachingIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Psl\Iter\Iterator as IterIterator;
use Traversable;

/**
 * @Groups({"CachingIteratorsBench"})
 * @Iterations(10)
 * @Warmup(1)
 * @Revs(100)
 */
class CachingIteratorsBench
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function benchIterators(array $params): void
    {
        $generator = static fn (): Generator => yield from range(0, $params['items']);

        $iterator = new $params['class']($generator());

        $this->test($iterator);
    }

    public function provideGenerators(): Generator
    {
        $items = 1000;

        yield 'loophp\iterators\SimpleCachingIteratorAggregate' => ['class' => SimpleCachingIteratorAggregate::class, 'items' => $items];

        yield 'loophp\iterators\CachingIteratorAggregate' => ['class' => CachingIteratorAggregate::class, 'items' => $items];

        yield 'Psl\Iter\Iterator' => ['class' => IterIterator::class, 'items' => $items];
    }

    private function test(Traversable $input): void
    {
        $a = $b = [];

        foreach ($input as $key => $value) {
            $a[] = [$key, $value];
        }

        foreach ($input as $key => $value) {
            $b[] = [$key, $value];
        }

        if ($a !== $b) {
            throw new Exception('$a !== $b => Invalid benchmark.');
        }
    }
}
