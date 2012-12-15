<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
defined('JPATH_BASE') or die;

/**
 * Supports a modal article picker.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_content
 * @since		1.6
 */
class JFormFieldModal_Webchannels extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Modal_Webchannels';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Setup variables for display.
		$html	= array();

		$db	= JFactory::getDBO();
		$db->setQuery(
			'SELECT id,name' .
			' FROM #__ccmarketplace_ws_channels' .
			' WHERE published = 1'
		);

		$testimonials = $db->loadObjectlist();

		if ($error = $db->getErrorMsg()) {
			JError::raiseWarning(500, $error);
		}

		// The active testimonial id field.
		if (0 == (int)$this->value) {
			$value = '';
		} else {
			$value = (int)$this->value;
		}

		// class='required' for client side validation
		$class = '';
		if ($this->required) {
			$class = ' class="required modal-value"';
		}

		$options = array();
			$options[] = JHTML::_('select.option','', "--".JText::_( 'Web Channels' )."--");
		foreach($testimonials as $testimonial) {
			$options[] = JHTML::_('select.option',  $testimonial->id , $testimonial->name);
		}

		$select = JHTML::_( 'select.genericlist', $options, $this->name, 'id="'.$this->id.'_id"'.$class.'' ,'value','text', $this->value );

		return $select;
	}
}
