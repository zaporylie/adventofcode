<?= "<?php\n" ?>

namespace App\Tests\Utils;

use App\Utils\<?= $service_class_name ?>;
use PHPUnit\Framework\TestCase;

/**
 * Class <?= $service_test_class_name ?>
 * @package App\Tests\Utils
 */
class <?= $service_test_class_name ?> extends TestCase
{
    /**
     * Tests day <?= $number ?> task.
     *
     * @param array $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(array $input, int $expected)
    {
        $service = new <?= $service_class_name ?>();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield [[], 0];
    }

    /**
     * Tests day <?= $number ?> extra task.
     *
     * @param array $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(array $input, int $expected)
    {
        $service = new <?= $service_class_name ?>();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield [[], 0];
    }

}
