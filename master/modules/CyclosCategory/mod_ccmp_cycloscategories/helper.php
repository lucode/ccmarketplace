<?php
/**
 * Helper class for CC-Marketplace Cyclos Categories module
 * 
 * @package    CC-Marketplace
 * @subpackage Modules
 * @link 
 * @license        GNU/GPL, see LICENSE.php
 * mod_ccmp_cycloscategories is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

class modCyclosCategoriesHelper
{
    /**
     * Retrieves the ads
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    private function ads() {
        if (!isset($this->ads)) {
            $this->ads = $this->instantiate_client('ads');
        }
        return $this->ads;
    }

    function instantiate_client(&$params) {
	$wsdl = $params->get('cyclos_server_root')."/services/ads?wsdl";
	try {
	  //return new SoapClient($wsdl, array('trace' => true,'soap_version'   => SOAP_1_1,'exceptions' => true));
	  return new SoapClient($wsdl, array('login' => $params->get('adsuser'), 'password' => $params->get('adspass')));
        } catch (Exception $e) {
            //echo "Error retrieving WSDL file $wsdl: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('Error retrieving WSDL file').$wsdl.' : '.$e->getMessage());
        }
    }

    #Returns a list of ad categories
    public function list_ad_categories(&$cyclosClient) {
        try {
            $result = $cyclosClient->listCategories(array());
            return $result->return;
        } catch (SoapFault $e) {
            //echo "Error listing advertisement categories: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('Error listing advertisement categories').' : '.$e->getMessage());
        }
    }
    public function list_categories_tree(&$cyclosClient) {
        try {
            $result = $cyclosClient->listCategoryTree(array());
            return $result->return;
        } catch (SoapFault $e) {
            //echo "Error listing advertisement categories tree: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('Error listing advertisement categories tree').' : '.$e->getMessage());
        }
    }
	
	public function getWebservices($params) {
		$id        =  $params->get('id');
    	$db        =  & JFactory::getDBO();
		$query	   = $db->getQuery(true);
		$query->select('s.*');
		$query->from('#__ccmarketplace_ws_channels as s');
		$query->where('s.id = '.$id); 
		$query->where('s.published = 1');
		$db->setquery($query);
		$wservices = $db->loadObject();		
		return $wservices;
    }

    /*Ensures an element is returned as array. 
       When null, returns an empty array. 
       When an array, returns itself. 
       Otherwise, an array containg the just the element*/
      function ensure_array($element) {
      if (empty($element)) {
        return array();
      }
      if (array_key_exists(0, $element)) {
        return $element;
      }
      return array($element);
    }
}
?>
