<?php

use Joomartin\Utils\Observer\Observable;
use Joomartin\Utils\Observer\ObservableTrait;
use Joomartin\Utils\Observer\Observer;

require __DIR__ . '/../vendor/autoload.php';

class MyObservable implements Observable
{
    use ObservableTrait;
}

class MyObserver implements Observer
{
    /**
     * Notify the Observer, and pass any data to it.
     * @param $data
     * @return void
     */
    public function notify($data = null)
    {
        var_dump($data);
    }
}

class ObserverClient
{
    /**
     * @var Observable
     */
    private $observable;

    /**
     * Client constructor.
     * @param Observable $observable
     */
    public function __construct(Observable $observable)
    {
        $this->observable = $observable;
    }

    public function doNotify()
    {
        $this->observable->notifyObservers('hello world');
    }
}

$observable = new MyObservable;

$observer1 = new MyObserver;
$observer2 = new MyObserver;

$observable->attach($observer1);
$observable->attach($observer2);

$client = new ObserverClient($observable);
$client->doNotify();