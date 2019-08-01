<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Config_SectionSort
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @var Varien_Data_Form_Element_Abstract
     */
    private $element;

    public function __construct()
    {
        Mage::app()->getLayout()->getBlock('head')
            ->addItem('js_css', 'plugincompany/productleaflet/lib/sortable/sortable.css');
        Mage::app()->getLayout()->getBlock('head')
            ->addJs('plugincompany/productleaflet/lib/sortable/sortable.js');
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
            ->createBlock('plugincompany_productleaflet/adminhtml_config_sectionSort_list')
            ->setElementHtmlId($this->element->getHtmlId())
            ->setHtmlId($this->element->getHtmlId() . '-sort')
            ->setValue($this->element->getValue())
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