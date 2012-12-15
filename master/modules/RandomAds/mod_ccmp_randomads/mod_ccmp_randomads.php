<?php
/**
 * @package	CC-Marketplace
 * @subpackage	CC-Marketplace Random Ads
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
//defined('_JEXEC') or die;

defined('_JEXEC') or die;

jimport( 'joomla.environment.request' );

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$document 		= JFactory::getDocument();
//Load Layout Style
$document->addStylesheet(JURI::base(true) . '/modules/mod_ccmp_randomads/assets/style.css');
JHtml::_('script','modules/mod_ccmp_randomads/assets/script.js');

$helper 		= new modrandomadsHelper();
$value          = $helper->getWebservice($params);
$data  		    = $helper->getAdsdata();

$parameters                = array();							
$parameters['id']          = $params->get('id','0');
$parameters['show_image']  = $params->get('show_image','1');
$parameters['ad_per_page'] = $params->get('ad_per_page','5');
$parameters['ad_width']    = $params->get('ad_width','167px');
$parameters['ad_height']   = $params->get('ad_height','180px');
$parameters['itoshow']     = $params->get('itoshow','3');
$parameters['view']        = $params->get('view','vertical');
$seconds                   = $params->get('seconds','50');

$mod_id                    = "random_module_rand_".$module->id;

?>
<!-- Function randomad.php gets new random Ads from Cyclos after defined $seconds -->
<script language="JavaScript" type="text/javascript">
  setInterval(function() { randomads('<?php echo json_encode($parameters); ?>','<?= $mod_id; ?>'); }, <?= $seconds * 1000?>);
</script>
<?php
require JModuleHelper::getLayoutPath('mod_ccmp_randomads', $params->get('view', 'vertical'));

?>
