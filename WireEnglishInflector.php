<?php namespace ProcessWire;

/**
 * ProcessWire Word Tools module: Inflector (EN)
 *
 * Inflection (singular/plural) for English language words. 
 * Developed by Ryan Cramer for the WireWordTools module © 2020.
 * 
 * Please note the results are not always going to be perfect here, 
 * but intended to strike a balance between maintainability and accuracy.
 * The goal being to cover the most cases for ProcessWire-based search
 * engines needing singular/plural variations. Maybe this class can come
 * in handy for other purposes too. 
 * 
 */
class WireEnglishInflector extends Wire {

	/**
	 * Words ending with these are ignored (A-Z)
	 * 
	 * @var array
	 * 
	 */
	protected $ignoreEndings = array(
		'deer' => true,
		'fish' => true,
		'lese' => true,
		'measles' => true,
		'media' => true,
		'mese' => true,
		'nese' => true,
		'ois' => true,
		'pox' => true,
		'rese' => true,
		'sheep' => true,
		'ting' => true,
	);

	/**
	 * Word ending replacements for singular-to-plural (A-Z)
	 * 
	 * @var array
	 * 
	 */
	protected $pluralEndings = array(
		'*' => 's',
		'alias' => 'aliases',
		'alumnus' => 'alumni',
		'axis' => 'axes',
		'bacillus' => 'bacilli',
		'buffalo' => 'buffaloes',
		'cactus' => 'cacti',
		'ch' => 'ches',
		'chef' => 'chefs',
		'child' => 'children',
		'crisis' => 'crises',
		'ef' => 'eves',
		'af' => 'aves', // 
		'fe' => array('/([^f])fe$/i' => '$1ves'),
		'focus' => 'foci',
		'fungus' => 'fungi',
		'hive' => 'hives',
		'ium' => 'ia',
		'lf' => 'lves',
		'louse' => 'lice',
		'lum' => 'la', // curriculum => curricula
		'man' => array('/(?<!u)(m)an$/i' => '$1en'),
		'matrix' => 'matrices',
		'mouse' => 'mice',
		'nucleus' => 'nuclei',
		'person' => 'people',
		'quiz' => 'quizzes',
		'quy' => 'quies',
		'radius' => 'radii',
		'rf' => 'rves',
		's' => 's',
		'sh' => 'shes',
		'sis' => 'ses',
		'ss' => 'sses',
		'status' => 'statuses',
		'stimulus' => 'stimuli',
		'syllabus' => 'syllabi',
		'terminus' => 'termini',
		'tomato' => 'tomatoes',
		'tum' => 'ta',
		'us' => 'uses',
		'vertex' => 'vertices',
		'x' => 'xes',
		'y' => array('/([^aeiouy])y$/i' => '$1ies'),
	);

	/**
	 * Full word replacements for singular to plural (A-Z)
	 * 
	 * This should cover most of the irregulars. 
	 * 
	 * @var array
	 * 
	 */
	protected $pluralWords = array(
		'atlas' => 'atlases',
		'beef' => 'beefs',
		'belief' => 'beliefs', //
		'brief' => 'briefs',
		'brother' => 'brothers',
		'cache' => 'caches',
		'cafe' => 'cafes',
		'chef' => 'chefs', //
		'chief' => 'chiefs', //
		'child' => 'children',
		'cookie' => 'cookies',
		'corpus' => 'corpuses',
		'cow' => 'cows',
		'criterion' => 'criteria',
		'foe' => 'foes',
		'foot' => 'feet',
		'ganglion' => 'ganglions',
		'genie' => 'genies',
		'genus' => 'genera',
		'goose' => 'geese',
		'graffito' => 'graffiti',
		'halo' => 'halos', //
		'hero' => 'heroes',
		'hoof' => 'hoofs',
		'lexicon' => 'lexica',
		'loaf' => 'loaves',
		'man' => 'men',
		'minimum' => 'minima',
		'money' => 'monies',
		'mongoose' => 'mongooses',
		'mouse' => 'mice', //
		'move' => 'moves',
		'mucosa' => 'mucosae',
		'formula' => 'formulae', //
		'mythos' => 'mythoi',
		'niche' => 'niches',
		'numen' => 'numina',
		'occiput' => 'occiputs',
		'octopus' => 'octopuses',
		'opus' => 'opuses',
		'ox' => 'oxen',
		'passerby' => 'passersby',
		'person' => 'people',
		'photo' => 'photos', //
		'phenomenon' => 'phenomena',
		'piano' => 'pianos', //
		'potato' => 'potatoes',
		'referendum' => 'referenda',
		'roof' => 'roofs', //
		'sex' => 'sexes',
		'sieve' => 'sieves',
		'soliloquy' => 'soliloquies',
		'spectrum' => 'spectra',
		'tooth' => 'teeth',
		'trilby' => 'trilbys',
		'turf' => 'turfs',
		'volcano' => 'volcanos', // 
		'woman' => 'women', // 

		// full words to leave words as-is (singular and plural are the same)
		'aircraft' => true,
		'feedback' => true,
		'stadia' => true,
		'cattle' => true,
		'chassis' => true,
		'clippers' => true,
		'debris' => true,
		'diabetes' => true,
		'equipment' => true,
		'fair' => true,
		'gallows' => true,
		'graffiti' => true,
		'headquarters' => true,
		'information' => true,
		'innings' => true,
		'oz' => true,
		'news' => true,
		'nexus' => true,
		'machinery' => true,
		'moose' => true,
		'pokemon' => true,
		'proceedings' => true,
		'research' => true,
		'salmon' => true,
		'series' => true,
		'species' => true,
		'weather' => true,
		'this' => true,
		'and' => true,
		'or' => true, 
	);

