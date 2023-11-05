# Laravel Moment Timezone

Laravel package to convert dates/times to the user's local time using Moment and Moment Timezone.

A special thanks to [Blade UI Kit](https://github.com/blade-ui-kit/blade-ui-kit) for the base of
this package. If you need UI components like inputs, buttons, alerts, be sure to check them out.

## Installation

Install using Composer:

```bash
composer require cyberpunkcodes/laravel-moment-timezone
```

If you already have a component named `moment`, you will need to publish the config file so you can
define a prefix. Currently, the only configurable option is a prefix. So if you don't need to set a
prefix, then you don't need to publish the config file.

Publish the config file by running:

```bash
php artisan vendor:publish --tag=moment-config
```

## Usage

Replace all the dates/times in your view files with the moment component

```php
<x-moment :date="$user->created_at" format="F jS, Y \a\t g:i a" />
```

That will display as: January 23rd, 2023 at 12:07 pm

The default usage uses PHP's datetime formatting. For more details, read the PHP docs here: [https://www.php.net/manual/en/datetime.format.php](https://www.php.net/manual/en/datetime.format.php)

### Human Readable

To display as human readable, which prints "2 minutes ago" or "2 months ago", you can simply add the `human` attribute like so:

```php
<x-moment :date="$user->created_at" format="F jS, Y \a\t g:i a" human />
```

### Local Timezone

Finally, if you want to show the dates/times in the user's local timezone, simply add the `local` attribute like so:

```php
<x-moment :date="$user->created_at" format="MMMM Do, Y [at] h:mm a" local />
```

It is important to note that the format when using the `local` attribute must use the formatting
rules from Moment and not PHP. See the Moment formatting rules for more info: [https://momentjs.com/docs/#/displaying/format/](https://momentjs.com/docs/#/displaying/format/)

Here is a side-by-side comparison of both. They both result in displaying the exact same.

PHP Format: `F jS, Y \a\t g:i a`

Moment Format: `MMMM Do, Y [at] h:mm a`

Both will display as: `January 23rd, 2023 at 12:07 pm`

## Prefix

As mentioned above, you need to publish the config file to define a prefix. The only time you need
a prefix is if you already have a component named `moment` and this package would cause conflict.

If you set your prefix to `cool` then you would use the component like so:

```php
<x-cool-moment :date="$user->created_at" format="F jS, Y \a\t g:i a" />
```
