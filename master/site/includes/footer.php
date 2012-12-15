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

// no direct access
defined('_JEXEC') or die('Restricted access');


require_once(JPATH_COMPONENT.DS.'classes/helper.php');
$cHelper = new CodingfishFrontendHelper();

// get parameters
$params =& JComponentHelper::getParams('com_ccmarketplace');

$_showFooter = $params->get('showFooter', '1');
?>


	<?php
	if ( $_showFooter == '1' ) { // display codingfish footer
		?>

        <div class="cofiFooter">

            <span id="cofiFooterLeft">

                <a href="http://www.cc-hub.org" target="_blank" title="cc-hub.org" id="cofiFooterLinkCF" >
                <?php
                    echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/icons/cc-hub_16.png' align='top' />";
                ?>
                </a>

            </span>

            <span id="cofiFooterRight">

                <a href="#" target="_blank" title="Marketplace v<?php echo $cHelper->getVersion(); ?>" id="cofiFooterLinkMP">CCMarketplace</a>

            </span>

        </div>

		<?php
	}
	else {
		?>
		<!--
		<?php echo "Codingfish Marketplace v" . $cHelper->getVersion(); ?> http://www.codingfish.com
		-->
		<?php
	}
	?>

