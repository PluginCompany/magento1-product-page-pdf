<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Config_GalleryPicker
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @var Varien_Data_Form_Element_Abstract
     */
    private $element;

    public function __construct()
    {
        Mage::app()->getLayout()->getBlock('head')
            ->addJs('plugincompany/jquerynoconflict.js');
        return parent::__construct();
    }

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->element = $element;
        $element->setType('hidden');
        return $this->generateHtml();
    }


    private function getGallerySelectHtml()
    {
        return $this->getLayout()
            ->createBlock('plugincompany_productleaflet/adminhtml_config_galleryPicker_gallerySelect')
            ->setElementHtmlId($this->element->getHtmlId())
            ->toHtml();
    }

    private function generateHtml()
    {
        return
            $this->element->getElementHtml()
            . $this->getGallerySelectHtml()
            . $this->getScripts();

        return $this;
    }

}