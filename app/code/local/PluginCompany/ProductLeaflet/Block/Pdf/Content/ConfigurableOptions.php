<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

use PluginCompany_ProductLeaflet_Model_System_Config_Source_ShowPrice as ShowPrice;

class PluginCompany_ProductLeaflet_Block_Pdf_Content_ConfigurableOptions
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/options/configurable.phtml');
        return $this;
    }

    public function getOptions(){
        try{
            $options = $this->getProduct()
                ->getTypeInstance(true)
                ->getConfigurableAttributesAsArray($this->getProduct());
            if (sizeof($options) > 0) {
                return (array) $options;
            }
        } catch (Exception $e) {
            Mage::log($e->getMessage());
        }
        return false;
    }

    public function canShowPrice()
    {
        if($this->getShowPriceSetting() == ShowPrice::SHOW_PRICE) {
            return true;
        }
        if($this->getShowPriceSetting() == ShowPrice::HIDE_PRICE) {
            return false;
        }
        return parent::canShowPrice();
    }

    private function getShowPriceSetting()
    {
        return (int)$this->getGroupConfig('configurable_product/show_price');
    }

    public function getPricingValueText($value)
    {
        if (!$value['use_default_value']){
            return '';
        }

        if ($value['pricing_value']>0) {
            $text = $value['pricing_value'];
            if ($value['is_percent'] === "1") {
                $text = number_format($text, 2);
                return '+ ' . $text . '%';
            } else {
                return '+ ' . Mage::helper('core')->currency($text, true, false);
            }
        }
        return '';
    }
}

