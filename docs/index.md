# Documentation

<!-- TOC -->
* [Customizing stories](#customizing-stories)
* [Customizing factories](#customizing-factories)
  * [Adding default values](#adding-default-values)
<!-- TOC -->

## Customizing stories

As an example, let's customize the default currencies story to only load EUR currency.

```php
// src/Foundry/Story/DefaultCurrenciesStory.php

declare(strict_types=1);

namespace App\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultCurrenciesStoryInterface;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultCurrenciesStory extends Story implements DefaultCurrenciesStoryInterface
{
    public function build(): void
    {
        CurrencyFactory::new()->withCode('EUR')->create();
    }
}
```

```yaml
# config/services.yaml

when@dev: &fixtures_dev
    services:
        sylius.fixtures_plugin.story.default_currencies: '@App\Foundry\Story\DefaultCurrenciesStory'
```

## Customizing factories

### Adding default values

As an example, let's add a second phone number to the customer with a new default value.

```php
// src/Entity/Customer/Customer.php

declare(strict_types=1);

namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Customer as BaseCustomer;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_customer")
 */
#[ORM\Entity]
#[ORM\Table(name: 'sylius_customer')]
class Customer extends BaseCustomer
{
    /**
     * @ORM\Column
     */
    #[ORM\Column]
    private ?string $secondPhoneNumber = null;

    public function getSecondPhoneNumber(): ?string
    {
        return $this->secondPhoneNumber;
    }

    public function setSecondPhoneNumber(?string $secondPhoneNumber): void
    {
        $this->secondPhoneNumber = $secondPhoneNumber;
    }
}
```

```php
// src/Foundry/DefaultValues/CustomerDefaultValues.php

declare(strict_types=1);

namespace App\Foundry\DefaultValues;

use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\DefaultValuesInterface;
use Faker\Generator;

final class CustomerDefaultValues implements DefaultValuesInterface
{
    public function __construct(
        private DefaultValuesInterface $decorated,
    ) {
    }

    public function __invoke(Generator $faker): array
    {
        return array_merge(($this->decorated)($faker), [
            'secondPhoneNumber' => $faker->phoneNumber(),
        ]);
    }
}
```

```yaml
when@dev: &fixtures_dev
    services:
        App\Foundry\DefaultValues\CustomerDefaultValues:
            decorates: 'sylius.fixtures_plugin.default_values.customer'
            arguments:
                $decorated: '@.inner'
```
