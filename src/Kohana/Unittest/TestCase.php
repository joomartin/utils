<?php

namespace Joomartin\Utils\Kohana\Unittest;

use PHPUnit_Framework_TestCase;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @param $object
     * @param $methodName
     * @param array $parameters
     * @return mixed
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection 	= new \ReflectionClass(get_class($object));
        $method 		= $reflection->getMethod($methodName);

        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @param $table
     * @param array $attributes
     * @return bool
     */
    public function assertDatabaseHas($table, array $attributes)
    {
        $query = DB::select()->from($table);

        foreach ($attributes as $key => $value) {
            $query->and_where($key, '=', $value);
        }

        $result = $query->execute()->as_array();
        return count($result) !== 0;
    }

    /**
     * @param $item
     * @param array $array
     */
    public function assertNotInArray($item, array $array)
    {
        $this->assertFalse(in_array($item, $array));
    }

    /**
     * @param $item
     * @param array $array
     */
    public function assertInArray($item, array $array)
    {
        $this->assertTrue(in_array($item, $array));
    }

    /**
     * @param array $subset
     * @param array $array
     */
    public function assertArrayNotSubset(array $subset, array $array)
    {
        foreach ($subset as $item) {
            $this->assertNotInArray($item, $array);
        }
    }
}