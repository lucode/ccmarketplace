<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CC-Marketplace
* @subpackage	Frontend (Ads Models)
* @author		Lucas Huber
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');


/**
 * CCMarketplace Ads Model
 */

class CCMarketplaceModelAds extends JModel {

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
   var $search_options = null;
	
   public function __construct() {
		parent::__construct(); 		 
    }
	
   public function detailview($adid) { 
		$cyclosClient     			    = $this->getAdsdata("load");
		$ws_details                     = $cyclosClient['ws_details'];	
		$data           			    = $this->load_ad($adid,$cyclosClient['soap']);
		$shop_client                    = $this->webshopClient($ws_details); 
		$return   					    = array();     
		$return['ticket']               = $this->generateTicket($shop_client,$data);	
		$return['cyclos_server_root']   = $ws_details->cyclos_server_root;
		$return['data']                 = $data;
		return $return;
   }   
   
   public function memberdetails($meid = null,$keyword = null) { 
		$cyclosClient     			    = $this->getAdsdata("member");
		$ws_details                     = $cyclosClient['ws_details'];
		
		if(empty($meid) || $meid <= 0) { 
			$data           			= $this->search_members($cyclosClient['soap'],$keyword);
		} else {
			$data           			= $this->load_member($meid,$cyclosClient['soap']);
		}
		
		$return   					        = array();     		
		if($data->totalCount || $meid) {
			$return['cyclos_server_root']   = $ws_details->cyclos_server_root;
			$return['data']                 = $data;
		}	
		
		return $return;
   }
   
   public function load_member($id, &$cyclosClient) {		
		
		$sCF	= $this->getmemberoptions("show_customfield as s_cf");		
		$params = array("showCustomFields" => $sCF->s_cf );
		try {
			$result = $cyclosClient->load(array("id" => $id),$params);
			return $result->return;
		} catch (SoapFault $e) {
			//echo "Error loading an advertisement: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('CCMP_LOAD_ADV').' : '.$e->getMessage());
		}
	}
   
   public function memberClient(&$ws_details) {
		$wsdl = $ws_details->cyclos_server_root."/services/members/ads?wsdl";
		try {
			return new SoapClient($wsdl, array('login' => $ws_details->adsuser, 'password' => $ws_details->adspass));
		} catch (Exception $e) {
			JError::raiseWarning(20, JText::_('CCMP_LOAD_RETRIVE_ADV').' : '.$e->getMessage());
			//echo "Error retrieving advertisements webservice: ", $e->getMessage();
		}
	}
	
	public function service() {
		$ws_detail  = $this->getAdsdata("service");
		$ws_details = $ws_detail['ws_details'];
		$wsdl       = $ws_details->cyclos_server_root."/services/fields?wsdl";	
		try {
			return new SoapClient($wsdl, array('login' => $ws_details->adsuser, 'password' => $ws_details->adspass));			
		} catch (Exception $e) {
			JError::raiseWarning(20, JText::_('CCMP_LOAD_RETRIVE_ADV').' : '.$e->getMessage());
			//echo "Error retrieving advertisements webservice: ", $e->getMessage();
		}
	}

   public function getAdsdata($load = null) {
		$webservice         			= $this->getWebservices();
		$ws_details                     = new stdClass(); 
		$ws_details->cyclos_server_root = $webservice->serverurl; 
		$ws_details->adsuser            = $webservice->webserver_user;
		$ws_details->adspass            = $webservice->webserver_password;
		$ws_details->webshopuser        = $webservice->shop_user;
		$ws_details->webshoppass        = $webservice->shop_password;
		$ws_details->groupFilterIds     = $webservice->groupFilterIds;
		$ws_details->area               = $webservice->area;
		$ws_details->adstype            = $webservice->adstype;
		$ws_details->cynet              = $webservice->cynet;
		$ws_details->typeoftrade        = $webservice->type_of_trade;
		$ws_details->organisation       = $webservice->organisation;
		
		if($load == "member") {
			$soapClientAds              = $this->memberClient($ws_details);
		} else {
			$soapClientAds              = $this->adsClient($ws_details);
		}
		if(empty($load)) {
			$return                             = $this->getAds($soapClientAds,$ws_details);				
			$return['page']->cyclos_server_root = $ws_details->cyclos_server_root;				
		} else {
			$return['soap']         = $soapClientAds;				
			$return['ws_details']   = $ws_details;				
		}
		
		return $return; 
    }

