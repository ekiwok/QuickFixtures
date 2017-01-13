# Getting Started

To get instance of generator that will be ready to work with default processors use GeneratorFactory.

```php
use Ekiwok\QuickFixtures\Factory\GeneratorFactory;

$generator = (new GeneratorFactory)->create();
```

This will create generator with following default processors registered:

- ScalarProcessor
- AnyClassProcessor
- TypedArraysProcessor
- SinglePropertyClassProcessor

This default generator with these default processors will be able to 
generate objects built from scalar types and other similar objects.

Given following classes:

```php

class Money
{
    /**
     * @var int
     */
    private $money;
    
    /* ... */
}

class Product
{
     /**
      * @var string
      */
     private $name;
     
     /**
      * @var Money
      */
     private $price;
     
     /* ... */
}

class Order
{
    /**
     * @var string
     */
    private $orderId;

    /**
     * @var string
     */
    private $customerId;
    
     /**
      * @var Money
      */
     private $totalAmount;
     
     /**
      * @var Product[]
      */
     private $products = [];
     
     /* ... */
}

```

You can generate order fixture:

```php

$generator->generate(Order::class, [
    'orderId' => 'e2314567-e89b-12d3-a456-427655440000'
    'customerId' => '123e4567-e89b-12d3-a456-426655440000',
    'totalAmount' => 134000,
    'products' => [
        ['name' => 'product1', 'price' => 100000],
        ['name' => 'product2', 'price' => 34000],
    ]
])

```

You can set concrete processor at chosen path, for example when you want to use your own service:
 
```php
use Ekiwok\QuickFixtures\Processor\AbstractPathProcessor;

$generator->addProcesor(new class(OrderIdGenerator $orderIdGenerator) extends AbstractPathProcessor{
    
    private $orderIdGenerator;
    
    public function __construct(OrderIdGenerator $orderIdGenerator)
    {
        $this->orderIdGenerator = $orderIdGenerator;
    }
    
    public function getPath()
    {
        return 'orderId';
    }
    
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        return $this->orderIdGenerator->generateId();
    }
});

$generator->generate(Order::class, [
    'orderId' => 'will be overriden',
    'customerId' => '123e4567-e89b-12d3-a456-426655440000',
    'totalAmount' => 134000,
    'products' => [
        ['name' => 'product1', 'price' => 100000],
        ['name' => 'product2', 'price' => 34000],
    ]
])
```
