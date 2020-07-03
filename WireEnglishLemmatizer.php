<?php namespace ProcessWire;

/**
 * ProcessWire Word Tools module: Lemmatizer (EN)
 * 
 * Developed by Ryan Cramer for the WireWordTools module © 2020.
 *
 * Uses data in the ./lemmas/ and ./roots/ directories (convereted to JSON) that
 * originated with: https://github.com/writecrow/lemmatizer © 2018 Mark Fullmer
 *
 */
class WireEnglishLemmatizer extends Wire {
	
	/**
	 * Get lemma for given word
	 *
	 * @param string $word
	 * @return bool
	 *
	 */
	public function getLemma($word) {
		return $this->getWordData($word, 'lemmas');
	}

	/**
	 * Get related/alternate words for given word
	 *
	 * @param string $word
	 * @param bool $inclusive Also include the given word in return value if found to be valid? (default=false)
	 * @return array
	 *
	 */
	public function getWords($word, $inclusive = false) {
		$lemma = $this->getLemma($word);
		$words = $this->getWordsFromLemma($lemma);
		if($word !== $lemma && !in_array($lemma, $words)) $words[] = $lemma;
		$key = $inclusive ? false : array_search($word, $words);
		if($key !== false) unset($words[$key]); 
		return $words;
	}

	/**
	 * Get words from lemma
	 * 
	 * Like getWords() but assumes you’ve you given it a lemma, rather than tracking it down for you. 
	 *
	 * @param string $lemma
	 * @param bool $allowEmpty
	 * @return array
	 *
	 */
	public function getWordsFromLemma($lemma, $allowEmpty = true) {
		$value = $this->getWordData($lemma, 'roots', $allowEmpty);
		$value = strlen($value) ? explode(',', $value) : array();
		if(!$allowEmpty && empty($value)) $value = array($lemma);
		return $value;
	}

	/**
	 * Get word data from JSON file
	 * 
	 * @param string $word
	 * @param string $type
	 * @param bool $allowEmpty Allow empty return value when nothing found? (default=false) 
	 * @return string
	 *
	 */
	protected function getWordData(&$word, $type, $allowEmpty = false) {
		$c = $this->getc($word);
		$emptyValue = $allowEmpty ? '' : $word;
		if(!$c || empty($word)) return $emptyValue;
		$file = __DIR__ . "/$type/$c.json";
		if(!file_exists($file)) return '';
		$data = json_decode(file_get_contents($file), true);
		if($data === false) return $emptyValue;
		if(!empty($data[$word])) return $data[$word];
		return $emptyValue;
	}

	/**
	 * Get first character from string, validating as alpha a-z and update $word to be valid
	 * @param string $word
	 * @return bool|string
	 *
	 */
	protected function getc(&$word) {
		$alpha = 'abcdefghijklmnopqrstuvwxyz';
		$word = strtolower(trim($word));
		if(!strlen($word) || !ctype_alnum($word)) return '';
		$c = substr($word, 0, 1);
		if(strpos($alpha, $c) === false) return '';
		return $c;
	}

}