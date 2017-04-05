<?php

namespace Joomartin\Utils\Kohana\Testing;

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
     */
    public function assertDatabaseHas($table, array $attributes)
    {
        $this->assertTrue(
            $this->getCountOf($table, $attributes) !== 0,
            'Failed asserting that database has ' . json_encode($attributes)
        );
    }

    /**
     * @param $table
     * @param array $attributes
     */
    public function assertDatabaseMissing($table, array $attributes)
    {
        $this->assertTrue(
            $this->getCountOf($table, $attributes) === 0,
            'Failed asserting that database missing ' . json_encode($attributes)
        );
    }

    /**
     * @param $table
     * @param array $attributes
     * @return int
     */
    protected function getCountOf($table, array $attributes)
    {
        $query = \DB::select()->from($table);

        foreach ($attributes as $key => $value) {
            $operator = (is_array($value)) ? 'IN' : '=';
            $query->and_where($key, $operator, $value);
        }

        $result = $query->execute()->as_array();
        return count($result);
    }


    /**
     * @param $needle
     * @param array $haystack
     */
    public function assertNotInArray($needle, array $haystack)
    {
        $this->assertFalse(in_array($needle, $haystack));
    }

    /**
     * @param $needle
     * @param array $haystack
     */
    public function assertInArray($needle, array $haystack)
    {
        $this->assertTrue(in_array($needle, $haystack));
    }

    /**
     * @param array $subset
     * @param array $haystack
     */
    public function assertArrayNotSubset(array $subset, array $haystack)
    {
        foreach ($subset as $item) {
            $this->assertNotInArray($item, $haystack);
        }
    }

    /**
     * @param mixed $needle
     * @param string $haystack
     */
    public function assertStringContains($needle, $haystack)
    {
        $this->assertRegexp('/' . $needle . '/', $haystack);
    }

    /**
     * Alias for assertStringContains
     * @param $needle
     * @param $haystack
     */
    public function assertSee($needle, $haystack)
    {
        $this->assertStringContains($needle, $haystack);
    }
}