   public function getWebservices($id = null) {
		if(empty($id)) {
			$id        = JRequest::getInt('id');
		}				
    	$db        = & JFactory::getDBO();
		$query	   = $db->getQuery(true);
		$query->select('s.*');
		$query->from('#__ccmarketplace_ws_channels as s');
		$query->where('s.id = '.$id); 
		$query->where('s.published = 1');
		$db->setquery($query);
		$wservices = $db->loadObject();		
		return $wservices;
    }
	
	public function getmemberoptions($options = null,$menu_params = null) {
		$id        = JRequest::getInt('id');
		if($menu_params && empty($id)) {
			$id = $menu_params->get('id');
		}
		$db        = & JFactory::getDBO();
		$query	   = $db->getQuery(true);
		if($options) {
			$query->select($options);
		} else {
           $query->select('s.show_name,s.show_mail_address as mail,s.show_photo as photo,s.show_city as city,s.show_area as state,s.show_code as code,s.show_ms as membership,d_member_profile as mp,show_customfield as show_customfield');
//	LUH	   $query->select('s.show_name,s.show_mail_address as mail,s.show_photo as photo,s.show_city as city,s.show_code as code,s.show_ms as membership,d_member_profile as mp,show_customfield as show_customfield');
		}
		$query->from('#__ccmarketplace_ws_channels as s');
		$query->where('s.id = '.$id); 
		$query->where('s.published = 1');
		$db->setquery($query);
		$wservices = $db->loadObject();	
		return $wservices;
	}

    public function adsClient(&$ws_details) {
		$wsdl = $ws_details->cyclos_server_root."/services/ads?wsdl";
		try {
			return new SoapClient($wsdl, array('login' => $ws_details->adsuser, 'password' => $ws_details->adspass));
		} catch (Exception $e) {
			JError::raiseWarning(20, JText::_('CCMP_LOAD_RETRIVE_ADV').' : '.$e->getMessage());
			//echo "Error retrieving advertisements webservice: ", $e->getMessage();
		}
	}

