<?php

/**
*
* CC-Marketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Installation
* @author		CC-Hub.org, Jextn.com
* @copyright	Copyright (C) 2005-2012 (Jextn). All rights reserved.
* @link			http://www.cc-hub.org
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


// version of new installed extension
$version = "0.96";

$componentInstaller =& JInstaller::getInstance();
$installer = new JInstaller();

$db	= &JFactory::getDBO();

// get folder name
$_rootDir = JPATH_ROOT;


// check if Marketplace system plugin is already installed
$pathToPlgMarketplaceSystem = $componentInstaller->getPath('source') . DS . 'plugins' . DS . 'system';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->nameQuote('#__extensions')
			. ' WHERE ' . $db->nameQuote('element') . ' = '
			. $db->Quote('ccmarketplace')
			. ' AND ' . $db->nameQuote('type') . ' = '
			. $db->Quote('plugin')
			. ' AND ' . $db->nameQuote('folder') . ' = '
			. $db->Quote('system');
$db->setQuery($query);

$marketplaceSystemPluginInstalled = (bool)$db->loadResult();


if ( $marketplaceSystemPluginInstalled) {

	// upgrade the CCMarketplace system plugin
	if ( !$installer->install( $pathToPlgMarketplaceSystem)) {

		echo "Failed to upgrade the CCMarketplace system plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully upgraded the CCMarketplace system plugin";
		echo "<br />";

	}

}
else {

	// install the Marketplace system plugin
	if ( !$installer->install( $pathToPlgMarketplaceSystem)) {

		echo "Failed to install the CCMarketplace system plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully installed the CCMarketplace system plugin";
		echo "<br />";

	}

}


// enable Marketplace system plugin
/*$query = 'UPDATE ' . $db->nameQuote('#__extensions')
       	. ' SET ' . $db->nameQuote('enabled') . ' = 1'
       	. ' WHERE ' . $db->nameQuote('element') . ' = ' . $db->Quote('ccmarketplace')
       	. ' AND ' .   $db->nameQuote('type')  . ' = ' . $db->Quote('plugin')
       	. ' AND ' .   $db->nameQuote('folder')  . ' = ' . $db->Quote('system');

$db->setQuery($query);


if (!$db->query()) {

    echo "Failed to enable the CCMarketplace system plugin!";
	echo "<br />";

}
else {

    echo "Successfully enabled the CCMarketplace system plugin";
	echo "<br />";

}*/



// check if Marketplace search plugin is already installed
$pathToPlgMarketplaceSearch = $componentInstaller->getPath('source') . DS . 'plugins' . DS . 'search';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->nameQuote('#__extensions')
			. ' WHERE ' . $db->nameQuote('element') . ' = '
			. $db->Quote('ccmarketplace')
			. ' AND ' . $db->nameQuote('type') . ' = '
			. $db->Quote('plugin')
			. ' AND ' . $db->nameQuote('folder') . ' = '
			. $db->Quote('search');

$db->setQuery($query);

$marketplaceSearchPluginInstalled = (bool)$db->loadResult();

if ( $marketplaceSearchPluginInstalled) {

	// upgrade the Marketplace search plugin
	if ( !$installer->install( $pathToPlgMarketplaceSearch)) {

		echo "Failed to upgrade the CCMarketplace search plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully upgraded the CCMarketplace search plugin";
		echo "<br />";

	}

}
else {

	// install the Marketplace search plugin
	if ( !$installer->install( $pathToPlgMarketplaceSearch)) {

		echo "Failed to install the CCMarketplace search plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully installed the CCMarketplace search plugin";
		echo "<br />";

	}

}



// enable Marketplace search plugin
/*$query = 'UPDATE ' . $db->nameQuote('#__extensions')
       	. ' SET ' . $db->nameQuote('enabled') . ' = 1'
       	. ' WHERE ' . $db->nameQuote('element') . ' = ' . $db->Quote('ccmarketplace')
       	. ' AND ' .   $db->nameQuote('type')  . ' = ' . $db->Quote('plugin')
       	. ' AND ' .   $db->nameQuote('folder')  . ' = ' . $db->Quote('search');

$db->setQuery($query);

if (!$db->query()) {

    echo "Failed to enable the CCMarketplace search plugin!";
	echo "<br />";

}
else {

    echo "Successfully enabled the CCMarketplace search plugin";
	echo "<br />";

}*/

