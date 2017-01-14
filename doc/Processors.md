# Processors

Default Generator processes data using processors.

There are four default processors:

- ScalarProcessor
- AnyClassProcessor
- TypedArraysProcessor
- SinglePropertyClassProcessor

There is also abstract processor that might be used to add concrete processor in concrete path fe. `customer.password`:

- AbstractPathProcessor

You may add processor implementing `ProcessorInterface` by `$generator->addProcessor($myProcessor);`

```php
namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

interface ProcessorInterface
{
    /**
     * @param ContextInterface $context
     * @param mixed $payload
     * @param GeneratorInterface $generator
     *
     * @return mixed
     *
     * @throws UnsupportedPayloadException
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator);

    /**
     * @param ContextInterface $context
     * @param mixed $payload
     *
     * @return mixed
     */
    public function applies(ContextInterface $context, $payload);
}

```
Method `applies(ContextInterface $context, $payload)` is being called before `process(ContextInterface $context, $payload, GeneratorInterface $generator)` is. It must return true only in case when processor is able to process payload with given context. It means that process method should throw `UnsupportedPayloadException` only in fatal error situation like when applies wasn't called before.

## Ordering

By default processors are being registered with priority 0 and are run in descending order (from the highest priority to the lowest).

Processors with the same priority are being run in the registration order (from registered earlier to registered later).

You may implement `PrioritisedProcessorInterface` to return desired priority.

Built in processors have following priority declared in `PrioritisedProcessorInterface`:

```php
    const BUILT_IN_PROCESSORS_PRIORITIES = [
            AbstractPathProcessor::class        => 1024,
            TypedArraysProcessor::class         => 255,
            AnyClassProcessor::class            => 0,
            ScalarProcessor::class              => -255,
            SinglePropertyClassProcessor::class => -1024,
        ];
```
## TypedArrayProcessor

This processor is responsible for processing arrays of given type. For example `@var Product[]` or `@var int[]` and runs generator for each property with context being fixed type.

## AnyClassProcessor

This processor will process any class if given context is an array and will run generator recursively on all properties.

## ScalarProcessor

Processes scalar values.

- string accepts strings, integers and doubles
- double accepts doubles, integers and strings these might be casted to double
- integer accepts integers and strings these might be casted to integer
- boolean accepts boolean values only

## SinglePropertyClassProcessor

Processes single property objects. If payload's type matches single property type it will instantiate object with payload as property's value.
