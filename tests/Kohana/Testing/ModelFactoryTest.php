<?php

namespace Joomartin\Utils\Tests\Kohana\Testing;

use Faker\Factory;
use Faker\Generator;
use Joomartin\Utils\Kohana\Testing\ModelFactory;
use Joomartin\Utils\Kohana\Testing\TestCase;

class ModelFactoryTest extends TestCase
{
    protected $faker;

    /**
     * @var ModelFactory
     */
    protected $factory;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create('hu_Hu');
        $this->factory = ModelFactory::instance();
    }

    /** @test */
    public function it_can_define_a_new_factory()
    {

        $this->factory->define('Foo', function (Generator $faker) {
            return [
                'name'        => $faker->word,
                'description' => $faker->paragraph,
                'price'       => 12
            ];
        });

        $this->factory->define('Bar', function (Generator $faker) {
            return [
                'title' => $faker->word,
                'body'  => $faker->paragraph,
            ];
        });

        $this->assertArrayHasKey('Foo', $this->factory->getFactories());
        $this->assertArrayHasKey('Bar', $this->factory->getFactories());
    }

    /** @test */
    public function it_throws_an_exception_when_try_to_create_non_existing_class()
    {

        $this->expectException('Exception');
        $this->factory->create('NonExistingClass');
    }

    /** @test */
    public function it_can_normalize_a_given_model_name()
    {
        $name = $this->invokeMethod($this->factory, 'normalizeModelName', ['Model_Product']);
        $this->assertEquals('Product', $name);

        $name = $this->invokeMethod($this->factory, 'normalizeModelName', ['model_product']);
        $this->assertEquals('Product', $name);

        $name = $this->invokeMethod($this->factory, 'normalizeModelName', ['Product']);
        $this->assertEquals('Product', $name);

        $name = $this->invokeMethod($this->factory, 'normalizeModelName', ['product']);
        $this->assertEquals('Product', $name);
    }
}
