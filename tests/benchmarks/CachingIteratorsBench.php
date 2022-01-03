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
 * @Iterations(10)
 * @Warmup(5)
 * @Revs(200)
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
        $i = 0;

        foreach ($input as $key => $value) {
            if ($breakAt / 2 === $i++) {
                break;
            }
        }

        foreach ($input as $key => $value) {
            yield [$key, $value];
        }
    }

    private function test(Traversable $input, int $size): void
    {
        $a = iterator_to_array($this->loop($input, $size));
        $b = iterator_to_array($this->loop($input, $size));
        $c = iterator_to_array($this->loop($input, $size));
        $d = iterator_to_array($this->loop($input, $size));

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
