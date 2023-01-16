# A set of useful Laravel validation rules for Guatemala (GT)

This repository contains useful Laravel validation rules for Guatemalan documents:

## Installation

You can install the package via composer:

```bash
composer require softlogic-gt/laravel-validation-rules-gt
```

The package will automatically register itself.

### Translations

If you wish to edit the package translations, you can run the following command to publish them into your `resources/lang` folder

```bash
php artisan vendor:publish --provider="SoftlogicGT\ValidationRulesGT\ValidationRulesGTServiceProvider"
```

## Available rules

-   [`DPI`](#dpi)
-   [`NIT`](#nit)

### `DPI`

Determine if the field under validation is a valid Guatemalan DPI.

```php

use SoftlogicGT\ValidationRulesGT\Rules\Dpi;

public function rules()
{
    $rules = [
        'dpi' => ['required', new Dpi()],
    ];
    $request->validate($rules)
}
```

### `NIT`

Determine if the field under validation is a valid Guatemalan Tax ID (NIT).

```php

use SoftlogicGT\ValidationRulesGT\Rules\Nit;

public function rules()
{
    $rules = [
        'nit' => ['required', new Nit()],
    ];
    $request->validate($rules)
}
```
