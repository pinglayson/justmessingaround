# JustMessingAround

### Installation

```sh
$ git clone https://github.com/pinglayson/justmessingaround.git
$ cd justmessingaround
$ composer install
```

### Usage Sample
http://justmessingaround.test/api/v1/between?from=2019-09-18%2006:57:44&to=2019-09-01%2006:57:44&format=days&to_tz=America/Sitka

### Parameters
```sh
from - first date
to - second date
format - format for values on between e.g days|weekdays|weeks|seconds|minutes|hours|years
from_tz(optional) - timezone for first date
to_tz(optional) - timezone for second date
```

### Testing

Change 'base_uri' in tests/DateApiTest.php to local setting e.g http://justmessingaround.test/

Then run this code in project root.
```sh
$ ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/DateApiTest.php
```
