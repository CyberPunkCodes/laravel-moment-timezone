# Laravel Moment Timezone

Laravel package to convert dates/times to the user's local time using Moment and Moment Timezone.

A special thanks to [Blade UI Kit](https://github.com/blade-ui-kit/blade-ui-kit) for the base of
this package. If you need UI components like inputs, buttons, alerts, be sure to check them out.

## Installation

Install using Composer:

```bash
composer require cyberpunkcodes/laravel-moment-timezone
```

Add the directive to your layout, right before the closing `</body>` tag, after all other scripts
have been loaded, to load the required JavaScript files:

```php
@momentScripts
```

It is recommended to publish the config file so future updates to this package don't upgrade the
Moment and Moment Timezone JavaScript files and surprise you in production. By publishing the
config file, the asset versions won't update until you manually update them in the config.

Publish the config file by running:

```bash
php artisan vendor:publish --tag=moment-config
```

In `config/moment.php` you will see an `assets` array with a child `scripts` array. Each of the
scripts in this array will be directly printed when called by the `@momentScripts` directive.

Include the full `<script></script>` tag. This is so you can copy it from a source like CDNJS
and keep the integrity hash checking.

Optionally, you can add the scripts to your asset bundling/minifying processors. In which case,
you would not use the `@momentScripts` directive.

If you want to customize the component's view file, run:

```bash
php artisan vendor:publish --tag=moment-views
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

If you have another component named `moment` and are experiencing a conflict, you can define a
custom prefix.

If you set your prefix to `cool` then you would use the component like so:

```php
<x-cool-moment :date="$user->created_at" format="F jS, Y \a\t g:i a" />
```

After you rename a component, you may see errors about the component not being able to be
found. This is due to view caching. You must clear the view cache:

```bash
php artisan view:clear
```

## Contributing

I intend on keeping this package simple. The use case is only for Moment and Moment Timezone. If
you find an error/bug, or want to help clean up this readme, please create an issue first so we
can discuss it before you waste time on a pull request.
