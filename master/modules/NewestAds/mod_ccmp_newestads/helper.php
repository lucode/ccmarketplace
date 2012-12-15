<?php

// no direct access
defined('_JEXEC') or die;

require_once JPATH_SITE.'/components/com_ccmarketplace/models/ads.php';

class modnewestadsHelper {
	public $model;
	public $webservice;
	public $params;

	public function getWebservice($param) {
		$id                = $param->get('id', '');
		$this->model       = new CCmarketplaceModelAds();
		$this->webservice  = $this->model->getWebservices($id);
		$this->params      = $param;
		if($id) {
		 return true;
		} else {
		 return false;
		}
	}

	public function getAdsdata() {
		$webservice         			= $this->webservice;
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

		//if($load == "member") {
			//$soapClientAds              = $this->memberClient($ws_details);
		//} else {
			$soapClientAds              = $this->model->adsClient($ws_details);
		//}

		$return                             = $this->getAds($soapClientAds,$ws_details);
		$return['page']->cyclos_server_root = $ws_details->cyclos_server_root;

		return $return;
    }

	public function getAds($soapClientAds,$ws_details) {
		$categories = $this->model->list_categories_tree($soapClientAds);
		$categories = $this->model->ensure_array($categories);

		/*henry : myparams : its must be an opional from backend*/
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
		$menu_params 			  = $this->params;
		$myParams->pageSize       = $menu_params->get('ad_per_page',5);
		$days                     = $menu_params->get('days',30);
		$myParams->tradeType      = $ws_details->typeoftrade;
		$myParams->currentPage    = 0;
		$myParams->categoryId     = "";
		$myParams->keywords       = "";
		$myParams->withImagesOnly = $menu_params->get('show_image',0);
		$actualCategory           = "";
        $myParams->memberFields[] = $field_value;
		$myParams->adFields[]     = $ads_value1;

		//"since" => "timePeriod:0D,1D,2D,3D,4D,5D,6D,1W,2W,3W,1M,2M,3M,4M,5M,6M",
		$myParams->since = array('number' => $days ,'field' => 'DAYS');

		$ads_value2->value        = $ads_value2->value;
		$myParams->adFields[]     = $ads_value2;

		if($ws_details->organisation) {
			$myParams->memberGroupFilterIds =  explode(',',$ws_details->organisation);
		}
		//$myParams->area           = $ws_details->area;
		//$myParams->adstype        = $ws_details->adstype;
		//$myParams->cynet          = $ws_details->cynet;
        //$myParams->groupFilterIds = $ws_details->groupFilterIds;

		if(!empty($_REQUEST['caid'])){
			$categoryId               = trim($myParams->categoryId);
			$actualCategory           = $this->model->load_category($categoryId,$categories);
			$myParams->category       = $categoryId;
		}else if(empty($myParams->keywords)){
			//$myParams->randomOrder    = true;
			//$myParams->withImagesOnly = true;

		}

		//unset($myParams->adFields); unset($myParams->memberFields); //Henry Unset

		$page            = $this->model->search_ads($myParams,$soapClientAds);
		$page->ads       = $this->model->ensure_array(@$page->ads);
		$totalCount      = $page->totalCount;
		$currentPage     = $page->currentPage;
		$page->size      = $myParams->pageSize;
		$return['actualCategory']  = $actualCategory;
		$return['page']            = $page;
		return $return;
	}
}
?>