//install modules starts
// Module 1 mod_ccmp_cycloscategories

// check if CCMarketplace mod_ccmp_cycloscategories module is already installed
$pathTomodMarketplacecyclosadcat = $componentInstaller->getPath('source') . DS . 'modules'.DS.'CyclosCategory';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->nameQuote('#__extensions')
			. ' WHERE ' . $db->nameQuote('element') . ' = '
			. $db->Quote('mod_ccmp_cycloscategories')
			. ' AND ' . $db->nameQuote('type') . ' = '
			. $db->Quote('module');

$db->setQuery($query);

$marketplaceSearchmodcyclosadcatInstalled = (bool)$db->loadResult();

if($marketplaceSearchmodcyclosadcatInstalled){
	// upgrade the CCMarketplace mod_ccmp_cycloscategories module
	if ( !$installer->install( $pathTomodMarketplacecyclosadcat)) {
		echo "Failed to upgrade the CCMarketplace Cyclos Categories module!";
		echo "<br />";
	}
	else {
		echo "Successfully upgraded the CCMarketplace Cyclos Categories module";
		echo "<br />";
	}
}
else {
	// install the CCMarketplace mod_ccmp_cycloscategories module
	if ( !$installer->install( $pathTomodMarketplacecyclosadcat)) {
		echo "Failed to install the CCMarketplace Cyclos Categories module!";
		echo "<br />";
	}
	else {
		echo "Successfully installed the CCMarketplace Cyclos Categories module";
		echo "<br />";
	}

}

// Module 2 mod_ccmp_newestads  

// check if CCMarketplace mod_ccmp_newestads module is already installed
$pathTomodMarketplacenewestads = $componentInstaller->getPath('source') . DS . 'modules'.DS.'NewestAds';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->nameQuote('#__extensions')
			. ' WHERE ' . $db->nameQuote('element') . ' = '
			. $db->Quote('mod_ccmp_newestads')
			. ' AND ' . $db->nameQuote('type') . ' = '
			. $db->Quote('module');

$db->setQuery($query);

$marketplaceSearchmodnewestadsInstalled = (bool)$db->loadResult();

if($marketplaceSearchmodnewestadsInstalled){
	// upgrade the CCMarketplace mod_ccmp_newestads module
	if ( !$installer->install( $pathTomodMarketplacenewestads)) {
		echo "Failed to upgrade the CCMarketplace Cyclos Newest Ads module!";
		echo "<br />";
	}
	else {
		echo "Successfully upgraded the CCMarketplace Cyclos Newest Ads module";
		echo "<br />";
	}
}
else {
	// install the CCMarketplace mod_ccmp_newestads module
	if ( !$installer->install( $pathTomodMarketplacenewestads)) {
		echo "Failed to install the CCMarketplace Cyclos Newest Ads module!";
		echo "<br />";
	}
	else {
		echo "Successfully installed the CCMarketplace Cyclos Newest Ads module";
		echo "<br />";
	}

}

// Module 3 mod_ccmp_randomads

// check if CCMarketplace Random Ads module is already installed
$pathTomodMarketplacerandomads = $componentInstaller->getPath('source') . DS . 'modules'.DS.'RandomAds';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->nameQuote('#__extensions')
			. ' WHERE ' . $db->nameQuote('element') . ' = '
			. $db->Quote('mod_ccmp_randomads')
			. ' AND ' . $db->nameQuote('type') . ' = '
			. $db->Quote('module');

$db->setQuery($query);

$marketplaceSearchmodrandomadsInstalled = (bool)$db->loadResult();

if($marketplaceSearchmodrandomadsInstalled){
	// upgrade the CCMarketplace Random Ads module
	if ( !$installer->install( $pathTomodMarketplacerandomads)) {
		echo "Failed to upgrade the CCMarketplace Cyclos Random Ads module!";
		echo "<br />";
	}
	else {
		echo "Successfully upgraded the CCMarketplace Cyclos Random Ads module";
		echo "<br />";
	}
}
else {
	// install the CCMarketplace Random Ads module
	if ( !$installer->install( $pathTomodMarketplacerandomads)) {
		echo "Failed to install the CCMarketplace Cyclos Random Ads module!";
		echo "<br />";
	}
	else {
		echo "Successfully installed the CCMarketplace Cyclos Random Ads module";
		echo "<br />";
	}

}
//install modules ends


