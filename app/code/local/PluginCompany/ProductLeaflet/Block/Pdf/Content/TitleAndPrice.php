<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Content_TitleAndPrice
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/title_and_price.phtml');
        return $this;
    }

    public function getProductPriceHtml()
    {
        return $this->getBlockHtmlWithProduct(
            'plugincompany_productleaflet/pdf_content_price'
        );
    }

    public function getProductTitleFontFamily()
    {
        if($this->getConfigFlag('use_custom_product_title_font')){
            return $this->getConfig('product_title_fontfamily');
        }
        return $this->getDefaultFont();
    }

    public function getPriceFontFamily()
    {
        if($this->getConfigFlag('use_custom_price_font')){
            return $this->getConfig('price_font_family');
        }
        return $this->getDefaultFont();
    }

    public function getConfigFlag($field)
    {
        return $this->getGroupConfigFlag('title_price/' . $field);
    }

    public function getConfig($field)
    {
        return $this->getGroupConfig('title_price/' . $field);
    }

}