	public function getAds($soapClientAds,$ws_details) {
		$categories = $this->list_categories_tree($soapClientAds);
		$categories = $this->ensure_array($categories);

		/*henry : myparams : its must be an option from backend*/
		$field_value 		       = new stdclass();
		$field_value->internalName = 'area'; //38;
		$field_value->value        = $ws_details->area ? $ws_details->area : "";
		
		$ads_value1		           = new stdclass();
		$ads_value1->internalName  = 'cynet'; //47;
		if($ws_details->cynet == 1) $ads_value1->value = 'true'; 
		else if($ws_details->cynet == 0) $ads_value1->value = ''; 
		else $ads_value1->value    = ""; 
		
		$ads_value2 	           = new stdclass();
		$ads_value2->internalName  = 'adstype'; //'32';
		if($ws_details->adstype == 1) $ads_value2->value = '281'; 
		else if($ws_details->adstype == 2) $ads_value2->value = '282';
		else if($ws_details->adstype == 3) $ads_value2->value = '283'; 		
		else $ads_value2->value   = "";

		$myParams    			  = new stdclass();
		$app 		 			  = JFactory::getApplication();
		$active   	 			  = $app->getMenu()->getActive();	
		
		if(!count($active)) {
			$menu 	          	  = &JSite::getMenu(); // Load Particular Menu
			$active      	      = $menu->getItem(JRequest::getInt('Itemid'));
		}	
		$menu_params 			  = $active->params;
		$mp_trade_type            = $menu_params->get('tradetype','');
		$mp_ads_type              = $menu_params->get('adstype','');		
		$myParams->pageSize       = $menu_params->get('ad_per_page',5);
		$myParams->withImagesOnly = $menu_params->get('show_image',0);			
		$myParams->tradeType      = $mp_trade_type ? $mp_trade_type : $ws_details->typeoftrade;
		$myParams->currentPage    = @$_REQUEST['curp']; 
		$myParams->categoryId     = @$_REQUEST['caid'];
		$myParams->keywords       = @$_REQUEST['keywords'];	 
			 
		$actualCategory           = ""; 
		
		if($_POST['type_of_trade']) {
			$myParams->tradeType  = $_POST['type_of_trade'];
		}		
		
		$other_search             = array('curp' => $_REQUEST['curp'],'caid' => $_REQUEST['caid'],'keywords' => $_REQUEST['keywords'],'type_of_trade' => $_POST['type_of_trade'],'organisation' => $_POST['organisation']);
		JRequest::setVar('other_search', $other_search );	
			
		if($mp_ads_type == "Both") {
			$ads_value2->value    =  "";
		} else {
			$ads_value2->value    = $mp_ads_type ? $mp_ads_type : $ads_value2->value;
		}
		
		//$myParams->adFields[]     = $ads_value2;
		//if($ws_details->organisation) {			
			//$myParams->groupFilterIds =  explode(',',$ws_details->organisation);
		//}
		//$myParams->area           = $ws_details->area; 
		//$myParams->adstype        = $ws_details->adstype;            
		//$myParams->cynet          = $ws_details->cynet; 
    // LUH TBD
    // $myParams->groupFilterIds = $ws_details->groupFilterIds; 
		if($ws_details->organisation) {	
			//$myParams->memberGroupIds = $this->getGroupcodes($ws_details->organisation);
			//$myParams->memberGroupFilterIds = $this->getGroupcodes($ws_details->organisation);
			$myParams->memberGroupFilterIds = explode(",",$ws_details->organisation);
		}
		
		$search                     = $_POST['search'];
		if($search == 1) {
		//echo "<Pre>"; print_r($_POST['memberFieldIds']); print_r($_POST['memberFieldValues']); exit;	
		
			if($_POST['organisation']) {
				//$myParams->memberGroupIds = $this->getGroupcodes($_POST['organisation']);
				$myParams->memberGroupFilterIds   = array();
				$myParams->memberGroupFilterIds[] = $_POST['organisation'];
			}
			
			$MfieldIds          = $this->ensure_array($_POST['memberFieldIds']);
			$MfieldValues       = $this->ensure_array($_POST['memberFieldValues']);
			
			$AfieldIds          = $this->ensure_array($_POST['adFieldIds']);
			$AfieldValues       = $this->ensure_array($_POST['adFieldValues']);
			
			$MfieldIdsSize      = count($MfieldIds);
			$MfieldValuesSize   = count($MfieldValues);
			
			$AfieldIdsSize      = count($AfieldIds); 
			$AfieldValuesSize   = count($AfieldValues);
			
			/*if ($MfieldIdsSize != $MfieldValuesSize) {
				JError::raiseWarning(20, JText::_('Invalid member field submission'));
			}
			
			if ($AfieldIdsSize != $AfieldValuesSize) {
				JError::raiseWarning(20, JText::_('Invalid ad field submission'));
			}*/
			
			$myParams->memberFields             = array();
			for ($i = 0; $i < $MfieldIdsSize; $i++) {
				if(!empty($MfieldValues[$i])) {
					$Mfield_value               = new stdclass();
					$Mfield_value->internalName = $MfieldIds[$i];
					$Mfield_value->value        = $MfieldValues[$i];
					$myParams->memberFields[]   = $Mfield_value;
					$s_mFields[$MfieldIds[$i]]  = $Mfield_value;
				}
			}
			JRequest::setVar('memberFields', $s_mFields );
			
			$myParams->adFields                 = array();
			for ($i = 0; $i < $AfieldIdsSize; $i++) {
				if(!empty($AfieldValues[$i])) {
					$Afield_value               = new stdclass();
					$Afield_value->internalName = $AfieldIds[$i];
					$Afield_value->value        = $AfieldValues[$i];
					$myParams->adFields[]       = $Afield_value;
				}
			}
			JRequest::setVar('adFields', $myParams->adFields );			
		}		
		
		if($_POST['ex_search'] == 2) {		
			if($_POST['ex_type_of_trade']) {
				$myParams->tradeType  = $_POST['ex_type_of_trade'];
				JRequest::setVar('ex_type_of_trade', $myParams->tradeType );
			}			
		}
		
		/*$have                         = 0;
		if($myParams->adFields) {
			$have 					  = $this->in_multiarray("47", $myParams->adFields);
		} */
		
		if($field_value->value) {
			$myParams->memberFields[] = $field_value;
		}			  
			
		if($ads_value1->value) {
			$myParams->adFields[]     = $ads_value1;
		}
		
		if($ads_value2->value) {
			$myParams->adFields[]     = $ads_value2;
		} 		
		
		//unset($myParams->adFields); //Henry Unset		
		
		if(!empty($_REQUEST['caid'])){		
			$categoryId               = trim($myParams->categoryId);
			$actualCategory           = $this->load_category($categoryId,$categories);
			$myParams->category       = $categoryId;
		}
		
		//echo "<Pre>"; /*print_r($ads_value2);*/ print_r($myParams);   echo "</Pre>"; //exit;
		
		$page            = $this->search_ads($myParams,$soapClientAds);				
		$page->ads       = $this->ensure_array($page->ads);
		$totalCount      = $page->totalCount; 
		$currentPage     = $page->currentPage;
		$page->size      = $myParams->pageSize;
		$page->count_os['offer']   = $this->getCount_OS($myParams,$soapClientAds,"OFFER");	
		$page->count_os['search']  = $this->getCount_OS($myParams,$soapClientAds,"SEARCH");	
		$return['actualCategory']  = $actualCategory;
		$return['page']            = $page;	
		
		return $return;
	}
	
