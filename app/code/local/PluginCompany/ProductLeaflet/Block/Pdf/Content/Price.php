<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Content_Price
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/price.phtml');
        return $this;
    }

    public function getPriceHtml($product = null, $displayMinimalPrice = false, $idSuffix = '')
    {
        if($this->isProductBundle()){
            return $this->getBundlePriceHtml();
        }
        if($this->isProductGrouped()){
            return $this->getGroupedPriceHtml();
        }
        return parent::getPriceHtml($this->getProduct(), true);
    }

    public function getBundlePriceHtml()
    {
        return $this->getBlockHtmlWithProduct(
            'plugincompany_productleaflet/pdf_content_bundle_price'
        );
    }

    public function getGroupedPriceHtml()
    {
        return $this->getBlockHtmlWithProduct(
            'plugincompany_productleaflet/pdf_content_grouped_price'
        );
    }

    public function getBundleProductMinMaxPrice($opts='min') {  // 'min' or 'max'
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

