<?php

namespace Joomartin\Utils\Composite;

interface Composite
{
    /**
     * Add an item to items and return its index
     * @param mixed $item
     * @return int
     */
    public function add($item);

    /**
     * Remove the given item from items and returns its index. Returns false if item not found
     * @param mixed $item
     * @return int|bool
     */
    public function remove($item);

    /**
     * Get the item on the given index. Returns null if index not found
     * @param int $index
     * @return mixed
     */
    public function get($index);
}