	function getCount_OS($myParams,$soapClientAds,$tradeType) {
		$myParams->tradeType  = $tradeType;	
		$myParams->pageSize	  = 1;
		$data                 = $this->search_ads($myParams,$soapClientAds);
		return $data->totalCount; 
	}
	
	function in_multiarray($elem, $array)
    {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while($bottom <= $top)
        {
			$array[$bottom]->field;
            if($array[$bottom]->field == $elem)
                return true;
            else 
                if(is_array($array[$bottom]->field))
                    if(in_multiarray($elem, ($array[$bottom][field]->field)))
                        return true;
                    
            $bottom++;
        }        
        return false;
    }
// get Organisation Group Filtre Table, NA; Not yet ready!!!!	
	function getOrganisation($gcode) {
		$db       = & JFactory::getDBO();
		$query	  = $db->getQuery(true);
		$query->select('gname');
		$query->from('#__ccmarketplace_ws_grpfiltrs');
		$query->where('find_in_set('.$gcode.')'); 
		$db->setquery($query);
		$gname    = $db->loadResult();	
		return $gname; 
	}
// get PDF URL from Channel Table 
	function getPDFurl($gurl) {
		$db       = & JFactory::getDBO();
		$query	  = $db->getQuery(true);
		$query->select('pdfurl');
		$query->from('#__ccmarketplace_ws_channels');
		$query->where('id in ('.$gurl.')'); 
		$db->setquery($query);
		$pdfurl    = $db->loadResult();	
		return $pdfurl; 	
	}
	
// get Member AeraName from Custom Member fields, NA; Not yet ready!!!!		
		public function getAeraName($options = null,$menu_params = null) {
		$id        = JRequest::getInt('id');
		if($menu_params && empty($id)) {
			$id = $menu_params->get('id');
		}
		$db        = & JFactory::getDBO();
		$query	   = $db->getQuery(true);
		if($options) {
			$query->select($options);
		} else {
           $query->select('s.show_city as city,s.show_area as area');
//	LUH	   $query->select('s.show_name,s.show_mail_address as mail,s.show_photo as photo,s.show_city as city,s.show_code as code,s.show_ms as membership,d_member_profile as mp,show_customfield as show_customfield');
		}
		$query->from('#__ccmarketplace_ws_channels as s');
		$query->where('s.id = '.$id); 
		$query->where('s.published = 1');
		$db->setquery($query);
		$wservices = $db->loadObject();	
		return $wservices;
	}

	
	public function list_categories_tree(&$cyclosClient) {
		try {
			$result = $cyclosClient->listCategoryTree(array());
			$this->make_select_option($result->return);
			return $result->return;
		} catch (SoapFault $e) {
			//echo "Error listing advertisement categories: ", $e->getMessage();			
			JError::raiseWarning(20, JText::_('CCMP_LIST_CATEGORY').' : '.$e->getMessage());
		}
	}
	
