<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Content_Attributes
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    private $additionalData = false;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/attributes.phtml');
        return $this;
    }

    /**
     * $excludeAttr is optional array of attribute codes to
     * exclude them from additional data array
     *
     * @param array $excludeAttr
     * @return array
     * @throws Mage_Core_Model_Store_Exception
     */
    public function getAdditionalData(array $excludeAttr = array())
    {
        if($this->additionalData !== false){
            return $this->additionalData;
        }
        $data = array();
        $product = $this->getProduct();
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            if(!$attribute->getIsVisibleOnFront()){
                continue;
            }
            if(in_array($attribute->getAttributeCode(), $excludeAttr)){
                continue;
            }
            $realValue = $product->getData($attribute->getAttributeCode());
            if(is_string($realValue)) {
                $realValue = trim($realValue);
            }
            if(!$this->canShowEmptyAttributes() && !$realValue){
                continue;
            }
            $value = $attribute->getFrontend()->getValue($product);
            if (!$product->hasData($attribute->getAttributeCode())) {
                $value = Mage::helper('catalog')->__('N/A');
            } elseif ((string)$value == '') {
                $value = Mage::helper('catalog')->__('No');
            } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                $value = Mage::app()->getStore()->convertPrice($value, true);
            }

            if (is_string($value) && strlen($value)) {
                $data[$attribute->getAttributeCode()] = array(
                    'label' => $attribute->getStoreLabel(),
                    'value' => $value,
                    'code'  => $attribute->getAttributeCode()
                );
            }
        }
        $this->additionalData = $data;
        return $this->additionalData;
    }

    protected function _beforeToHtml()
    {
        if(!$this->canRender()){
            $this->setTemplate('');
        }
        return parent::_beforeToHtml();
    }

    private function canRender()
    {
        return (bool)count($this->getAdditionalData());
    }

    public function canShowEmptyAttributes()
    {
        return !$this->getGroupConfigFlag('additional_information/hide_empty_attributes');
    }
}

