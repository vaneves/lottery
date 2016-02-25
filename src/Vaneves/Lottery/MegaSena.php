<?php 

namespace Vaneves\Lottery;

class MegaSena extends Lottery 
{
	public function listAwards()
	{
		$awards = parent::listAwards();
		$awards[0]->apportionments = array_slice($awards[0]->apportionments, 0, 3);
		return $awards;
	}
}