	public function make_select_option($datas) {
		foreach($datas as $data) {
			$object                 = new stdclass();
			$object->id             = $data->id;
			$object->name           = $data->name;
			$this->search_options[] = $object;
		}
	}

	public function ensure_array($element) {
		if (empty($element)) {
			return array();
		}
		if (array_key_exists(0, $element)) {
			return $element;
		}
		return array($element);
	}

	public function load_category($catId, $categories) {
		try {
			foreach($categories as $category){
				if($category->id == $catId){
					return $category;
				}else{
					if(!empty($category->children)){
						$this->load_category($catId,$category->children);
					}
				}
			}
		} catch (Exception $e) {
			//echo "Error searching categories: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('CCMP_SEARCH_CATEGORY').' : '.$e->getMessage());
		}
	}

	//from fullads
    function search_ads($params, &$cyclosClient) {	
        try {
			$keywords = $params->keywords;
			if ($keywords != null && $keywords != '') {
			$result = $cyclosClient->fullTextSearch(array("params" => $params));
			} else {
			$result = $cyclosClient->search(array("params" => $params));
			}

			$page = $result->return;

			//$page->ads = ensure_array($page->ads);
			return $page;
        } catch (SoapFault $e) {
			//echo "Error searching for advertisements: ", $e->getMessage();			
			JError::raiseWarning(20, JText::_('CCMP_SEARCH_AD').' : '.$e->getMessage());
        }
    }
	
	//	Builds a list of options for a given list of elements
	function options_for_elements($data, $value_field, $label_field, $selected = null) {
		$input    = $this->search_options;
		$elements = array_map("unserialize", array_unique(array_map("serialize", $input)));
		$options  = "";		
		foreach ($elements as $el) {
	  		$options = $options . "<option value='" . $el->id . "'" . ($el->id == $selected ? " selected" : "") . ">" . $el->name . "</option>";
		}
		return $options;
	}
	
	// Loads an ad with the given identifier
	function load_ad($id, &$cyclosClient) {
		try {
			$result = $cyclosClient->load(array("id" => $id));
			return $result->return;
		} catch (SoapFault $e) {
			//echo "Error loading an advertisement: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('CCMP_LOAD_ADV').' : '.$e->getMessage());
		}
	}
	
	function webshopClient($values) {
		$user_details       = array('login' => $values->webshopuser, 'password' => $values->webshoppass);
		$wsdl               = $values->cyclos_server_root."/services/webshop?wsdl";
		try {		
			return new SoapClient($wsdl,$user_details );
		} catch (Exception $e) {
			//echo "Error retrieving webshop webservice: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('CCMP_RETRIVING_WEBSERVICE').' : '.$e->getMessage());
		}
	}
	
