# yaml-fixtures

Very simple example showing how data from yml file might be quickly
pass to the generator.

```php
$data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . "/Resources/fixtures.yml"));

$customers = [];

foreach ($data as $piece) {
    $customers[] = $generator->generate(Customer::class, $piece);
}

print_r($customers);
```

```yml
"John W.":
  wallet:
    cards:
      -
        credit: "45987"
        address:
          city: "Franklin"
          zipCode: "94110"
          line1: "Fog st."
          line2: "Apt. 34"
      -
        credit: "0"
        address:
          city: "Franklin"
          zipCode: "94110"
          line1: "Fog st."
          line2: "Apt. 34"
"Mr. T":
  wallet:
    cards:
      -
        credit: "98945"
        address:
          city: "Neverland"
          zipCode: "22110"
          line1: "Line1"
          line2: "Line2"
```

```php
Array
(
    [0] => Ekiwok\QuickFixtures\Examples\YML\Model\Customer Object
        (
            [wallet:Ekiwok\QuickFixtures\Examples\YML\Model\Customer:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Wallet Object
                (
                    [cards:Ekiwok\QuickFixtures\Examples\YML\Model\Wallet:private] => Array
                        (
                            [0] => Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard Object
                                (
                                    [credit:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Money Object
                                        (
                                            [money:Ekiwok\QuickFixtures\Examples\YML\Model\Money:private] => 45987
                                        )

                                    [address:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Address Object
                                        (
                                            [city:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Franklin
                                            [line1:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Fog st.
                                            [line2:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Apt. 34
                                            [zipCode:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => 94110
                                        )

                                )

                        )

                )

        )

)
➜  yaml-fixtures git:(develop) ✗ php run.php
Array
(
    [0] => Ekiwok\QuickFixtures\Examples\YML\Model\Customer Object
        (
            [wallet:Ekiwok\QuickFixtures\Examples\YML\Model\Customer:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Wallet Object
                (
                    [cards:Ekiwok\QuickFixtures\Examples\YML\Model\Wallet:private] => Array
                        (
                            [0] => Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard Object
                                (
                                    [credit:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Money Object
                                        (
                                            [money:Ekiwok\QuickFixtures\Examples\YML\Model\Money:private] => 45987
                                        )

                                    [address:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Address Object
                                        (
                                            [city:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Franklin
                                            [line1:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Fog st.
                                            [line2:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Apt. 34
                                            [zipCode:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => 94110
                                        )

                                )

                            [1] => Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard Object
                                (
                                    [credit:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Money Object
                                        (
                                            [money:Ekiwok\QuickFixtures\Examples\YML\Model\Money:private] => 
                                        )

                                    [address:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Address Object
                                        (
                                            [city:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Franklin
                                            [line1:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Fog st.
                                            [line2:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Apt. 34
                                            [zipCode:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => 94110
                                        )

                                )

                        )

                )

        )

    [1] => Ekiwok\QuickFixtures\Examples\YML\Model\Customer Object
        (
            [wallet:Ekiwok\QuickFixtures\Examples\YML\Model\Customer:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Wallet Object
                (
                    [cards:Ekiwok\QuickFixtures\Examples\YML\Model\Wallet:private] => Array
                        (
                            [0] => Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard Object
                                (
                                    [credit:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Money Object
                                        (
                                            [money:Ekiwok\QuickFixtures\Examples\YML\Model\Money:private] => 98945
                                        )

                                    [address:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Address Object
                                        (
                                            [city:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Neverland
                                            [line1:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Line1
                                            [line2:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Line2
                                            [zipCode:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => 22110
                                        )

                                )

                        )

                )

        )

)
➜  yaml-fixtures git:(develop) ✗ php run.php
Array
(
    [0] => Ekiwok\QuickFixtures\Examples\YML\Model\Customer Object
        (
            [wallet:Ekiwok\QuickFixtures\Examples\YML\Model\Customer:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Wallet Object
                (
                    [cards:Ekiwok\QuickFixtures\Examples\YML\Model\Wallet:private] => Array
                        (
                            [0] => Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard Object
                                (
                                    [credit:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Money Object
                                        (
                                            [money:Ekiwok\QuickFixtures\Examples\YML\Model\Money:private] => 45987
                                        )

                                    [address:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Address Object
                                        (
                                            [city:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Franklin
                                            [line1:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Fog st.
                                            [line2:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Apt. 34
                                            [zipCode:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => 94110
                                        )

                                )

                            [1] => Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard Object
                                (
                                    [credit:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Money Object
                                        (
                                            [money:Ekiwok\QuickFixtures\Examples\YML\Model\Money:private] => 
                                        )

                                    [address:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Address Object
                                        (
                                            [city:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Franklin
                                            [line1:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Fog st.
                                            [line2:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Apt. 34
                                            [zipCode:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => 94110
                                        )

                                )

                        )

                )

        )

    [1] => Ekiwok\QuickFixtures\Examples\YML\Model\Customer Object
        (
            [wallet:Ekiwok\QuickFixtures\Examples\YML\Model\Customer:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Wallet Object
                (
                    [cards:Ekiwok\QuickFixtures\Examples\YML\Model\Wallet:private] => Array
                        (
                            [0] => Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard Object
                                (
                                    [credit:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Money Object
                                        (
                                            [money:Ekiwok\QuickFixtures\Examples\YML\Model\Money:private] => 98945
                                        )

                                    [address:Ekiwok\QuickFixtures\Examples\YML\Model\CreditCard:private] => Ekiwok\QuickFixtures\Examples\YML\Model\Address Object
                                        (
                                            [city:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Neverland
                                            [line1:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Line1
                                            [line2:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => Line2
                                            [zipCode:Ekiwok\QuickFixtures\Examples\YML\Model\Address:private] => 22110
                                        )

                                )

                        )

                )

        )

)
```