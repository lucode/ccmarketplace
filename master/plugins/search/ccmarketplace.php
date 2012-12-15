<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Plugin
* @author		Jextn
* @copyright	Copyright (C) 2005-2012 Jextn. All rights reserved.
* @link			http://www.jextn.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');



/**
 * Search Plugin for Codingfish Marketplace
 *
 * @package		Joomla
 * @subpackage	Marketplace
 */
class plgSearchCCMarketplace extends JPlugin {


	/**
	* Get an array of search areas
	*
	* @return array
	*/
	function &onContentSearchAreas() {

		static $areas = array('ccmarketplace' => 'CCMarketplace');

		return $areas;

	}



	/**
	* CCMarketplace search. Gets an array of objects, each
	* of which contains the instance variables title, text,
	* href, section, created, and browsernav
	*
	* @param string $text Search string
	* @param string $phrase Matching option, exact|any|all
	* @param string $ordering What to order by, newest|oldest|popular|alpha|category
	* @param array $areas Areas in which to search, null if search all
	* @return array Objects representing foobars
	*/
	function onContentSearch($text, $phrase='', $ordering='', $areas=null) {

		// check we can handle the requested search
		if (is_array($areas) && !in_array('marketplace', $areas)) {
			return array();
		}


		// get the things we will need
		$db =& JFactory::getDBO();

		// build SQL conditions WHERE clause
		$conditions = '';

		switch ($phrase) {

			case 'exact':
				// build an exact match LIKE condition
				$text = $db->Quote('%'.$db->getEscaped($text, true).'%', false);
				$conditions = $db->nameQuote('headline') . " LIKE $text" . " OR " . $db->nameQuote('text') . " LIKE $text";
				break;

			case 'all':
			case 'any':
			default:
				// prepare the words individually
				$wordConditions = array();
				foreach (preg_split("~\s+~", $text) as $word) {
					$word = $db->Quote('%'.$db->getEscaped($word, true).'%', false);
					$wordConditions[] = $db->nameQuote('headline') . " LIKE $word"  . " OR " . $db->nameQuote('text') . " LIKE $word";
				}
				// determine the glue and put it all together!
				$glue = ($phrase == 'all') ? ') AND (' : ') OR (';
				$conditions = '('.implode($glue, $wordConditions).')';
			break;

		}


		// determine ordering
		switch ($ordering) {

			case 'popular':
				$order = $db->nameQuote('hits') . ' DESC';
				break;

			case 'alpha':
			case 'category':
				$order = $db->nameQuote('category_id') . ' ASC';
				break;

			case "oldest":
				$order = $db->nameQuote('created') . ' ASC';
				break;

			case "newest":
			default:
				$order = $db->nameQuote('created') . ' DESC';
				break;
		}


		// complete the query
		$query = 'SELECT e.id, e.headline AS title, e.text AS text, e.date_created AS created,'
				. 'c.name AS section, '
				. 'e.id AS entryid, '
				. 'e.alias AS entryalias, '
				. 'c.id AS categoryid, '
				. 'c.alias AS categoryalias, '
				. "CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug, "
				. "CASE WHEN CHAR_LENGTH(e.alias) THEN CONCAT_WS(':', e.id, e.alias) ELSE e.id END as slug,	"
				. $db->Quote('2') . ' AS browsernav '
				. ' FROM #__ccmarketplace_entries e, #__ccmarketplace_categories c'
				. " WHERE ($conditions) AND e.category_id = c.id"
			    . ' AND e.published = 1'
				. " ORDER BY $order";


		$db->setQuery($query);
		$rows = $db->loadObjectList();


		// get Marketplace Itemid
		$sqlitemid = "SELECT id FROM ".$db->nameQuote( '#__menu')." WHERE link LIKE '%com_ccmarketplace%' AND parent = '0' AND published = '1'";
		$db->setQuery( $sqlitemid);
		$itemid = $db->loadResult();


		foreach($rows as $key => $row) {
			$rows[$key]->href = 'index.php?option=com_ccmarketplace&view=entry&catid=' . $row->catslug . '&entry=' . $row->slug . '&Itemid=' . $itemid;
		}


		return $rows;

	}



}

