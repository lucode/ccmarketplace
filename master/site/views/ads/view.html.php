<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Frontend
* @author		Lucas Huber
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


/**
 * Ads View
 */
class CcmarketplaceViewAds extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$document =& JFactory::getDocument();

		$app 		= JFactory::getApplication();
		$layout     = $this->getlayout();
		// get parameters
        $params = &$app->getParams();

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();
		$model  = $this->getmodel();
		//$model1 = &$this->getModel('ads', 'ModelPrefix');
		
		$document->setTitle( $params->get( 'page_title' ) ); 
		
		if($layout == "default_detailview3") {
			$adid             = JRequest::getInt('adid');
			$module           = JRequest::getInt('module');
			$data             = $model->detailview($adid);
			$menu_params      = "";
			if($module) {
				jimport( 'joomla.application.module.helper' );
				jimport( 'joomla.html.parameter' );
				$module_name = $module == 1 ? "mod_randomads" : "mod_newestads";
				$module      = &JModuleHelper::getModule($module_name); 
				$menu_params = new JParameter($module->params);
			}
			else {
				$mid              = JRequest::getInt('menu_id');//Menu ID
				$menu 	          = &JSite::getMenu(); // Load Particular Menu
				$menu_params      = $menu->getItem($mid);
				$menu_params      = $menu_params->params;
			}
			$options              = $model->getmemberoptions('d_member_profile as mp',$menu_params);
			
			$this->assignRef('menu_params'  , $menu_params);			
			$this->assignRef('data'         , $data);	
			$this->assignRef('options'      , $options);
			
		} else if($layout == "default_member") {				
			$meid 			  = JRequest::getInt( 'meid','0');
			$data             = $model->memberdetails($meid);
			$options          = $model->getmemberoptions();
			
			$this->assignRef('data'   ,	$data);	
			$this->assignRef('options',	$options);	
		} else if($layout == "member") {
			$meid 			  = JRequest::getInt( 'meid','0');
			$keyword          = JRequest::getVar('keywords','');
			$data             = $model->memberdetails('',$keyword);
			$options          = $model->getmemberoptions('show_mail_address as mail,d_member_profile as mp');
			
			$this->assignRef('data'   ,	$data);
			$this->assignRef('options',	$options);			
		} else { 
			$caid          = JRequest::getint('caid');
			if(empty($caid)) {
				$other_search  = JRequest::getvar('other_search');
				if(count($other_search)) 
				$caid          = $other_search['caid'];				
			}
			
			$data          = $this->get('adsdata');		
			$options       = $model->options_for_elements($data,'id', 'name', $caid);
			$mem_options   = $model->getmemberoptions('d_member_profile as mp,organisation as org',$adid); 
			$o_filter      = $model->getGroupfilterids(JRequest::getvar('other_search'),JRequest::getInt('id'));			
			$active   	   = $app->getMenu()->getActive();
			if(!count($active)) {
				$menu 	   = &JSite::getMenu(); // Load Particular Menu
				$active    = $menu->getItem(JRequest::getInt('Itemid'));
			}
			$menu_params   = $active->params;
			$fieldsService = $model->service();
			$filters       = $model->getFilters($fieldsService);
			
			$this->assignRef('menu_params'  , $menu_params);
			$this->assignRef('active_mid'   , $active->id);			
			$this->assignRef('params'       , $params);
			$this->assignRef('data'         , $data);	   			
			$this->assignRef('options'      , $options);	
			$this->assignRef('mem_options'  , $mem_options);		
			$this->assignRef('fieldsService', $fieldsService);
			$this->assignRef('o_filter'     , $o_filter);
			$this->assignRef('filters'      , $filters);
		}
		 
		$this->assignRef('model'  ,	$model);
		
        // display the view
        parent::display();

    }


}

