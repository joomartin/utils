<?php

namespace Joomartin\Utils\Observer;

trait ObservableTrait
{
    /**
     * @var Observer[]
     */
    protected $observers = [];

    /**
     * Add the given Observer to its observers
     * @param Observer $observer
     */
    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * Remove the given Observer from its observers
     * @param Observer $observer
     * @return mixed
     */
    public function detach(Observer $observer)
    {
        $index = array_search($observer, $this->observers);
        if ($index !== false) {
            unset($this->observers[$index]);
        }

        return $index;
    }

    /**
     * Notifies all of its observers with the given data
     * @param mixed $data
     */
    public function notifyObservers($data = null)
    {
        $data = ($data) ? $data : $this;
        foreach ($this->observers as $observer) {
            $observer->notify($data);
        }
    }

    /**
     * Returns all observers
     * @return Observer[]
     */
    public function observers()
    {
        return $this->observers;
    }
}