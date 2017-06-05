<?php 

namespace Vaneves\Lottery;

class DuplaSena extends Lottery 
{
    public function listResults()
    {
        $results = parent::listResults();
        $result1 = array_slice($results, 0, 6);
        $result2 = array_slice($results, 6, 12);

        return [$result1, $result2];
    }

    public function listAwards()
    {
        $awards = parent::listAwards();
        $all = $awards[0]->apportionments;

        $award1 = new \stdClass;
        $award1->title = 'Premiação - 1º Sorteio';
        $award1->apportionments = array_slice($all, 0, 4);

        $award2 = new \stdClass;
        $award2->title = 'Premiação - 2º Sorteio';
        $award2->apportionments = array_slice($all, 4, 4);

        return [$award1, $award2];
    }
}