<?php
/**
 * @package   CC-Marketplace 
 * @subpackage Modules Cyclos Catergorie
 * @link 
 * @license        GNU/GPL, see LICENSE.php
 * mod_ccmp_cycloscategories is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
  defined( '_JEXEC' ) or die( 'Restricted access' );

  // Include the syndicate functions only once
  require_once( dirname(__FILE__).DS.'helper.php' );
  
  $webservice     = modCyclosCategoriesHelper::getWebservices($params);  
  if(count($webservice)) {
	  $params->set('cyclos_server_root',$webservice->serverurl);
	  $params->set('adsuser',$webservice->webserver_user);
	  $params->set('adspass',$webservice->webserver_password);

	  // web service client
	  $soapClientAds = modCyclosCategoriesHelper::instantiate_client($params);

	  $showCategories = $params->get('showCategories');
	  $menuDepth = $params->get('menuDepth');
	  $shCountOffer = $params->get('shCountOffer');
	  if($showCategories == "LEAF"){
		$myCategories = modCyclosCategoriesHelper::list_ad_categories($soapClientAds);
	  } else { //ALL
		$myCategories = modCyclosCategoriesHelper::list_categories_tree($soapClientAds);
	  }

	  $myCategories = modCyclosCategoriesHelper::ensure_array($myCategories);
  }
  require( JModuleHelper::getLayoutPath( 'mod_ccmp_cycloscategories','default' ) );
?>
