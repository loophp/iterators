<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use IteratorAggregate;
use loophp\iterators\InterruptableIterableIteratorAggregate;
use PHPUnit\Framework\TestCase;

use function sprintf;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class InterruptableIterableIteratorAggregateTest extends TestCase
{
    public function testBreakInterruption()
    {
        $naturals = static function () {
            $i = 0;

            while (true) {
                yield sprintf('[%s]', $i) => $i++;
            }
        };

        $subject = new InterruptableIterableIteratorAggregate($naturals());

        self::assertSame(
            array_combine(array_map(static fn (int $a): string => sprintf('[%s]', $a), range(0, 10)), range(0, 10)),
            iterator_to_array($this->getSubjectGenerator($subject))
        );
    }

    private function getSubjectGenerator(IteratorAggregate $subject): Generator
    {
        foreach ($subject as $generator => [$key, $value]) {
            yield $key => $value;

            if (10 === $value) {
                $generator->send(InterruptableIterableIteratorAggregate::BREAK);
            }
        }
    }
}
