<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\IterableIterator;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use Traversable;

/**
 * @Groups({"ci", "local"})
 */
final class IterableIteratorBench
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

        yield IterableIterator::class => [
            'class' => IterableIterator::class,
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

    private function test(IterableIterator $input): void
    {
        iterator_to_array($this->loop($input));
    }
}
