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
use function count;

/**
 * @Groups({"CachingIteratorsBench"})
 * @Iterations(15)
 * @Warmup(10)
 * @Revs(100)
 */
class CachingIteratorsBench
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function benchIterators(array $params): void
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

        yield 'loophp\iterators\SimpleCachingIteratorAggregate' => [
            'class' => SimpleCachingIteratorAggregate::class,
            'size' => $items,
        ];

        yield 'loophp\iterators\CachingIteratorAggregate' => [
            'class' => CachingIteratorAggregate::class,
            'size' => $items,
        ];

        yield 'Psl\Iter\Iterator' => [
            'class' => IterIterator::class,
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
        $breakAt = $size / 2;

        $a = iterator_to_array($this->loop($input, $breakAt));
        $b = iterator_to_array($this->loop($input, $breakAt));
        $c = iterator_to_array($this->loop($input, $breakAt));
        $d = iterator_to_array($this->loop($input, $breakAt));

        if (count($a) !== $size) {
            throw new Exception('$a !== $size => Invalid benchmark.');
        }

        if ($a !== $b) {
            throw new Exception('$a !== $b => Invalid benchmark.');
        }

        if ($b !== $c) {
            throw new Exception('$b !== $c => Invalid benchmark.');
        }

        if ($c !== $d) {
            throw new Exception('$c !== $d => Invalid benchmark.');
        }
    }
}
