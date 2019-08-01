<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf extends Mage_Catalog_Block_Product_View
{
    private $product;

    /** @var  Filter */
    private $filter;

    const BASE_TEMPLATE = 'plugincompany/productleaflet/pdf.phtml';

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate(self::BASE_TEMPLATE);
        return $this;
    }

    public function canShowHeader()
    {
        return $this->getHeaderConfig('show_header');
    }

    public function getHeaderHtml()
    {
        return $this->getLayout()
            ->createBlock('plugincompany_productleaflet/pdf_header')
            ->setProduct($this->getProduct())
            ->toHtml();
    }

    public function getContentHtml()
    {
        return $this->getLayout()
            ->createBlock('plugincompany_productleaflet/pdf_content')
            ->setProduct($this->getProduct())
            ->toHtml();
    }

    public function canShowFooter()
    {
        return $this->getFooterConfig('show_footer');
    }

    public function getFooterHtml()
    {
        return $this->getLayout()
            ->createBlock('plugincompany_productleaflet/pdf_footer')
            ->setProduct($this->getProduct())
            ->toHtml();
    }

    public function getConfig($field)
    {
        return $this->getGroupConfig('general/' . $field);
    }

    public function getHeaderConfig($field)
    {
        return $this->getGroupConfig('header/' . $field);
    }

    public function getHeaderConfigFlag($field){
        return $this->getGroupConfigFlag('header/' . $field);
    }

    public function getSectionHeaderConfigFlag($field){
        return $this->getGroupConfigFlag('section_header/' . $field);
    }

    public function getSectionHeaderConfig($field){
        return $this->getGroupConfig('section_header/' . $field);
    }

    public function getGalleryConfigFlag($field){
        return $this->getGroupConfigFlag('gallery/' . $field);
    }

    public function getGalleryConfig($field){
        return $this->getGroupConfig('gallery/' . $field);
    }

    public function getFooterConfigFlag($field){
        return $this->getGroupConfigFlag('footer/' . $field);
    }

    public function getFooterConfig($field){
        return $this->getGroupConfig('footer/' . $field);
    }

    public function getStoreId()
    {
        return Mage::app()->getStore()->getId();
    }

    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Mage_Catalog_Model_Product $product
     * @return $this
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    public function isProductConfigurable()
    {
        return $this->getProduct()->getTypeId() == 'configurable';
    }

    public function getConfigurableProductChildren()
    {
        return $this->getProduct()
            ->getTypeInstance()
            ->getUsedProductCollection()
            ;
    }

    public function isProductBundle()
    {
        return $this->getProduct()->getTypeId() == 'bundle';
    }

    public function isProductGrouped()
    {
        return $this->getProduct()->getTypeId() == 'grouped';
    }

    public function canShowPrice()
    {
        return $this->getGroupConfigFlag('title_price/show_product_price');
    }

    public function getDefaultFont()
    {
        return $this->getGroupConfig('general/default_fontfamily');
    }

    public function getPageNumberFontFamily()
    {
        if($this->getFooterConfigFlag('use_custom_pagenumber_font')){
            return $this->getFooterConfig('pagenumber_font_family');
        }
        return $this->getFooterFontFamily();
    }

    public function getFooterFontFamily()
    {
        if($this->getFooterConfigFlag('use_custom_footer_font')){
            return $this->getFooterConfig('footer_font_family');
        }
        return $this->getDefaultFont();
    }

    public function getGroupConfig($config)
    {
        return Mage::getStoreConfig(
            'plugincompany_productleaflet/' . $config,
            Mage::app()->getStore()->getId()
        );
    }

    public function getGroupConfigFlag($configFlag)
    {
        return Mage::getStoreConfigFlag(
            'plugincompany_productleaflet/' . $configFlag,
            Mage::app()->getStore()->getId()
        );
    }

    protected function _toHtml()
    {
        return $this->getFilter()
            ->filter(parent::_toHtml());
    }

    public function getFilter()
    {
        if(!$this->filter){
            $this->initFilter();
        }
        return $this->filter;
    }

    private function initFilter()
    {
        $this->filter = Mage::getModel('widget/template_filter');
        return $this;
    }

    public function getCustomCss(){
        return $this->getGroupConfig('custom_css/css');
    }

    public function printWindowEnabled()
    {
        return $this->getGroupConfigFlag('frontend/enable_print_window');
    }


}