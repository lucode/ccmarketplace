<?php

/**
*
* Marketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Frontend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

defined( '_JEXEC' ) or die( 'Restricted access' );


function ccmarketplaceBuildRoute( &$query) {

    $segments = array();

	/*
    if (isset( $query['view'])) {
        $segments[] = $query['view'];
        unset( $query['view']);
    }
	*/

    unset( $query['view']);

    if (isset( $query['task'])) {
        $segments[] = $query['task'];
        unset( $query['task']);
    }

    if (isset( $query['catid'])) {
        $segments[] = $query['catid'];
        unset( $query['catid']);
    }

	/* Added by henry*/
	if (isset( $query['layout'])) {
        $segments[] = $query['layout'];
        unset( $query['layout']);
    }

	if (isset( $query['caid'])) {
        $segments[] = $query['caid'];
        unset( $query['caid']);
    }

	/*if (isset( $query['meid'])) {
        $segments[] = $query['meid'];
        unset( $query['meid']);
    }*/

	/* Added by henry*/

    if (isset( $query['entry'])) {
        $segments[] = $query['entry'];
        unset( $query['entry']);
    }

    if (isset( $query['id'])) {
        $segments[] = $query['id'];
        unset( $query['id']);
    }

    if (isset( $query['limitstart'])) {
        $segments[] = $query['limitstart'];
        unset( $query['limitstart']);
    }


    if (isset( $query['userid'])) {
        $segments[] = $query['userid'];
        unset( $query['userid']);
    }

    if (isset( $query['post'])) {
        $segments[] = $query['post'];
        unset( $query['post']);
    }

    if (isset( $query['format'])) {
        $segments[] = $query['format'];
        unset( $query['format']);
    }

    return $segments;

}


function MarketplaceParseRoute( $segments) {

    $vars = array();

    $count = count ( $segments);
    /*
    echo "count: " . $count;
    echo "<br />";
    echo "segments 0: " . $segments[0];
    echo "<br />";
    echo "segments 1: " . $segments[1];
    echo "<br />";
	*/



    switch ( $count) {

		case 1: {

			switch ( $segments[0]) {

				case 'profile': {
        			$vars['view'] = "profile"; 		// user profile
					break;
				}

				case 'new': {
        			$vars['view']  = "entry";
        			$vars['task']  = $segments[0];   // task = new -> new entry
					break;
				}

				case 'create': {
        			$vars['view']  = "entry";
        			$vars['task']  = $segments[0];   // task = new -> new entry
					break;
				}

				case 'entries': {
        			$vars['view']  = "entries";
        			$vars['task']  = $segments[0];   // task = entries & no id  -> my entries
					break;
				}

				case 'feed': {
        			$vars['view']  = "index";
        			$vars['task'] = "feed";
        			$vars['format'] = $segments[0];
					break;
				}

				case 'mail': {
        			$vars['view']   = "mail";
					break;
				}


				default: {
					// category view
		        	$vars['view'] = "category";
		        	$vars['catid'] = $segments[0]; // category slug
					break;
        		}
        	}

			break;
		}


		case 2: {

			switch ( $segments[0]) {


				case 'delete': {
        			$vars['view']    = "entry";
        			$vars['task']    = $segments[0];   // task = delete
        			$vars['entry']   = $segments[1];   // entry id
					break;
				}

				case 'edit': {
        			$vars['view']    = "entry";
        			$vars['task']    = $segments[0];   // task = edit
        			$vars['entry']   = $segments[1];   // entry id
					break;
				}

				case 'reactivate': {
        			$vars['view']    = "entry";
        			$vars['task']    = $segments[0];   // task = reactivate
        			$vars['entry']   = $segments[1];   // entry id
					break;
				}

				case 'default_member': {
					$vars['view']   = "ads";
					$vars['layout'] = $segments[0];
					$vars['id']     = $segments[1];
					break;
				}

				case 'new': {
        			$vars['view']  = "entry";
        			$vars['task']  = $segments[0];   // task = new
		        	$vars['catid'] = $segments[1];   // category slug
					break;
				}

				case 'ads': {
        			$vars['view']   = "ads";
        			$vars['layout'] = $segments[0];
					$vars['id']   = $segments[1];
					break;
				}

				default: {

					if ( $segments[1] == "feed") { // category rss feed
        				$vars['view']  	= "category";
        				$vars['task'] 	= "feed";
		        		$vars['catid'] 	= $segments[0];   // category slug
        				$vars['format'] = "feed";
					}
					else { // entry view
			        	$vars['view']   = "entry";
			        	$vars['catid']  = $segments[0];  // category slug
			        	$vars['entry']  = $segments[1];  // entry slug
					}

					break;
        		}
        	}

			break;
		}

		case 3: {

			switch ( $segments[0]) {
				case 'view1': {
        			$vars['view']   = "ads";
        			$vars['layout'] = $segments[0];
					$vars['caid']   = $segments[1];
					$vars['id']     = $segments[2];
					break;
				}

				case 'view2': {
        			$vars['view']   = "ads";
        			$vars['layout'] = $segments[0];
					$vars['caid']   = $segments[1];
					$vars['id']     = $segments[2];
					break;
				}

				case 'view3': {
        			$vars['view']   = "ads";
        			$vars['layout'] = $segments[0];
					$vars['caid']   = $segments[1];
					$vars['id']     = $segments[2];
					break;
				}

				default: {
					$vars['view']   = "ads";
        			$vars['layout'] = $segments[0];
					$vars['caid']   = $segments[1];
					$vars['id']     = $segments[2];
					break;
				}
			}
			break;
		}

    	default: {
    		break;
    	}

    }



    return $vars;

}


