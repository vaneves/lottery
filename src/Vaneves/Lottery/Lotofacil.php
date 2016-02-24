<?php 

namespace Vaneves\Lottery;

class Lotofacil extends Lottery 
{
	public function listResults()
	{
		return $this->queryValues('//*[@id="resultados"]/div[2]/div/div/table/tbody/tr/td');
	}
}