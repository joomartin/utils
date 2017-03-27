<?php

namespace Utils\Observer;

interface Observer
{
    /**
     * Notify the Observer, and pass any data to it.
     * @param $data
     * @return void
     */
    public function notify($data);
}