<?php

namespace Joomartin\Utils\Tests\Kohana\Testing;

use Faker\Factory;
use Faker\Generator;
use Joomartin\Utils\Kohana\Testing\ModelFactory;
use PHPUnit_Framework_TestCase;

class ModelFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    /** @test */
    public function it_can_define_a_new_factory()
    {
        $factory = new ModelFactory;

        $factory->define('Foo', function (Generator $faker) {
            return [
                'name'        => $faker->word,
                'description' => $faker->paragraph,
                'price'       => 12
            ];
        });

        $factory->define('Bar', function (Generator $faker) {
            return [
                'title' => $faker->word,
                'body'  => $faker->paragraph,
            ];
        });

        $this->assertArrayHasKey('Foo', $factory->getFactories());
        $this->assertArrayHasKey('Bar', $factory->getFactories());
    }

    /** @test */
    public function it_throws_an_exception_when_try_to_create_non_existing_class()
    {
        $factory = new ModelFactory;

        $this->expectException('Exception');
        $factory->create('NonExistingClass');
    }
}
