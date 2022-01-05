<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\SimpleCachingIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Traversable;

/**
 * @Groups({"internal"})
 * @Iterations(5)
 * @Warmup({1, 5, 10})
 * @Revs({10, 50, 100, 150})
 */
final class SimpleCachingIteratorsAggregateBench
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function benchIterator(array $params): void
    {
        $generator = static function (int $from, int $to): Generator {
            for ($i = $from; $i < $to; ++$i) {
                yield $i;
            }
        };

        $iterator = new $params['class']($generator(0, $params['size']));

        $this->test($iterator, $params['size']);
    }

    public function provideGenerators(): Generator
    {
        $items = 5000;

        yield SimpleCachingIteratorAggregate::class => [
            'class' => SimpleCachingIteratorAggregate::class,
            'size' => $items,
        ];
    }

    private function loop(Traversable $input, int $breakAt): Generator
    {
        foreach ($input as $key => $value) {
            if (0 === $breakAt--) {
                break;
            }
        }

        foreach ($input as $key => $value) {
            yield [$key, $value];
        }
    }

    private function test(Traversable $input, int $size): void
    {
        iterator_to_array($this->loop($input, $size / 2));
    }
}
