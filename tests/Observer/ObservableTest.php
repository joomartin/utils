<?php

namespace Joomartin\Utils\Tests\Observer;

use PHPUnit_Framework_TestCase;
use Joomartin\Utils\Observer\Observable;
use Joomartin\Utils\Observer\ObservableStub;
use Joomartin\Utils\Observer\Observer;

class ObservableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Observable
     */
    protected $observable = null;

    /** @test */
    function it_can_attach_an_observer()
    {
        $observable = new ObservableStub;
        $observer1 = $this->prophesize(Observer::class)->reveal();
        $observer2 = $this->prophesize(Observer::class)->reveal();

        $observable->attach($observer1);
        $observable->attach($observer2);

        $this->assertEquals([$observer1, $observer2], $observable->observers());
    }

    /** @test */
    function it_can_detach_an_observer()
    {
        $observable = new ObservableStub;
        $observer1 = $this->prophesize(Observer::class)->reveal();
        $observer2 = $this->prophesize(Observer::class)->reveal();

        $observable->attach($observer1);
        $observable->attach($observer2);

        $observable->detach($observer1);

        $this->assertTrue(in_array($observer2, $observable->observers()));
        $this->assertFalse(in_array($observer1, $observable->observers()));

        $observable->detach($observer2);
        $this->assertEmpty($observable->observers());
    }

    /** @test */
    function it_can_notify_all_of_its_observers()
    {
        $observable = new ObservableStub;
        $observer1 = $this->prophesize(Observer::class);
        $observer2 = $this->prophesize(Observer::class);

        $observer1->notify($observable)->shouldBeCalled();
        $observer2->notify($observable)->shouldBeCalled();

        $observable->attach($observer1->reveal());
        $observable->attach($observer2->reveal());

        $observable->notifyObservers();

        $data = ['foo' => 'bar'];
        $observer1->notify($data)->shouldBeCalled();
        $observer2->notify($data)->shouldBeCalled();

        $observable->notifyObservers($data);
    }
}