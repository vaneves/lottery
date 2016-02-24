<?php 

namespace Vaneves\Lottery;

class Lottery 
{
	protected $doc;
	protected $html;

	public function load($file)
	{
		if(!file_exists($file)) {
			throw new \RuntimeException('File ' . $file . ' not found');
		}
		if(filesize($file) == 0) {
			throw new \RuntimeException('File ' . $file . ' is empty');
		}
		
		libxml_use_internal_errors(true);
		$this->doc = new \DOMDocument;
		$this->doc->preserveWhiteSpace = false;
		$this->doc->loadHTMLFile($file);
		$this->html = new \DOMXPath($this->doc);
	}

	protected function findRegex($subject, $regex, $value = null)
	{
		$matches = [];
		if(preg_match($regex, $subject, $matches)) {
			$value = $matches[1];
		}
		return trim($value);
	}

	public function queryValue($xpath, $regex = null)
	{
		$value = $this->html->query($xpath)->item(0)->nodeValue;
		if($regex) {
			$matches = [];
			if(preg_match($regex, $value, $matches)) {
				$value = $matches[1];
			}
		}
		return $value;
	}

	public function queryValues($xpath)
	{
		$values = [];
		$query = $this->html->query($xpath);
		foreach ($query as $node) {
			$values[] = $node->nodeValue;
		}
		return $values;
	}

	public function getNumber()
	{
		return $this->queryValue('//*[@id="resultados"]/div[1]/div/h2/span', '#\s([\d]+)\s#');
	}

	public function getDate()
	{
		return $this->queryValue('//*[@id="resultados"]/div[1]/div/h2/span', '#\((.+)\)#');
	}

	public function listResults()
	{
		return $this->queryValues('//*[@id="resultados"]/div[2]/div/div/ul/li');
	}

	public function listAwards()
	{
		$apportionments = [];
		$query = $this->html->query('//*[@id="resultados"]/div[3]/div/p[@class="description"]');
		foreach ($query as $node) {
			$apportionment = new \stdClass;
			$apportionment->type = $this->findRegex($node->nodeValue, '/(.+)\s(\-\s)?/');
			$apportionment->amount = $this->findRegex($node->nodeValue, '/([\d]+) aposta/', '0');
			$apportionment->value = $this->findRegex($node->nodeValue, '/R\$ (.+)/', '0,00');

			$apportionments[] = $apportionment;
		}
		$award = new \stdClass;
		$award->title = 'Premiação';
		$award->apportionments = $apportionments;

		return [$award];
	}

	public function getNext()
	{
		$next = new \stdClass; 
		$next->date = $this->queryValue('//*[@id="resultados"]/div[2]/div/div/div[1]/p[1]', '#(([\d]+)/([\d]+)/([\d]+))#');
		$next->value = $this->queryValue('//*[@id="resultados"]/div[2]/div/div/div[1]/p[2]', '/R\$ (.+)/');

		return $next;
	}
}