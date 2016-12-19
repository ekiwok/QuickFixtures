<?php

namespace spec\Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;

use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory\UseStatementsProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bar;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bizz;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Foo;
use spec\Ekiwok\QuickFixtures\fixtures\classes\UseStatementsWithAliases;

class UseStatementsProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UseStatementsProvider::class);
    }

    function it_correctly_gets_Bizz_use_statement()
    {
        $reflection = new \ReflectionClass(Bizz::class);

        $this->getUseStatements($reflection)->shouldBe(['Nested' => Nested::class]);
    }

    function it_correctly_gets_use_statements_with_aliases()
    {
        $reflection = new \ReflectionClass(UseStatementsWithAliases::class);

        $this->getUseStatements($reflection)->shouldBe([
            'One' => Foo::class,
            'Two' => Foo::class,
            'Three' => Bar::class,
        ]);
    }
}
