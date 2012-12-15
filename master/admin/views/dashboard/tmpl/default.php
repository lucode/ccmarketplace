<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CC-Marketplace
* @subpackage	Backend
* @author		
* @copyright	Copyright (C) 2005-2012 cc-hub.org, All rights reserved.
* @link			http://cc-hub.org
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$user= &JFactory::getUser();

$db	=& JFactory::getDBO();
$sql = "SELECT version FROM " . $db->nameQuote( '#__ccmarketplace_meta') . " WHERE id='1'";
$db->setQuery( $sql);
$version = $db->loadResult();

// website root directory
$_root = JURI::root();
?>


<div id="cpanel" style="float:left;width:50%;">

 	<div style="float:left;">
    	<div class="icon">
	    	<a href="index.php?option=com_ccmarketplace&amp;view=webservices">
		    	<img style="padding: 25px 0 9px;" alt="<?php echo JText::_('CCMP_WEBSERVICES'); ?>" src="components/com_ccmarketplace/images/dashboard/webservices.png" />
		    	<span><?php echo JText::_('CCMP_WEBSERVICES'); ?></span>
	    	</a>
    	</div>
  	</div>

	<div style="float:left;">
    	<div class="icon">
	    	<a href="index.php?option=com_ccmarketplace&amp;view=categories">
		    	<img alt="<?php echo JText::_('CCMP_CATEGORIES'); ?>" src="components/com_ccmarketplace/images/dashboard/categories.png" />
		    	<span><?php echo JText::_('CCMP_CATEGORIES'); ?></span>
	    	</a>
    	</div>
  	</div>


	<div style="float:left;">
    	<div class="icon">
	    	<a href="index.php?option=com_ccmarketplace&amp;view=entries">
		    	<img alt="<?php echo JText::_('CCMP_ENTRIES'); ?>" src="components/com_ccmarketplace/images/dashboard/entries.png" />
		    	<span><?php echo JText::_('CCMP_ENTRIES'); ?></span>
	    	</a>
    	</div>
  	</div>


  	<div style="float:left;">
    	<div class="icon">
	    	<a href="index.php?option=com_ccmarketplace&amp;view=users">
		    	<img alt="<?php echo JText::_('CCMP_USERS'); ?>" src="components/com_ccmarketplace/images/dashboard/users.png" />
		    	<span><?php echo JText::_('CCMP_USERS'); ?></span>
	    	</a>
    	</div>
  	</div>


  	<div style="float:left;">
    	<div class="icon">
	    	<a href="index.php?option=com_ccmarketplace&amp;view=labels">
		    	<img alt="<?php echo JText::_('CCMP_LABELS'); ?>" src="components/com_ccmarketplace/images/dashboard/labels.png" />
		    	<span><?php echo JText::_('CCMP_LABELS'); ?></span>
	    	</a>
    	</div>
  	</div>


	<div class="clr"></div>

</div>





