<?php 

namespace Vaneves\Lottery;

class Lotofacil extends Lottery 
{
    public function listResults()
    {
        return $this->queryValues('//*[@id="resultados"]/div[2]/div/div/table/tbody/tr/td');
    }

    public function listAwards()
    {
        $awards = parent::listAwards();
        $awards[0]->apportionments = array_slice($awards[0]->apportionments, 0, 5);
        return $awards;
    }
}