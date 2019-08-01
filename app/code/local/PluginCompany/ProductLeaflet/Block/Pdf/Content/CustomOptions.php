<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

use PluginCompany_ProductLeaflet_Model_System_Config_Source_ShowPrice as ShowPrice;

class PluginCompany_ProductLeaflet_Block_Pdf_Content_CustomOptions
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/options/custom.phtml');
        return $this;
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
        return (int)$this->getGroupConfig('custom_options/show_price');
    }

}