<div id="tabs" style="float:right; width:50%;">

 	<?php
	jimport('joomla.html.pane');

	$pane =& JPane::getInstance('Tabs');

	echo $pane->startPane('marketplacePane');

		echo $pane->startPanel(JText::_('CCMP_LATEST_ENTRIES'), 'itemstab');

			echo "<div>";

				$rows = &$this->latestEntries;

				echo "<table width='100%' cellspacing='1' cellpadding='3' >";


    				echo "<thead>";

      					echo "<tr>";

      						echo "<td>";
      							echo JText::_('CCMP_DATE');
      						echo "</td>";

      						echo "<td>";
      							echo JText::_('CCMP_HEADLINE');
      						echo "</td>";

      						echo "<td>";
      							echo JText::_('CCMP_PUBLISHED');
      						echo "</td>";

      					echo "</tr>";

    				echo "</thead>";

    				echo "<tbody>";

					foreach ( $rows as $row) {

						$link = JRoute::_( 'index.php?option=com_ccmarketplace&view=entry&task=edit&cid[]='. $row->id );

						?>

						<tr class="<?php echo "row$k"; ?>">

							<td valign="top">
								<?php
								$_entrydate = str_replace( " ", "&nbsp;", $row->entrydate);
								echo $_entrydate;
								?>
							</td>

							<td valign="top">
								<?php
								echo "<a href='" . $link . "'>";
								echo $row->headline;
								echo "</a>";
								?>
							</td>


							<td valign="top">
                                <?php
                                if ( $row->published) {
                                    echo "<img src='" . $_root . "administrator/templates/bluestork/images/admin/tick.png' width='16px' height='16px' />";
                                }
                                else {
                                    echo "<img src='" . $_root . "administrator/templates/bluestork/images/admin/publish_x.png' width='16px' height='16px' />";
                                }
                                ?>
							</td>
						</tr>  
						<?php
					}

					echo "</tbody>";
				echo "</table>";  
			echo "</div>";    
		echo $pane->endPanel();
                        
		echo $pane->startPanel(JText::_('CCMP_ABOUT'), 'abouttab');
			?>

			<div style="text-align:center">

				<div style="margin: 10px 0px 0px 0px">
					<h1>CC-Marketplace</h1>
				</div>

				<div>
					<h2>
					<?php
					echo JText::_('CCMP_VERSION') . " " . $version;
					?>
					</h2>
				</div>

				<div>
					<br />
					<h3>
					<?php
					echo JText::_('CCMP_BY');
					?>
					</h3>
				</div>

				<div style="margin: 10px 0px 10px 0px">
			    	<a href="http://www.cc-hub.org" title="cc-hub.org" target="_blank"><img alt="cc-hub.org" src="components/com_ccmarketplace/images/system/cc-hub-logo.png" /></a>
				</div>

				<div>       
					<a href="http://www.cc-hub.org" title="cc-hub.org" target="_blank">cc-hub.org</a> coded by: <a href="http://www.jextn.com/" title="Jextn" target="_blank">Jextn</a><br />
					CC-Marketplace runs with Cyclos 3.7 Open Source Online Banking System!<br /><br />
					Based on the Marketplace Component from: 	
					<a href="http://www.codingfish.com" title="Codingfish" target="_blank">Codingfish</a>
					and the Cyclos Joomla Modules by:
					<a href="http://www.cyclos.org" title="Cyclos, Open Source Online Banking System" target="_blank">Cyclos.org</a>
					<br />
          <br />
          Feel free to contribute Bug fixes and additional feature to CC-Marketplace<br>
          You can find CC-Marketplace GIT under:&nbsp; <a
          href="https://github.com/lucode/ccmarketplace" target="_blank">https://github.com/lucode/ccmarketplace</a>
            <br>
					<h3><a href="http://cc-hub.org/de/forum/7-cc-marketplace-komponente-component" target="_blank">Helpdesk/Forum</a> for CC-Marketplace!</h3>
          <br /> </div>
                   
<!--				Lucas Huber   -->
<!--              <div style="margin: 20px 0px 0px 0px;">    -->	
<!--                   Facebook: <a href="http://www.facebook.com/codingfish" title="Codingfish on Facebook" target="_blank">www.facebook.com/codingfish</a>   -->	
<!--                   <br />  <br />  -->	  
<!--                   Twitter: <a href="http://twitter.com/codingfish" title="Codingfish on Twitter" target="_blank">twitter.com/codingfish</a>     -->	
<!--               </div>    -->	                                                                                                                    	

				<div>
					<br />
					<h3>
					<?php
					echo JText::_('CCMP_CREDITS');
					?>
					</h3>
				</div>

        <div>
                    <b>Thanks to: Norbert and Oliver for their support</b><br />
                    <b>The Cyclos and the Jextn team</b><br />
                    <b>and the anonymous sponsor</b><br /><br />
                    <b>Translators:</b>

                    <br />
                    Original Marketplace translation by
                    <br />
                    Italian translation by
                    <a href="http://www.transifex.net/accounts/profile/jeckodevelopment/" title="Italian translation" target="_blank">jeckodevelopment</a>
                    <br />

                    Persian translation by
                    <a href="http://www.transifex.net/accounts/profile/abdulhalim/" title="Persian translation" target="_blank">abdulhalim</a>
                    <br />

                    Portuguese translation by
                    <a href="http://www.transifex.net/accounts/profile/SandroHc/" title="Portuguese translation" target="_blank">SandroHc</a>
                    <br />

                    Russian translation by
                    <a href="http://www.transifex.net/accounts/profile/romanown/" title="Russian translation" target="_blank">romanown</a>
                    <br />
                    <br />
                    <br />
        </div>

				<div>
					<b>Icons:</b>
					<br />
					<a href="http://www.famfamfam.com" title="FamFamFam Silk Icon Set" target="_blank">FamFamFam Silk Icon Set</a>
					<br />
                    <a href="http://glyphish.com" title="Glyphish Pro Icon Set" target="_blank">Glyphish Pro Icon Set</a>
					<br />
					nuvoX Icon Set
					<br />
					<br />
				</div>

			</div>

			<?php
		echo $pane->endPanel();


	echo $pane->endPane();
	?>
</div>

<div class="clr"></div>





