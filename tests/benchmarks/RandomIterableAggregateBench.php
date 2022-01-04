<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Exception;
use Generator;
use loophp\iterators\RandomIterableAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Traversable;
use function count;

/**
 * @Groups({"RandomIterableAggregateBench"})
 * @Iterations(10)
 * @Warmup(1)
 * @Revs(100)
 */
class RandomIterableAggregateBench
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function benchIterator(array $params): void
    {
        $this->test(
            new $params['class']($this->getGenerator($params)),
            $params['size']
        );
    }

    public function provideGenerators(): Generator
    {
        $items = 5000;

        yield RandomIterableAggregate::class => [
            'class' => RandomIterableAggregate::class,
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

    private function test(Traversable $input, int $size): void
    {
        $a = iterator_to_array($this->loop($input));

        if (count($a) !== $size) {
            throw new Exception('$a !== $size => Invalid benchmark.');
        }
    }
}
