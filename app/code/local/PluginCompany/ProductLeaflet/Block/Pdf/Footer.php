<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Footer
    extends PluginCompany_ProductLeaflet_Block_Pdf
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/footer.phtml');
        return $this;
    }

    public function canShowProductUrl()
    {
        return $this->getConfigFlag('show_url');
    }

    public function getProductUrl($product = null, $additional = array())
    {
        return $this->getProduct()
            ->getProductUrl(false);
    }

    public function canShowTimeStamp()
    {
        return $this->getConfigFlag('show_timestamp');
    }

    public function getTimeStamp()
    {
        return Mage::helper('core')->formatDate(null, 'long', false);
    }

    public function getConfig($field)
    {
        return parent::getFooterConfig($field);
    }

    public function getConfigFlag($field){
        return parent::getFooterConfigFlag($field);
    }


}