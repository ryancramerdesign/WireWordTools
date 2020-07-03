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

Please note the results are not always going to be perfect here, but intended to strike 
a balance between maintainability and accuracy. The goal being to provide potentially 
helpful word additions for ProcessWire-based search engines needing word variations. 

The JSON dictionary files in the ./lemmas/ and ./roots/ directories was 
converted from PHP files in the [Lemmatizer](https://github.com/writecrow/lemmatizer) 
project © 2018 Mark Fullmer.

## Install

1. Copy all module files to: `/site/modules/WireWordTools/`
2. In the ProcessWire admin, click to Modules > Refresh
3. On the Modules > Site tab, click “Install” for this module.

## API Methods
~~~~~
// Get instance of module
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

