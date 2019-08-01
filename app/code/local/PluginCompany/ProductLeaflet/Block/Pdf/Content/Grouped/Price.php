<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Content_Grouped_Price
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/grouped_price.phtml');
        return $this;
    }

    public function getFormattedStartingPrice()
    {
        return $this->formatPrice(
            $this->getStartingPrice()
        );
    }

    public function formatPrice($price)
    {
        return Mage::helper('core')->currency($price, true, false);
    }

    public function getStartingPrice()
    {
        return $this->getPrices()['min_price'];
    }

    private function getPrices()
    {
        $priceResource = Mage::getResourceSingleton('catalogindex/price');
        $select = $priceResource->getReadConnection()->select();
        $select->from(
            array('price_table' => $priceResource->getMainTable())
        )
            ->where('price_table.entity_id = ?', $this->getProduct()->getId())
            ->where('price_table.website_id = ?', Mage::app()->getStore()->getWebsiteId())
            ->where('price_table.customer_group_id = ?', Mage::getSingleton('customer/session')->getCustomerGroupId());
        return $priceResource->getReadConnection()->fetchRow($select);
    }

}

