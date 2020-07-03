# ProcessWire Word Tools module 

Currently focused on English language word functions including inflection and 
lemmatisation. Provides a simple API for using these functions. 

Provides the ability to automatically hook into ProcessWire (3.0.162+) to enhance text 
searches that use any operator with a plus in "+" in it, which are the query expansion 
operators. For example, a search query for “fishing boat” …
~~~~~
$pages->find('title~|+=fishing boat');
~~~~~~
…would automatically expand to include all these words: fishing, fished, fishes, fish, 
boat, boats, boating.

## API Methods
~~~~~
$tools = $modules->get('WireWordTools');

// Get alternate words for given word
// returns [ 'words', 'worded', 'wording' ]
$words = $tools->getWords('word'); 

// Get plural value of given word
// returns "words"
$plural = $tools->getPlural('word'); 

// Get singular value of given word
// returns "word"
$singular = $tools->getSingular('words');
~~~~~

This module is a work in progress and more methods are likely to be added,
word data expanded, etc. 


