<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators\Pagination;

use loophp\iterators\Contract\Pagination\PaginatedResultsInterface;
use loophp\iterators\Pagination\PaginatingIterator;
use loophp\iterators\Pagination\ResultsGenerator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 *
 * @covers \loophp\iterators\Pagination\PaginatingIterator
 */
final class PaginatingIteratorTest extends TestCase
{
    private MockObject $apiMock;

    protected function setUp(): void
    {
        $this->apiMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['__invoke'])
            ->getMock();
    }

    public function testNoResultsWithDefaultPage(): void
    {
        $expected = [
            'keys' => [],
            'values' => [],
        ];

        $this->apiMock
            ->expects(self::once())
            ->method('__invoke')
            ->with(0)
            ->willReturn(self::buildResults([], 5, 0));

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator));
    }

    public function testNoResultsWithGivenPage(): void
    {
        $expected = [
            'keys' => [],
            'values' => [],
        ];

        $this->apiMock
            ->expects(self::once())
            ->method('__invoke')
            ->with(1)
            ->willReturn(self::buildResults([], 5, 1));

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator, 1));
    }

    public function testSinglePageWithResultsCountEqualToSizeAndDefaultPage(): void
    {
        $expected = [
            'keys' => [0],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(2))
            ->method('__invoke')
            ->withConsecutive([0], [1])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    3,
                    0
                ),
                self::buildResults([], 3, 2),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator));
    }

    public function testSinglePageWithResultsCountEqualToSizeAndGivenPage(): void
    {
        $expected = [
            'keys' => [2],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(2))
            ->method('__invoke')
            ->withConsecutive([2], [3])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    3,
                    2
                ),
                self::buildResults([], 3, 3),
            );
        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator, 2));
    }

    public function testSinglePageWithResultsCountUnderSizeAndDefaultPage(): void
    {
        $expected = [
            'keys' => [0],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::once())
            ->method('__invoke')
            ->with(0)
            ->willReturn(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    5,
                    0
                )
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator));
    }

    public function testSinglePageWithResultsCountUnderSizeAndGivenPage(): void
    {
        $expected = [
            'keys' => [2],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::once())
            ->method('__invoke')
            ->with(2)
            ->willReturn(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    5,
                    2
                )
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator, 2));
    }

    public function testThreePagesWithResultsCountEqualToSizeAndDefaultPage(): void
    {
        $expected = [
            'keys' => [0, 1, 2],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                ],
                [
                    (object) ['id' => 3],
                    (object) ['id' => 4],
                ],
                [
                    (object) ['id' => 5],
                    (object) ['id' => 6],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(4))
            ->method('__invoke')
            ->withConsecutive([0], [1], [2], [3])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                    ],
                    2,
                    0
                ),
                self::buildResults(
                    [
                        (object) ['id' => 3],
                        (object) ['id' => 4],
                    ],
                    2,
                    1
                ),
                self::buildResults(
                    [
                        (object) ['id' => 5],
                        (object) ['id' => 6],
                    ],
                    2,
                    2
                ),
                self::buildResults([], 2, 3),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator));
    }

    public function testThreePagesWithResultsCountEqualToSizeAndGivenPage(): void
    {
        $expected = [
            'keys' => [1, 2, 3],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                ],
                [
                    (object) ['id' => 3],
                    (object) ['id' => 4],
                ],
                [
                    (object) ['id' => 5],
                    (object) ['id' => 6],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(4))
            ->method('__invoke')
            ->withConsecutive([1], [2], [3], [4])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                    ],
                    2,
                    1
                ),
                self::buildResults(
                    [
                        (object) ['id' => 3],
                        (object) ['id' => 4],
                    ],
                    2,
                    2
                ),
                self::buildResults(
                    [
                        (object) ['id' => 5],
                        (object) ['id' => 6],
                    ],
                    2,
                    3
                ),
                self::buildResults([], 2, 4),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator, 1));
    }

    public function testThreePagesWithResultsCountUnderSizeAndDefaultPage(): void
    {
        $expected = [
            'keys' => [0, 1, 2],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                ],
                [
                    (object) ['id' => 3],
                    (object) ['id' => 4],
                ],
                [
                    (object) ['id' => 5],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(3))
            ->method('__invoke')
            ->withConsecutive([0], [1], [2])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                    ],
                    2,
                    0
                ),
                self::buildResults(
                    [
                        (object) ['id' => 3],
                        (object) ['id' => 4],
                    ],
                    2,
                    1
                ),
                self::buildResults(
                    [
                        (object) ['id' => 5],
                    ],
                    2,
                    2
                ),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator));
    }

    public function testThreePagesWithResultsCountUnderSizeAndGivenPage(): void
    {
        $expected = [
            'keys' => [1, 2, 3],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                ],
                [
                    (object) ['id' => 3],
                    (object) ['id' => 4],
                ],
                [
                    (object) ['id' => 5],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(3))
            ->method('__invoke')
            ->withConsecutive([1], [2], [3])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                    ],
                    2,
                    1
                ),
                self::buildResults(
                    [
                        (object) ['id' => 3],
                        (object) ['id' => 4],
                    ],
                    2,
                    2
                ),
                self::buildResults(
                    [
                        (object) ['id' => 5],
                    ],
                    2,
                    3
                ),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator, 1));
    }

    public function testTwoPagesWithResultsCountEqualToSizeAndDefaultPage(): void
    {
        $expected = [
            'keys' => [0, 1],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
                [
                    (object) ['id' => 4],
                    (object) ['id' => 5],
                    (object) ['id' => 6],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(3))
            ->method('__invoke')
            ->withConsecutive([0], [1], [2])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    3,
                    0
                ),
                self::buildResults(
                    [
                        (object) ['id' => 4],
                        (object) ['id' => 5],
                        (object) ['id' => 6],
                    ],
                    3,
                    1
                ),
                self::buildResults([], 3, 2),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator));
    }

    public function testTwoPagesWithResultsCountEqualToSizeAndGivenPage(): void
    {
        $expected = [
            'keys' => [2, 3],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
                [
                    (object) ['id' => 4],
                    (object) ['id' => 5],
                    (object) ['id' => 6],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(3))
            ->method('__invoke')
            ->withConsecutive([2], [3], [4])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    3,
                    2
                ),
                self::buildResults(
                    [
                        (object) ['id' => 4],
                        (object) ['id' => 5],
                        (object) ['id' => 6],
                    ],
                    3,
                    3
                ),
                self::buildResults([], 3, 4),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator, 2));
    }

    public function testTwoPagesWithResultsCountUnderSizeAndDefaultPage(): void
    {
        $expected = [
            'keys' => [0, 1],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
                [
                    (object) ['id' => 4],
                    (object) ['id' => 5],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(2))
            ->method('__invoke')
            ->withConsecutive([0], [1])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    3,
                    0
                ),
                self::buildResults(
                    [
                        (object) ['id' => 4],
                        (object) ['id' => 5],
                    ],
                    3,
                    1
                ),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator));
    }

    public function testTwoPagesWithResultsCountUnderSizeAndGivenPage(): void
    {
        $expected = [
            'keys' => [2, 3],
            'values' => [
                [
                    (object) ['id' => 1],
                    (object) ['id' => 2],
                    (object) ['id' => 3],
                ],
                [
                    (object) ['id' => 4],
                    (object) ['id' => 5],
                ],
            ],
        ];

        $this->apiMock
            ->expects(self::exactly(2))
            ->method('__invoke')
            ->withConsecutive([2], [3])
            ->willReturnOnConsecutiveCalls(
                self::buildResults(
                    [
                        (object) ['id' => 1],
                        (object) ['id' => 2],
                        (object) ['id' => 3],
                    ],
                    3,
                    2
                ),
                self::buildResults(
                    [
                        (object) ['id' => 4],
                        (object) ['id' => 5],
                    ],
                    3,
                    3
                ),
            );

        $generator = new ResultsGenerator(fn (int $page): PaginatedResultsInterface => ($this->apiMock)($page));

        self::assertKeysValues($expected, new PaginatingIterator($generator, 2));
    }

    /**
     * @param array{keys: list<int>, values: list<list<stdClass>> $expected
     */
    private static function assertKeysValues(array $expected, PaginatingIterator $iterator): void
    {
        $keys = [];
        $values = [];

        foreach ($iterator as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        self::assertSame($expected['keys'], $keys);
        self::assertEquals($expected['values'], $values);
    }

    /**
     * @param list<stdClass> $content
     *
     * @return PaginatedResultsInterface<stdClass>
     */
    private static function buildResults(array $content, int $size, int $page): PaginatedResultsInterface
    {
        return new class($content, $size, $page) implements PaginatedResultsInterface {
            /**
             * @var list<stdClass>
             */
            private array $content;

            private int $size;

            private int $page;

            /**
             * @param list<stdClass> $content
             */
            public function __construct(array $content, int $size, int $page)
            {
                $this->content = $content;
                $this->size = $size;
                $this->page = $page;
            }

            public function getContent(): array
            {
                return $this->content;
            }

            public function getPage(): int
            {
                return $this->page;
            }

            public function getSize(): int
            {
                return $this->size;
            }
        };
    }
}
