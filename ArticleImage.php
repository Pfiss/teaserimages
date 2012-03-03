<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
    
/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * 
 * 
 * Formerly known as TYPOlight Open Source CMS.
 *
 * 
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Tim Gatzky 2011
 * @author     Tim Gatzky <info@tim-gatzky.de>
 * @package    Contao
 * @license    LGPL 
 * @filesource
 * 
 * Thanks to:
 * + @copyright Wangaz GbR 2010
 * + @author Torben Stoffer <stoffer@wangaz.com>
 * + @package xArticleImage
 */

class ArticleImage extends Frontend
{
	/**
	 * Add image to template.
	 *
	 * @param $objTemplate template to add the image to
	 * @param isCE if constructor is called from an content element template
	 */
 	public function __construct($objTemplate, $isCE = false) {
 		// save article href
 		$objTemplate->articleHref = $objTemplate->href;
 	
 		// connect to database and get image settings
 		$this->import('Database');
 		
 		$objImage = $this->Database->prepare("SELECT addImage, singleSRC, alt, size, imagemargin, fullsize, caption, floating FROM tl_article WHERE id=?")
 						->limit(1)
 						->execute($isCE ? $objTemplate->article : $objTemplate->id);
 		
 		$arrImage = $objImage->fetchAssoc();
 		// add image to template if necessary
 		if($arrImage['addImage'])
 		{
 			$this->addImageToTemplate($objTemplate, $arrImage);
 		}
 	}
}


?>