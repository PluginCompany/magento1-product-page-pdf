<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

class PluginCompany_ProductLeaflet_Model_Observer extends Mage_Core_Model_Abstract {

    /**
     * @func coreBlockAbstractToHtmlBefore
     * @descr event handle to catch Mage_Catalog_Block_Product_View_Media 
     *          block rendering event
     * @param Varien_Event_Observer $observer
     **/
    public function coreBlockAbstractToHtmlAfter(Varien_Event_Observer $observer){
        $block = $observer->getEvent()->getBlock();
        $name = Mage::getStoreConfig('plugincompany_productleaflet/frontend/insert_after');
        if ($block){
            if($block->getNameInLayout() == $name){
                $html = $observer->getTransport()->getHtml();
                $pdfBlock = $this->getLinkBlock()->toHtml();
                $html .= $pdfBlock;
                $observer->getTransport()->setHtml($html);
            }
        }
    }

    public function getLinkBlock(){
        return Mage::app()->getLayout()->createBlock('plugincompany_productleaflet/link')
            ;
    }
}
