# Lottery

## Installing

Via Composer

```
composer require vaneves/lottery
```
## Cron Jobs

```
0 2 * * * wget -q -O tmp/megasena.html http://loterias.caixa.gov.br/wps/portal/loterias/landing/megasena/
0 2 * * * wget -q -O tmp/quina.html http://loterias.caixa.gov.br/wps/portal/loterias/landing/quina/
0 2 * * * wget -q -O tmp/lotofacil.html http://loterias.caixa.gov.br/wps/portal/loterias/landing/lotofacil/
0 2 * * * wget -q -O tmp/lotomania.html http://loterias.caixa.gov.br/wps/portal/loterias/landing/lotomania/
0 2 * * * wget -q -O tmp/timemania.html http://loterias.caixa.gov.br/wps/portal/loterias/landing/timemania/
0 2 * * * wget -q -O tmp/duplasena.html http://loterias.caixa.gov.br/wps/portal/loterias/landing/duplasena/
```

## Usage

``` php
use Vaneves\Lottery\Lottery;
use Vaneves\Lottery\MegaSena;

$lottery = new MegaSena();
$lottery->load('html/megasena.html');

$result = new \stdClass;
$result->number = $lottery->getNumber();
$result->date = $lottery->getDate();
$result->result = $lottery->listResults();
$result->awards = $lottery->listAwards();
$result->next = $lottery->getNext();

```