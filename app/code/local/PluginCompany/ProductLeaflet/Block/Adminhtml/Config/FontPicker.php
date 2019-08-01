<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Config_FontPicker
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @var Varien_Data_Form_Element_Abstract
     */
    private $element;

    public function __construct()
    {
        Mage::app()->getLayout()
            ->getBlock('head')
            ->addJs('plugincompany/jquerynoconflict.js')
        ;
        Mage::getModel('plugincompany_productleaflet/fontDownloader')
            ->installIfNotAvailable()
        ;
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


    private function getFontSelectHtml()
    {
        return $this->getLayout()
            ->createBlock('plugincompany_productleaflet/adminhtml_config_fontPicker_fontSelect')
            ->setElementHtmlId($this->element->getHtmlId())
            ->toHtml();
    }

    private function generateHtml()
    {
        return
            $this->element->getElementHtml()
            . $this->getFontSelectHtml()
            . $this->getScripts();

        return $this;
    }

}