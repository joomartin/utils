<?php

use Joomartin\Utils\Composite\Composite;
use Joomartin\Utils\Composite\CompositeTrait;

require __DIR__ . '/../vendor/autoload.php';

class Product
{
    protected $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
}

class CompositeProduct extends Product implements Composite
{
    use CompositeTrait;

    public function getPrice()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getPrice();
        }

        return $sum;
    }
}

class CompositeClient
{
    /**
     * @var Composite
     */
    private $composite;

    /**
     * CompositeClient constructor.
     * @param Composite $composite
     */
    public function __construct(Composite $composite)
    {
        $this->composite = $composite;
    }

    public function doGetPrice()
    {
        return $this->composite->getPrice();
    }
}

$simpleProduct = new Product(199);
$simpleProduct1 = new Product(19);
$compositeProduct = new CompositeProduct(0);

$compositeProduct->add($simpleProduct);
$compositeProduct->add($simpleProduct1);

$client = new CompositeClient($compositeProduct);
var_dump($client->doGetPrice());