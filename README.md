# QuickFixtures [![Build Status](https://travis-ci.org/ekiwok/QuickFixtures.svg?branch=master)](https://travis-ci.org/ekiwok/QuickFixtures)

- Did you ever add unnecessary setter because you didn't want to use
reflections in fixtures?
- Did you give up on using value objects because writing fixtures this way
was messy?
- Did you create trait to help with \DateTime creation in fixtures?

If anything above applies to you you may find this helpful.

This small library may quickly generate fixtures for you based on
dockblock annotations that probably already are present in your code.

Provided generator accepts associative arrays so you may keep your
fixtures data in file of your choice. It might be yaml, xml, csv, etc...
 
Fe. prepare yaml file like this:
 
 ```yml
     "Jake Weary":
         uuid: "123e4567-e89b-12d3-a456-426655440000"
         name: "Jake Weary"
         email: "jake.weary@example.com"
         # Notice that for single property objects it's ok to skip property name
         credit: 100
 ```
 
 And just use this data to generate fixture:
 
 ```php
     $jakeWearyData = /* fetch "Jake Weary" entry from yml */
 
     $jakeWeary = $generator->generate(Customer::class, $jakeWearyData);
 ```

 
Instead of writing:

```php
    $jakeWeary = new Customer(
        '123e4567-e89b-12d3-a456-426655440000',
        'Jake Weary',
        'jake.weary@example.com',
        new Credit(100),
    );
```

or:

```php
    $jakeWeary = (new Customer())
        ->setUUID('123e4567-e89b-12d3-a456-426655440000')
        ->setName('Jake Weary')
        ->setEmail'jake.weary@example.com')
        ->setCredit(new Credit(100))
    ;
```

## Extending

It's easily extendable by adding your own processors.

```php
    $generator->addProcessor(new class implements \Ekiwok\QuickFixtures\Processor\PrioritisedProcessorInterface{
    
        public function getPriority()
        {
            return 1025;
        }
    
        public function process(\Ekiwok\QuickFixtures\ContextInterface $context, $payload, \Ekiwok\QuickFixtures\GeneratorInterface $generator)
        {
            return new \DateTime($payload);
        }
    
        public function applies(\Ekiwok\QuickFixtures\ContextInterface $context, $payload)
        {
            $type = $context->getType();
            
            // in real life we would also check payload to be sure it
            // also makes sense
    
            return $type->hasAnyClass()
                && $type->hasClass(\DateTime::class);
        }
    });
```

Processor with this priority will be run before built in processors
and will set all properties these are marked as `@var \DateTime`.
 
## Documentation

- [Getting Started](/doc/Getting_Started.md)
- [Processors](/doc/Processors.md)
