<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
use PluginCompany_ProductLeaflet_Model_System_Config_Source_ShowPrice as ShowPrice;

class PluginCompany_ProductLeaflet_Block_Pdf_Content_BundleOptions
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/options/bundle.phtml');
        return $this;
    }

    /**
     * Return an array of bundle product options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->getLayout()
            ->createBlock('bundle/catalog_product_view_type_bundle')
            ->setProduct($this->getProduct())
            ->getOptions();
    }

    public function getFullImageUrl($path)
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)
            . 'catalog/product'
            . $path;
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
        return (int)$this->getGroupConfig('bundle_product/show_price');
    }

    public function getFormattedItemPrice($item)
    {
        return Mage::helper('core')->currency(
            $this->getItemPrice($item),
            true,
            false
        );
    }

    private function getItemPrice($item)
    {
        return $item->getPrice();
    }

}

