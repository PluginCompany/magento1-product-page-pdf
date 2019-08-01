<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Config_CustomCss
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    public function __construct()
    {
        Mage::app()->getLayout()->getBlock('head')
            ->addItem('js_css', 'plugincompany/productleaflet/lib/codemirror/codemirror.css');
        Mage::app()->getLayout()->getBlock('head')
            ->addJs('plugincompany/productleaflet/lib/codemirror/codemirror-compressed.js');
        Mage::app()->getLayout()->getBlock('head')
            ->addJs('plugincompany/productleaflet/custom_css_codemirror.js');
        Mage::app()->getLayout()->getBlock('head')
            ->addItem('js_css', 'plugincompany/productleaflet/custom_css_codemirror.css');
        return parent::__construct();
    }

}