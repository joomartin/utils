<?php

namespace Joomartin\Utils\Tests\Composite;

use PHPUnit_Framework_TestCase;
use Joomartin\Utils\Composite\CompositeStub;

class CompositeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CompositeStub
     */
    protected $composite = null;

    /**
     * Added indexes in setUp
     * @var array
     */
    protected $indexes = [];

    protected function setUp()
    {
        $this->composite = new CompositeStub;

        $this->indexes[] = $this->composite->add(12);
        $this->indexes[] = $this->composite->add(13);
        $this->indexes[] = $this->composite->add(14);
    }

    /** @test */
    function it_can_add_single_items()
    {
        // We are extra explicit here
        $composite = new CompositeStub;

        $indexes[] = $composite->add(12);
        $indexes[] = $composite->add(13);
        $indexes[] = $composite->add(14);

        $this->assertEquals(12, $composite->get(0));
        $this->assertEquals(0, $indexes[0]);

        $this->assertEquals(13, $composite->get(1));
        $this->assertEquals(1, $indexes[1]);

        $this->assertEquals(14, $composite->get(2));
        $this->assertEquals(2, $indexes[2]);
    }

    /** @test */
    function it_can_remove_a_single_item()
    {
        $index = $this->composite->remove(12);
        $this->assertEquals(0, $this->indexes[0]);
        $this->assertEquals(null, $this->composite->get($index));

        $index = $this->composite->remove(13);
        $this->assertEquals(1, $index);
        $this->assertEquals(null, $this->composite->get($index));

        $this->assertEquals(14, $this->composite->get(2));
    }

    /** @test */
    function it_returns_false_when_removing_non_existing_item()
    {
        $index = $this->composite->remove(15);
        $this->assertFalse($index);

        $this->assertEquals(12, $this->composite->get(0));
        $this->assertEquals(13, $this->composite->get(1));
    }

    /** @test */
    function it_can_get_a_single_item()
    {
        $this->assertEquals(12, $this->composite->get(0));
        $this->assertEquals(13, $this->composite->get(1));
    }

    /** @test */
    function it_returns_null_when_getting_non_existing_index()
    {
        $this->assertNull($this->composite->get(3));
    }
}