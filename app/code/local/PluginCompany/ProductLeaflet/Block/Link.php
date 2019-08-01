<?php
/**
 * Created by PhpStorm.
 * User: milan
 * Date: 26-11-15
 * Time: 13:52
 */
class PluginCompany_ProductLeaflet_Block_Link extends Mage_Core_Block_Template {

    public function __construct(){
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/link.phtml');
    }

    public function getPdfUrl()
    {
        $product = Mage::registry('product');
        return Mage::helper('plugincompany_productleaflet')->getPdfUrl($product);
    }

    public function isEnabled()
    {
        return Mage::getStoreConfigFlag("plugincompany_productleaflet/frontend/enable_extension");
    }

    public function getLinkCss()
    {
        return Mage::getStoreConfig('plugincompany_productleaflet/frontend/link_css');
    }

    public function getIconCss(){
        return Mage::getStoreConfig('plugincompany_productleaflet/frontend/icon_css');
    }

    public function displayType(){
        return Mage::getStoreConfig('plugincompany_productleaflet/frontend/show_as');
    }

    public function getLinkText(){
        $text = Mage::getStoreConfig('plugincompany_productleaflet/frontend/link_text');
        if(!$text){
            $text = "Download PDF";
        }
        return $text;
    }

    public function displayLink(){
        return $this->displayType() == 'link';
    }

    public function displayIcon(){
        return $this->displayType() == 'icon';
    }

    public function getIconUrl(){
        $file = Mage::getStoreConfig('plugincompany_productleaflet/frontend/icon_img');
        $img = Mage::getBaseDir('media'). DS . 'plugincompany' . DS . 'productleaflet' . DS . $file;
        $url = Mage::getBaseUrl('media',Mage::app()->getStore()->isCurrentlySecure()) . DS . 'plugincompany' . DS . 'productleaflet' . DS;
        if(file_exists($img) && $file){
            return $url . $file;
        }
        return $url . 'pdficon.png';
    }

    public function getLinkClasses(){
        return Mage::getStoreConfig('plugincompany_productleaflet/frontend/link_classes');
    }
}
