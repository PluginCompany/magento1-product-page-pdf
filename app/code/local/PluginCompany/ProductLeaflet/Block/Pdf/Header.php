<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Header
    extends PluginCompany_ProductLeaflet_Block_Pdf
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/header.phtml');
        return $this;
    }

    public function getStoreLogo(){
        if ($this->getConfigFlag('default_img')) {
            return $this->getDefaultStoreLogoUrl();
        }
        if($this->hasCustomLogo()) {
            return $this->getCustomLogoUrl();
        }
        return false;
    }

    public function getDefaultStoreLogoUrl()
    {
        return $this->getSkinUrl(
            Mage::getStoreConfig('design/header/logo_src', $this->getStoreId())
        );
    }

    public function hasCustomLogo()
    {
        return $this->getConfig('logo') !== '';
    }

    public function getCustomLogoUrl()
    {
        return Mage::getBaseUrl('media') . '/plugincompany/productleaflet/' . $this->getConfig('logo_img');
    }

    public function canShowStoreName()
    {
        return $this->getConfigFlag('show_store_title');
    }

    public function getStoreTitleFontFamily()
    {
        if($this->getConfigFlag('use_custom_title_font')){
            return $this->getConfig('store_name_fontfamily');
        }
        return $this->getHeaderFontFamily();
    }

    public function getHeaderFontFamily()
    {
        if($this->getConfigFlag('use_custom_font')){
            return $this->getConfig('fontfamily');
        }
        return $this->getDefaultFont();
    }

    public function getStoreName() {
        if($this->getConfig('store_title')){
            return $this->getConfig('store_title');
        }
        return Mage::getStoreConfig('general/store_information/name');
    }

    public function getConfig($field)
    {
        return parent::getHeaderConfig($field);
    }

    public function getConfigFlag($field){
        return parent::getHeaderConfigFlag($field);
    }

}
