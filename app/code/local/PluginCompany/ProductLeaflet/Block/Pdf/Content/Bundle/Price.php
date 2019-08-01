<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Content_Bundle_Price
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/bundle_price.phtml');
        return $this;
    }

    public function getMinPrice()
    {
        return $this->getBundleProductMinMaxPrice('min');
    }
    public function getMaxPrice()
    {
        return $this->getBundleProductMinMaxPrice('max');
    }

    public function getBundleProductMinMaxPrice($opts='min')
    {
        $price = null;
        $price = $this->getBundlePriceModel()
            ->getTotalPrices($this->getProduct(), $opts);
        return Mage::helper('core')->currency(
            $price,
            true,
            false
        );
    }

    private function getBundlePriceModel()
    {
        return Mage::getModel('bundle/product_price');
    }

}

