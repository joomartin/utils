<?php

namespace Joomartin\Utils\Composite;

trait CompositeTrait
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * Add an item to items and return its index
     * @param mixed $item
     * @return int
     */
    public function add($item)
    {
        $this->items[] = $item;
        return key(array_slice($this->items, -1, 1, true));
    }

    /**
     * Remove the given item from items and returns its index. Returns false if item not found
     * @param mixed $item
     * @return int|bool
     */
    public function remove($item)
    {
        $index = array_search($item, $this->items);
        if ($index !== false) {
            unset($this->items[$index]);
        }

        return $index;
    }

    /**
     * Get the item on the given index. Returns null if index not found
     * @param int $index
     * @return mixed
     */
    public function get($index)
    {
        if (isset($this->items[$index])) {
            return $this->items[$index];
        }

        return null;
    }
}
