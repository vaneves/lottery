<?php 

namespace Vaneves\Lottery;

class Lotomania extends Lottery 
{
	public function listResults()
	{
		return $this->queryValues('//table[contains(@class, "lotomania")]/*/td');
	}

	public function listAwards()
	{
		$awards = parent::listAwards();
		$awards[0]->apportionments = array_slice($awards[0]->apportionments, 0, 6);
		return $awards;
	}
}