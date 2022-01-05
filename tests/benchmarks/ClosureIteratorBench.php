<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Closure;
use Generator;
use loophp\iterators\ClosureIterator;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Traversable;

/**
 * @Groups({"internal"})
 * @Iterations(5)
 * @Warmup(5)
 * @Revs({10, 50, 100, 150})
 */
final class ClosureIteratorBench
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function benchIterator(array $params): void
    {
        $callable = Closure::fromCallable([ClosureIteratorBench::class, 'loop']);

        $this->test(
            new $params['class']($callable, [$this->getGenerator($params)]),
            $params['size']
        );
    }

    public function provideGenerators(): Generator
    {
        $items = 5000;

        yield ClosureIterator::class => [
            'class' => ClosureIterator::class,
            'size' => $items,
        ];
    }

    private function getGenerator(array $params): Generator
    {
        for ($i = 0; $i < $params['size']; ++$i) {
            yield [$i, sprintf('*%s*', $i)];
        }
    }

    private function loop(Traversable $input): Generator
    {
        foreach ($input as $key => $value) {
            yield [$key, $value];
        }
    }

    private function test(ClosureIterator $input): void
    {
        iterator_to_array($this->loop($input));
    }
}
