<?php 

require_once '../src/Vaneves/Lottery/Lottery.php';
require_once '../src/Vaneves/Lottery/Timemania.php';

use Vaneves\Lottery\Lottery;
use Vaneves\Lottery\Timemania;

header('Content-Type: application/json; charset=UTF-8');

try {
    $lottery = new Timemania();
    $lottery->load('html_temp/timemania.html');

    $result = new \stdClass;
    $result->number = $lottery->getNumber();
    $result->date = $lottery->getDate();
    $result->result = $lottery->listResults();
    $result->awards = $lottery->listAwards();
    $result->cities = $lottery->listCities();
    $result->next = $lottery->getNext();

    echo json_encode($result);
} catch (\RunTimeException $e) {
    echo '{error: true, message: "' . $e->getMessage() . '"}';
} catch (\Exception $e) {
    echo '{error: true, message: "Ocorreu um erro"}';
}