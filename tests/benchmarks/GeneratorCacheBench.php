<?php

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Exception;
use Generator;
use loophp\iterators\CachingIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Traversable;
use Psl\Iter\Iterator as IterIterator;

/**
 * @Groups({"GeneratorCache"})
 * @Iterations(10)
 * @Warmup(1)
 * @Revs(100)
 */
class GeneratorCacheBench
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function benchIterators(array $params): void
    {
        $generator = static function(): Generator
        {
            yield true => true;
            yield false => false;
            yield ['a'] => ['a'];
            yield from range(0, 250);
        };

        $iterator = new $params['class']($generator());

        $this->test($iterator);
    }

    public function provideGenerators(): Generator
    {
        yield 'loophp/iterators' => ['class' => CachingIteratorAggregate::class];
        yield 'azjezz/psl' => ['class' => IterIterator::class];
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
            throw new Exception('$a !== $b');
        }
    }
}
