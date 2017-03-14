# Laravel Artisan Database Command

> Get the table records from artisan


## Prerequisites

- [PHP](http://php.net): `>=5.6` <br>
- [Laravel](https://laravel.com): `>=5.4`


## Installation


```bash
$ composer require --dev 'guntur/laravel-artisan-database'
```


## Usage

### Register Command

Update the `app/Console/Kernel.php` like this.

```php
<?php

namespace App\Console;

use Guntur\Artisan as Art;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Art\DatabaseTableCommand::class,
    ];

    // ...
}
```

### Artisan

```
❯ php artisan db:table --help
Usage:
  db:table [options] [--] <table>

Arguments:
  table                  The table name

Options:
      --fields[=FIELDS]  Select with the specified field. Separate with `,` for multiple fields [default: "all"]
  -h, --help             Display this help message
  # ...

Help:
  Show the records of table
```



## Contributions

- Pull Requests and Issues: __welcome__

Please teach me for your PRs. :smile:


## License

MIT © [Guntur Poetra](http://guntur.starmediateknik.com)
