<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use IteratorAggregate;
use loophp\iterators\InterruptableIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class InterruptableIteratorAggregateTest extends TestCase
{
    public function testBreakInterruption()
    {
        $naturals = static function () {
            $i = 0;

            while (true) {
                yield $i++;
            }
        };

        $subject = new InterruptableIteratorAggregate($naturals());

        self::assertSame(
            range(0, 10),
            iterator_to_array($this->getSubjectGenerator($subject))
        );
    }

    private function getSubjectGenerator(IteratorAggregate $subject): Generator
    {
        foreach ($subject as $generator => [$key, $value]) {
            yield $key => $value;

            if (10 === $value) {
                $generator->send(InterruptableIteratorAggregate::BREAK);
            }
        }
    }
}
