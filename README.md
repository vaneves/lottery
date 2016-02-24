# Lottery

## Installing

Via Composer

```
composer require vaneves/lottery
```
## Cron Jobs

```
0 2 * * * wget -q -O /path/to/tmp/mega-sena.html http://loterias.caixa.gov.br/wps/portal/loterias/landing/lotomania/
```

## Usage

``` php
use Vaneves\Lottery\Lottery;
use Vaneves\Lottery\MegaSena;

$lottery = new MegaSena();
$lottery->load('html/mega-sena.html');

$result = new \stdClass;
$result->number = $lottery->getNumber();
$result->date = $lottery->getDate();
$result->result = $lottery->listResults();
$result->awards = $lottery->listAwards();
$result->next = $lottery->getNext();

```