	/**
	 * Word ending replacements for plural-to-singular
	 * 
	 * @var array
	 * 
	 */
	protected $singularEndings = array(
		'aliases' => array('/(alias)es/i' => '$1'), // aliases*
		'alumni' => 'alumnus',
		'analyses' => 'analysis',
		'aves' => 'af',
		'axes' => 'axis',
		'bacilli' => 'bacillus',
		'bases' => 'basis',
		'cacti' => 'cactus',
		'ches' => 'ch',
		'children' => 'child',
		'crises' => 'crisis',
		'cula' => 'culum', // curriculum => curricula, etc.
		'diagnoses' => 'diagnosis',
		'drives' => 'drive',
		'eaus' => 'eau',
		'eves' => 'ef', // believes => belief, etc.
		'faxes' => 'fax',
		'foci' => 'focus',
		'fungi' => 'fungus',
		'hives' => 'hive',
		'ia' => 'ium', // needs example
		'ies' => array('/([^aeiouy])ies$/i' => '$1y'), // disabilities => disability, etc.
		'indices' => 'index',
		'ives' => 'ife',
		'lice' => 'louse',
		'lves' => 'lf', // themselves => themself, shelves => shelf, etc.
		'matrices' => 'matrix',
		'men' => 'man',
		'menus' => 'menu',
		'mice' => 'mouse',
		'movies' => 'movie',
		'mulae' => 'mula', // formula => formulae, etc.
		'news' => 'news',
		'nuclei' => 'nucleus',
		'oes' => 'o',
		'ouses' => 'ouse',
		'oxen' => 'ox',
		'parentheses' => 'parenthesis',
		'people' => 'person',
		'prognoses' => 'prognosis',
		'quies' => 'quy',
		'quizzes' => 'quiz',
		'radii' => 'radius',
		's' => '',
		'ses' => 'sis',
		'shes' => 'sh',
		'shoes' => 'shoe',
		'sses' => 'ss',
		'statuses' => 'status',
		'stimuli' => 'stimulus',
		'syllabi' => 'syllabus',
		'synopses' => 'synopsis',
		'ta' => 'tum', // quanta => quantum, etc.
		'taxes' => 'tax',
		'termini' => 'terminus',
		'theses' => 'thesis',
		'tives' => 'tive',
		'us' => 'us',
		'uses' => array('/([^a])uses$/i' => '$1us'),
		'vertices' => 'vertex',
		'ves' => array('/([^rfoa])ves$/i' => '$1fe'),
		'virii' => 'virus',
		'waxes' => 'wax',
		'xes' => 'x',
	);

	/**
	 * Longest plural ending
	 * 
	 * @var int
	 * 
	 */
	protected $longestPluralEnding = 0;

	/**
	 * Longest singular ending
	 * 
	 * @var int
	 * 
	 */
	protected $longestSingularEnding = 0;

