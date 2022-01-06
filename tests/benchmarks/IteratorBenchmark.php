<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use Traversable;

abstract class IteratorBenchmark
{
    /**
     * @ParamProviders("provideGenerators")
     */
    abstract public function bench(array $params): void;

    abstract public function provideGenerators(): Generator;

    protected function doBench(Traversable $input, array $params): void
    {
        iterator_to_array($this->loop($input));
    }

    protected function getGenerator(array $params): Generator
    {
        for ($i = 0; $i < $params['size']; ++$i) {
            yield [$i, sprintf('*%s*', $i)];
        }
    }

    protected function getSubject(array $params): Traversable
    {
        return new $params['class']($this->getGenerator($params));
    }

    protected function loop(Traversable $input): Generator
    {
        foreach ($input as $key => $value) {
            yield [$key, $value];
        }
    }

    protected function loopUntil(Traversable $input, array $params): Generator
    {
        $breakAt = $params['size'] / 2;

        foreach ($input as $key => $value) {
            yield $key => $value;

            if (0 === $breakAt--) {
                break;
            }
        }
    }
}