// 1. get version information
$db->setQuery( 'SELECT COUNT(*) FROM `#__ccmarketplace_meta`');

if ( $db->loadResult() == 0) { // no record found = fresh installation

	$db->setQuery( "INSERT INTO `#__ccmarketplace_meta` ( id, version) VALUES ('1', '" . $version . "')");
	$db->query();

}
else { // upgrade

	// get current version
	$db->setQuery( "SELECT version FROM `#__ccmarketplace_meta` WHERE id='1'");
	$_version = $db->loadResult();

	switch ( $_version) {

		case "2.2": { // upgrade 2.2 -> new version

			echo "Upgrading from 2.2 to " . $version;
			echo "<br />";

            // replace older table files because of name conflicts
            $_fileToDelete = $_rootDir . "/administrator/components/com_ccmarketplace/tables/category.php";
            if ( file_exists( $_fileToDelete)) {
                unlink( $_fileToDelete);
            }
            $_fileToDelete = $_rootDir . "/administrator/components/com_ccmarketplace/tables/entry.php";
            if ( file_exists( $_fileToDelete)) {
                unlink( $_fileToDelete);
            }
            $_fileToDelete = $_rootDir . "/administrator/components/com_ccmarketplace/tables/label.php";
            if ( file_exists( $_fileToDelete)) {
                unlink( $_fileToDelete);
            }
            $_fileToDelete = $_rootDir . "/administrator/components/com_ccmarketplace/tables/user.php";
            if ( file_exists( $_fileToDelete)) {
                unlink( $_fileToDelete);
            }

		}

        case "2.2.1": { // upgrade 2.2.1 -> new version

      			echo "Upgrading from 2.2.1 to " . $version;
      			echo "<br />";

      	}

        case "2.2.2": { // upgrade 2.2.2 -> new version

      			echo "Upgrading from 2.2.2 to " . $version;
      			echo "<br />";

      	}


		default: {
			break;
		}

	}

	// done. set new version
	$db->setQuery( "UPDATE `#__ccmarketplace_meta` SET id='1', version='" . $version . "'");
	$db->query();

	echo "Upgrade done";
	echo "<br />";

}
    
?>
    <br />
    Feel free to contribute Bug fixes and additional feature to CC-Marketplace<br>
    You can find CC-Marketplace GIT under:&nbsp; <a
          href="https://github.com/lucode/ccmarketplace" target="_blank">https://github.com/lucode/ccmarketplace</a>
        <br>
 <!--   <span style="color: red;">CCMarketplace Cyclos Categories module is still bugy in this Beta Version!</span>
        <br style="color: red;"> -->

	
	  	<div style="margin: 10px 0px 10px 0px">
		    	<a href="http://www.cc-hub.org" title="cc-hub.org" target="_blank"><img alt="cc-hub.org" src="components/com_ccmarketplace/images/system/cc-hub-logo.png" /></a>
			</div>
     	<div style="width: 100%; background-color: lightgrey;">
		  <div style="float: left; margin: 0px;">
      <h2>CC-Marketplace</h2>
			<h3><a href="http://cc-hub.org/de/forum/7-cc-marketplace-komponente-component" target="_blank">Helpdesk/Forum</a> for CC-Marketplace!</h3>
    </div>
		
<?php

// 2. if we are doing a new installation get all users from users table
$db->setQuery( 'SELECT COUNT(*) FROM `#__ccmarketplace_users`');

if ( $db->loadResult() == 0) { // no records found = fresh installation

	$db->setQuery( "INSERT INTO `#__ccmarketplace_users` ( id, username) SELECT id, username FROM `#__users` ORDER BY id ASC");
	$db->query();

}



// 3. if there are no categories -> install some sample data
$db->setQuery( 'SELECT COUNT(*) FROM `#__ccmarketplace_categories`');

if ( $db->loadResult() == 0) { // no records found = fresh installation

} 


// 4. if there are no labels -> install some basic ones
$db->setQuery( 'SELECT COUNT(*) FROM `#__ccmarketplace_labels`');

if ( $db->loadResult() == 0) { // no records found = fresh installation

}
