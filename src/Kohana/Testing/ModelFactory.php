<?php

namespace Joomartin\Utils\Kohana\Testing;

use Closure;
use Faker\Factory;

class ModelFactory
{
    /**
     * @var [][]
     */
    protected $factories = [];

    /**
     * @var \Faker\Generator
     */
    protected $faker = null;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @return [][]
     */
    public function getFactories()
    {
        return $this->factories;
    }

    /**
     * @param string $class
     * @param Closure $closure
     * @return $this
     */
    public function define($class, Closure $closure)
    {
        $this->factories[$class] = $closure;

        return $this;
    }

    /**
     * Create instance of the given class, and persists it.
     * If $count given, then it returns $count objects, otherwise it creates a single instance.
     *
     * @param $class
     * @param array $attributes
     * @param int $count
     * @return \ORM
     */
    public function create($class, $count = 1, array $attributes = [])
    {
        $models = $this->make($class, $attributes, $count);

        if ($count == 1) {
            $models->save();
        } else {
            foreach ($models as $model) {
                $model->save();
            }
        }

        return $models;
    }

    /**
     * Makes instance of the given class, and does not persists it.
     * If $count given, then it returns $count objects, otherwise it makes a single instance.
     *
     * @param string $class
     * @param array $attributes
     * @param int $count
     * @return \ORM
     */
    public function make($class, $count = 1, array $attributes = [])
    {
        $this->guardAgainstNonExistingModel($class);
        $models = [];

        foreach (range(1, $count) as $i) {
            $models[] = $this->makeModelFrom($class, $attributes);
        }

        return ($count == 1) ? $models[0] : $models;
    }

    /**
     * @param $class
     * @param array $attributes
     * @return \ORM
     */
    protected function makeModelFrom($class, array $attributes = [])
    {
        $model = \ORM::factory($this->normalizeModelName($class));
        $fakerAttributes = $this->factories[$class]($this->faker);
        $mergedAttributes = array_merge($fakerAttributes, $attributes);

        foreach ($mergedAttributes as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    /**
     * @param $class
     * @throws \Exception
     */
    protected function guardAgainstNonExistingModel($class)
    {
        if (!isset($this->factories[$class])) {
            throw new \Exception("Factory of {$class} does not exists.");
        }
    }

    /**
     * @param $class
     * @return string
     */
    protected function normalizeModelName($class)
    {
        if (strpos(strtolower($class), 'model') !== false) {
            return ucfirst(substr($class, 6));
        }

        return ucfirst($class);
    }
}