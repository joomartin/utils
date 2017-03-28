<?php

namespace Joomartin\Utils\Observer;

interface Observable
{
    /**
     * Add the given Observer to its observers
     * @param Observer $observer
     */
    public function attach(Observer $observer);

    /**
     * Remove the given Observer from its observers
     * @param Observer $observer
     * @return mixed
     */
    public function detach(Observer $observer);

    /**
     * Notifies all of its observers with the given data
     * @param mixed $data
     */
    public function notifyObservers($data = null);
}