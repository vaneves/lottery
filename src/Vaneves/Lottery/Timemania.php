<?php 

namespace Vaneves\Lottery;

class Timemania extends Lottery 
{
	public function listAwards()
	{
		$awards = parent::listAwards();
		$all = $awards[0]->apportionments;
		$awards[0]->apportionments = array_slice($all, 0, 5);

		$award = new \stdClass;
		$award->title = 'Time do Coração';
		$award->apportionments = [$all[5]];

		$awards[] = $award;
		return $awards;
	}
}