	/**
	 * Construct
	 *
	 */
	public function __construct() {
		foreach(array_keys($this->pluralEndings) as $ending) {
			$length = strlen($ending);
			if($length > $this->longestPluralEnding) $this->longestPluralEnding = $length;
		}
		foreach(array_keys($this->singularEndings) as $ending) {
			$length = strlen($ending);
			if($length > $this->longestSingularEnding) $this->longestSingularEnding = $length;
		}
	}

	/**
	 * Should work be ignored for inflection?
	 * 
	 * @param string $word
	 * @return bool
	 * 
	 */
	public function isIgnored($word) {
		$ignore = false;
		if(isset($this->pluralWords[$word]) && $this->pluralWords[$word] === true) return true;
		foreach(array_keys($this->ignoreEndings) as $ending) {
			if(strpos($word, $ending) === false) continue;
			$length = strlen($ending);
			if($length > strlen($word)) continue;
			$test = substr($word, -1 * strlen($ending));
			if($test === $ending) $ignore = true;
			if($ignore) break;
		}
		return $ignore;
	}

	/**
	 * Is word plural?
	 *
	 * @param string $word
	 * @return bool
	 *
	 */
	public function isPlural($word) {
		if($this->isIgnored($word)) return true;
		return !$this->isSingular($word);
	}

	/**
	 * Is word singular?
	 *
	 * @param string $word
	 * @return bool|null
	 *
	 */
	public function isSingular($word) {
		if($this->isIgnored($word)) return true;
		if($this->getSingular($word) === $word) return true;
		if($this->getPlural($word) !== $word) return true;
		return false;
	}

	/**
	 * Get plural of given word
	 *
	 * @param string $word
	 * @return string
	 *
	 */
	public function getPlural($word) {

		$word = trim(strtolower($word));
		$w = $word;

		if(isset($this->pluralWords[$w])) {
			$plural = $this->pluralWords[$w];
			if($plural === true) $plural = $w;
			return $plural;
		}

		if(in_array($w, $this->pluralWords, true)) return $word;
		$plural = '';

		$n = strlen($word)+1;
		if($n > $this->longestPluralEnding) $n = $this->longestPluralEnding + 1;

		while($n-- && !$plural) {
			$w = substr($word, -1 * $n);
			if(isset($this->ignoreEndings[$w])) {
				$plural = $word;
				continue;
			}
			$rule = isset($this->pluralEndings[$w]) ? $this->pluralEndings[$w] : false;
			if($rule === false) {
				if(in_array($w, $this->pluralEndings, true)) {
					$plural = $word;
					break;
				} else if(isset($this->singularEndings[$w]) && $w === $word) {
					$plural = $w;
					break;
				}
			}
			if(is_string($rule)) {
				$plural = substr($word, 0, strlen($word) - strlen($w)) . $rule;
			} else if(is_array($rule)) {
				$replace = reset($rule);
				$find = key($rule);
				$test = preg_replace($find, $replace, $word);
				if($test !== $word) $plural = $test;
			}
		}

		if(!$plural) $plural = $word . $this->pluralEndings['*'];

		return $plural;
	}

	/**
	 * Get singular of given word
	 *
	 * @param string $word
	 * @return string
	 *
	 */
	public function getSingular($word) {

		$word = trim(strtolower($word));
		$w = $word;

		if(isset($this->pluralWords[$w])) return $w; // already singular

		$singular = array_search($w, $this->pluralWords, true);
		if($singular !== false) return $singular;

		$singular = '';
		$n = strlen($word)+1;
		if($n > $this->longestSingularEnding) $n = $this->longestSingularEnding + 1;

		while(--$n && !$singular) {
			$w = substr($word, -1 * $n);
			if(isset($this->ignoreEndings[$w])) {
				$singular = $word;
				continue;
			}
			$rule = isset($this->singularEndings[$w]) ? $this->singularEndings[$w] : false;
			if($rule === false) continue;
			if(is_string($rule)) {
				$singular = substr($word, 0, strlen($word) - strlen($w)) . $rule;
			} else if(is_array($rule)) {
				$replace = reset($rule);
				$find = key($rule);
				$test = preg_replace($find, $replace, $word);
				if($test !== $word) $singular = $test;
			}
		}

		if(!$singular) $singular = $word;

		return $singular;
	}
}