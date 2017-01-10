# Getting Started

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

## Ordering

By default processors are being registered with priority 0 and are run from higher priority to the lower.

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