<?php 

namespace Vaneves\Lottery;

class Quina extends Lottery 
{
	public function listAwards()
	{
		$awards = parent::listAwards();
		$awards[0]->apportionments = array_slice($awards[0]->apportionments, 0, 3);
		return $awards;
	}
}