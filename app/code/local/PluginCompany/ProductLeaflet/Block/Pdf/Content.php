<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Content
    extends PluginCompany_ProductLeaflet_Block_Pdf
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content.phtml');
        return $this;
    }

    public function getSortedContentElementsKeys()
    {
        return array_keys($this->getSortedContentElements());
    }

    public function getSortedContentElements()
    {
        return json_decode($this->getSectionSortConfig(), true);
    }

    private function getSectionSortConfig()
    {
        return Mage::getStoreConfig(
                'plugincompany_productleaflet/sectionsort/sort_order',
                Mage::app()->getStore()->getId()
            );
    }

    public function getContentElementHtml($key)
    {
        switch ($key) {
            case 'title-price':
                return $this->getTitleAndPriceHtml();
                break;
            case 'image-gallery':
                return $this->createChildBlockIfAllowed(
                    'gallery/show_images',
                    'pdf_content_media'
                );
                break;
            case 'short-description':
                return $this->createChildBlockIfAllowed(
                    'short_description/show_short_description',
                    'pdf_content_shortDescription'
                );
                break;
            case 'description':
                return $this->createChildBlockIfAllowed(
                    'description/show_description',
                    'pdf_content_description'
                );
                break;
            case 'product-attributes':
                return $this->createChildBlockIfAllowed(
                    'additional_information/show_additional_information',
                    'pdf_content_attributes'
                );
                break;
            case 'configurable-options':
                return $this->getConfigurableOptionsHtmlIfAllowed();
                break;
            case 'bundle-options':
                return $this->getBundleOptionsHtmlIfAllowed();
                break;
            case 'grouped-options':
                return $this->getGroupedOptionsHtmlIfAllowed();
                break;
            case 'custom-options':
                return $this->createChildBlockIfAllowed(
                    'custom_options/show_custom_options',
                    'pdf_content_customOptions'
                );
                break;
        }
    }

    public function getTitleAndPriceHtml()
    {
        return $this->getBlockHtmlWithProduct(
            'plugincompany_productleaflet/pdf_content_titleAndPrice'
        );
    }

    private function createChildBlockIfAllowed($configFlag, $block)
    {
        if($this->getGroupConfigFlag($configFlag)){
            return $this->getBlockHtmlWithProduct(
                'plugincompany_productleaflet/' . $block
            );
        }
        return '';
    }

    public function getConfigurableOptionsHtmlIfAllowed()
    {
        if($this->canShowConfigurableOptions()){
            return $this->getConfigurableOptionsHtml();
        }
        return '';
    }

    public function canShowConfigurableOptions()
    {
        return $this->isProductConfigurable() && $this->getGroupConfigFlag('configurable_product/show_configurable_product_options');
    }

    public function getConfigurableOptionsHtml()
    {
        return $this->getBlockHtmlWithProduct(
            'plugincompany_productleaflet/pdf_content_configurableOptions'
        );
    }

    public function getBundleOptionsHtmlIfAllowed()
    {
        if($this->canShowBundleOptions()){
            return $this->getBundleOptionsHtml();
        }
        return '';
    }

    public function canShowBundleOptions()
    {
        return $this->isProductBundle() && $this->getGroupConfigFlag('bundle_product/show_bundle_product_options');
    }

    public function getBundleOptionsHtml()
    {
        return $this->getBlockHtmlWithProduct(
            'plugincompany_productleaflet/pdf_content_bundleOptions'
        );
    }

    public function getGroupedOptionsHtmlIfAllowed()
    {
        if($this->canShowGroupedOptions()){
            return $this->getGroupedOptionsHtml();
        }
        return '';
    }

    public function canShowGroupedOptions()
    {
        return $this->isProductGrouped() && $this->getGroupConfigFlag('grouped_product/show_grouped_product_options');
    }

    public function getGroupedOptionsHtml()
    {
        return $this->getBlockHtmlWithProduct(
            'plugincompany_productleaflet/pdf_content_groupedOptions'
        );
    }

    protected function getBlockHtmlWithProduct($blockClass)
    {
        return $this->getLayout()
            ->createBlock($blockClass)
            ->setProduct($this->getProduct())
            ->toHtml();
    }

    public function getSectionTitleFontFamily()
    {
        if($this->getSectionHeaderConfigFlag('use_custom_section_header_font')){
            return $this->getSectionHeaderConfig('section_header_fontfamily');
        }
        return $this->getDefaultFont();
    }

    public function getRowClass($i)
    {
        if($i % 2 == 0){
            return 'odd';
        }
        return 'even';
    }



}