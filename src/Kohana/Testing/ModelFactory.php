<?php

namespace Joomartin\Utils\Kohana\Testing;

use Closure;
use Faker\Factory;

class ModelFactory
{
    /**
     * @var ModelFactory
     */
    private static $instance = null;

    /**
     * @var [][]
     */
    protected $factories = [];

    /**
     * @var \Faker\Generator
     */
    protected $faker = null;

    private function __construct()
    {
        $this->faker = Factory::create(hu_HU);
    }

    /**
     * @return ModelFactory
     */
    public static function instance()
    {
        if ( ! static::$instance) {
            static::$instance = new ModelFactory;
        }

        return static::$instance;
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
        $models = $this->make($class, $count, $attributes);

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
        if ( ! isset($this->factories[$class])) {
            throw new \Exception("Factory of {$class} does not exists.");
        }
    }

    /**
     * @param $class
     * @return string
     */
    protected function normalizeModelName($class)
    {
        if ($this->startWithModelPrefix($class)) {
            $class = $this->modelNameWithoutPrefix($class);
        }

        return ucfirst($class);
    }

    /**
     * @param $class
     * @return bool
     */
    protected function startWithModelPrefix($class)
    {
        return strpos(strtolower($class), 'model') !== false;
    }

    /**
     * @param $class
     * @return bool|string
     */
    protected function modelNameWithoutPrefix($class)
    {
        return substr($class, 6);
    }
}