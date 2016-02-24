<?php 

namespace Vaneves\Lottery;

class Lotomania extends Lottery 
{
	public function listResults()
	{
		return $this->queryValues('//table[contains(@class, "lotomania")]/*/td');
	}
}