	function generateTicket($webshopclient,$ad){
	//echo "<Pre>"; print_r($ad); exit;
		// Setup the payment parameters
		$ticketparams                = new stdclass();
		$ticketparams->amount        = $ad->price;
		$ticketparams->description   = $ad->title;
		$ticketparams->clientAddress = $_SERVER['REMOTE_ADDR'];
		$ticketparams->toUsername    = $ad->owner->username;
		$ticketparams->returnUrl     = "http://adodis.in/henry/ccmarketprice/modules/mod_cyclosad/payment_cyclos/complete_payment.php?adId=0";

		// Generate the ticket
		try {
			//Ensure the input parameter is named 'params' and the output, 'return'
			$ticket = $webshopclient->generate(array('params' => $ticketparams))->return;
			return $ticket;
		} catch (SoapFault $e) {
			//("Error generating a payment ticket: $e");
			JError::raiseWarning(20, JText::_('CCMP_PAYMENT_TICKET').' : '.$e);
		}

		}
		
	function search_members($cyclosClient,$keyword = null) {
		$app 		 			  = JFactory::getApplication();
		$active   	 			  = $app->getMenu()->getActive();
		$menu_params 			  = $active->params;
		$params 				  = new stdclass();
		$sCF					  = $this->getmemberoptions("show_customfield as s_cf");
		$params->showCustomFields = $sCF->s_cf;
		$params->pageSize		  = $menu_params->get('member_per_page',5);
		$params->randomOrder	  = 0;
		$params->showImages		  = $menu_params->get('show_mem_image',0); 
		$params->keywords         = $keyword;
		$params->currentPage      = @$_REQUEST['curp'];
		//$params->groupFilterIds	= array(2);
		try {
			$keywords 	= $params->keywords;
			if ($keywords != null && $keywords != '') {
				$result = $cyclosClient->fullTextSearch(array("params" => $params));
			} else {
				$result = $cyclosClient->search(array("params" => $params));
			}
		
			$page   = $result->return;
			
			if(count($page->members) < 2 ) { 
				$member        = $page->members;
				$page->members = array($member);
			}
			$page->size        = $params->pageSize;
			return $page;
		} catch (SoapFault $e) {
			//echo "Error searching for Member: ", $e->getMessage();
			JError::raiseWarning(20, JText::_('CCMP_SEARCHING_MEMBER').' : '.$e->getMessage());
		}
    }
	
	function getGroupfilterids($active = null,$channelid = null) {
		
		$active = $active['organisation'];
		
		$db	    = JFactory::getDBO();

		$query  = 'SELECT * FROM #__ccmarketplace_ws_grpfiltrs WHERE FIND_IN_SET("'.$channelid.'", webchannelid) AND published = 1' ;
		$db->setQuery( $query );
		$row    = $db->loadAssocList();

		if (!$db->query())
		{
			JError::raiseWarning(20, JText::_('Error'));
		}

		$option[] = JHTML::_('select.option',  '', JText::_( 'CCMP_ANY_ORGANISATION' ));
		foreach ( $row as $channel)
		{
			$option[] = JHTML::_('select.option',$channel['gid'],$channel['gname']);
		}
		
		if(empty($active)) {
			$active = "3";
		}

		$group = JHTML::_('select.genericlist',  $option, 'organisation', 'class="organisation"', 'value', 'text', $active);
		

		return $group;
	}
	
	function getFilters($fieldsService) {
		$memberFields = null;
		try {
			$memberField  = $fieldsService->memberFieldsForAdSearch(array());
			$memberFields = $this->ensure_array($memberField->return);
		} catch (SoapFault $e) {
			$memberFields = null;
		}

		$adFields = null;
		try {
			$adField  = $fieldsService->adFieldsForAdSearch(array());
			$adFields = $this->ensure_array($adField->return);
		} catch (SoapFault $e) {
			$adFields = null;
		}
		
		$return = array('memberFields' => $memberFields,'adFields' => $adField);
		
		return $return;
	}
}
