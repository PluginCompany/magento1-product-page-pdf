<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

class PluginCompany_ProductLeaflet_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getPdfUrl(Mage_Catalog_Model_Product $product)
    {
        return $this->getBaseUrl($product)
            . "ProductLeaflet/file/getpdf/name/"
            . $this->getFileName($product)
            . "?fileId=" . $product->getId();
    }

    private function getFileName(Mage_Catalog_Model_Product $product)
    {
        $fileName = str_replace(
            array(' ', '/'),
            array('_', ''),
            trim($product->getName())
        );
        return urlencode($fileName . '.pdf');
    }

    private function getBaseUrl(Mage_Catalog_Model_Product $product)
    {
        return $product->getStore()
            ->getBaseUrl(
                'link',
                Mage::app()->getStore()->isCurrentlySecure()
            );
    }
}
