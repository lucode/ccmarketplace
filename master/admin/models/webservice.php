<?php
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Backend
* @author		Lucas Huber
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modeladmin');

class CCMarketplaceModelWebservice extends JModel
{
		var $_id = null;

	var $_data = null;



	function __construct() {

		parent::__construct();

		$array  = JRequest::getVar( 'cid', array(0), '', 'array');
		$edit	= JRequest::getVar( 'edit', true);

		if($edit) {

			$this->setId( (int)$array[0]);

		}

	}



	function setId( $id) {

		$this->_id		= $id;

		$this->_data	= null;

	}



	function &getData() {

		if ( $this->_loadData()) {

			$user = &JFactory::getUser();

		}
		else  {
			$this->_initData();
		}

		return $this->_data;
	}



	function _loadData() {

		if (empty($this->_data)) {

			$query = 'SELECT * FROM #__ccmarketplace_ws_channels WHERE id = '.(int) $this->_id;

			$this->_db->setQuery($query);

			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;

		}

		return true;

	}



	function store( $data) {

        $row =& JTable::getInstance('webservice', 'CCmarketplaceTable');
		
		$data['organisation'] = implode(',',$data['organisation']);
		$data['serverurl']    = trim($data['serverurl']); 

		if ( !$row->bind($data)) {

			$this->setError($this->_db->getErrorMsg());

			return false;

		}

		if ( !$row->check()) {

			$this->setError( $this->_db->getErrorMsg());

			return false;

		}

		if ( !$row->store()) {

			$this->setError( $this->_db->getErrorMsg());

			return false;

		}

		//return true;
		return $row->id;
	}



	function _initData() {

		if (empty($this->_data)) {

			$category = new stdClass();

			$category->id				= 0;

			$this->_data				= $category;

			return (boolean) $this->_data;

		}

		return true;

	}



	function delete($cid = array()) {

		$result = false;

		if (count( $cid )) {

			JArrayHelper::toInteger($cid);

			$cids = implode( ',', $cid );

			$query = 'DELETE FROM #__ccmarketplace_ws_channels' . ' WHERE id IN ( '.$cids.' )';

			$this->_db->setQuery( $query );

			if(!$this->_db->query()) {

				$this->setError($this->_db->getErrorMsg());

				return false;

			}

		}

		return true;

	}
	
	function ensure_array($element) {
		if (empty($element)) {
			return array();
		}
		if (array_key_exists(0, $element)) {
			return $element;
		}
		return array($element);
	}
	
	public function getfields($webservice = null) {
		$ajax = JRequest::getvar('ajax');
		if($ajax == 1) {
			$wsdl              = JRequest::getvar('cs_root')."/services/fields?wsdl";
		} else {
			$wsdl              = trim($webservice->serverurl)."/services/fields?wsdl"; 
		}
		try {
			$fieldsService = new SoapClient($wsdl);
		} catch (Exception $e) {
			//die("Error retrieving WSDL file $wsdl: $e");
			JError::raiseWarning(20, 'Error retrieving WSDL file'.$wsdl.'/n'.$e);
		} 
		
		$memberFields      = null;
		$member_data       = null;
		
		try {
			//$result = $fieldsService->memberFieldsForAdSearch(array());
			//$result = $fieldsService->adFieldsForAdSearch(array());  
			//$result = $fieldsService->allMemberFields(array());
			//$result = $fieldsService->possibleValuesForAdField(array('name' => 'adstype')); 
			$result = $fieldsService->memberFieldsForAdSearch(array());	 			
			$memberFields = $this->ensure_array($result->return); 
		} catch (SoapFault $e) {
			//die("Error retrieving member fields for advertisement search: $e");
			JError::raiseWarning(20, 'Error retrieving member fields for advertisement search/n'.$e);
		}	
		
		if(count($memberFields)) :
		$data = "<table class=\"admintable\" width=\"100%\">"; 
		foreach($memberFields as $field) {
		if($field->internalName == "area" || $field->internalName == "groupFilterIds") : 
			if(count($webservice) > 0) {
				$field_name    =  $field->internalName; 
				$member_data   =  $webservice->$field_name;
			}
			$data .= "<tr>";
			$data .= '<td class="key" style="padding: 10px; width:32%; "><label>'.$field->displayName.'</label></td>
				<td style="padding: 10px; width:40%; ">';  
					//This hidden will store the field ids, to match positionally the respective values			
			$data .= '<input type="hidden" name="'.$field->internalName.'" value="'. $field->id .'" />';
					//Check the field type
					if ($field->type == "ENUMERATED")  {
					//$data .= $field->internalName;
						// Enumerated fields will be displayed as a select. Get the possible values
						$possibleValues = $field->possibleValues; 
			$data .=    '<select name="'.$field->internalName.'">
							<option value="">Any</option>';
						 foreach ($possibleValues as $value) { 
						  if($value->id == $member_data) {
							$selected = 'selected = "selected"';
						  } else {
							$selected = "";
						  }
			 $data .=        '<option value="'.$value->id .'"'. $selected .'>'.$value->value .' </option>';
						  } 
			 $data .=   '</select>';
					} else { 
			  $data .=   '<input type="text" name="'.$field->internalName.'" />';
					} 
			  $data .= '</td>';
			$data .= '</tr>';
		endif;
		}
		$data .= "</table>";
		else : 
		$data = "";
		endif;
		if($ajax == 1) {
			echo $data;
			exit;
		} else {
			return $data;
		}
		
    }
	
	function getGroupfilterids($active = null,$channelid = null) {
		if($active) {
			$active = explode(',',$active);
		}

		$db	    = JFactory::getDBO();

		$query  = 'SELECT * FROM #__ccmarketplace_ws_grpfiltrs WHERE FIND_IN_SET("'.$channelid.'", webchannelid) AND published = 1' ;
		$db->setQuery( $query );
		$row    = $db->loadAssocList();

		if (!$db->query())
		{
			JError::raiseWarning(20, JText::_('Error'));
		}

		$option[] = JHTML::_('select.option',  '', "--".JText::_( 'Select' )."--");
		foreach ( $row as $channel)
		{
			$option[] = JHTML::_('select.option',$channel['gid'],$channel['gname']);
		}

		$group = JHTML::_('select.genericlist',  $option, 'organisation[]', 'class="inputbox" size="5" Multiple', 'value', 'text', $active);

		return $group;
	}
}
?>
