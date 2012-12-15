<?php
/**
 * @package   CC-Marketplace 
 * @subpackage Modules Cyclos Categorie
 * @link 
 * @license        GNU/GPL, see LICENSE.php
 * 
 * This Module has a problem with multilanguage sites with URL Rewrite
 * 
 */

defined('_JEXEC') or die('Restricted access');

$path = JPATH_COMPONENT.DS.'views'.DS.'ads'.DS.'tmpl'.DS;

JHTML::stylesheet('default.css','modules'.DS.'mod_ccmp_cycloscategories'.DS.'tmpl'.DS );

?>

<ul class="menu" id="navcatcyclos">
  <?php
	$layout = JRequest::getvar('layout') ? JRequest::getvar('layout') : "view1";
	$itemid = $params->get('itemid');
	$id     = $params->get('id');
      foreach ($myCategories as $category) {
  ?>
     <li>
         <a href="index.php?option=com_ccmarketplace&view=ads&layout=<?php echo $layout; ?>&id=<?php echo $id; ?>&caid=<?php echo trim($category->id); ?>&Itemid=<?php echo $itemid; ?>" style="font-weight:normal">
	  <?php echo $category->name;
                if (($category->countOffer != 0) && ($shCountOffer==1)){
                    echo '<span class="countoffer"> (' . $category->countOffer . ')</span>';
                }
          ?>
	 </a>
	  <?php if (!empty($category->children) && ($category->level < $menuDepth)) { ?>
	  <ul <?php if ($menuDepth==3){
	  	        	echo 'style="padding-top: 0px;padding-bottom:0px; padding-left:8px;margin: 0px 5px;"';}
	            else {
	            	echo 'style="list-style-type: none;padding:0px 8px;margin:0px 5px"';
	            } ?>>

  	  <?php foreach ($category->children as $subCategory1) { ?>
	      <li>
               <a href="index.php?option=com_ccmarketplace&view=ads&layout=<?php echo $layout; ?>&id=<?php echo $id; ?>&caid=<?php echo trim($subCategory1->id); ?>&Itemid=<?php echo $itemid; ?>" style="font-weight:normal">
                      <?php
                      echo $subCategory1->name;
                      if (($subCategory1->countOffer != 0) && ($shCountOffer==1)){
                         echo '<span class="countoffer"> (' . $subCategory1->countOffer . ')</span>';
                      }
                      ?>
	           </a>
                   <?php if (!empty($subCategory1->children) && ($subCategory1->level < $menuDepth)) { ?>
	           <ul <?php if ($menuDepth==3){
	  	        			echo 'style="li/st-style-type:none;padding:0px 8px;margin: 0px 5px;"';
                   		 } ?>>
                   <?php foreach ($subCategory1->children as $subCategory2) { ?>
	                  <li>
                              <a href="index.php?option=com_ccmarketplace&view=ads&layout=<?php echo $layout; ?>&id=<?php echo $id; ?>&caid=<?php echo trim($subCategory2->id); ?>&Itemid=<?php echo $itemid; ?>" style="font-weight:normal">
                                 <?php
                                    echo $subCategory2->name;
                                    if (($subCategory2->countOffer != 0) && ($shCountOffer==1)){
				      					echo '<span class="countoffer">  (' . $subCategory2->countOffer . ')</span>';
				    				}
                                 ?>
	                      </a>
	                  </li>
	               <?php } ?>
               </ul>
	           <?php } ?>

	      </li>
	  <?php } ?>
          </ul>
	  <?php } ?>
     </li>
     <?php } ?>
</ul>
