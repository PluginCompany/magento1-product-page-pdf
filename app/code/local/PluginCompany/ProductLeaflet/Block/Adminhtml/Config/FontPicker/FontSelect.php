<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Config_FontPicker_FontSelect
    extends Mage_Core_Block_Template
{
    protected $_template = 'plugincompany/productleaflet/config/font_select.phtml';

    public function getFontData()
    {
        return Mage::getModel('plugincompany_productleaflet/fontReader')->getFontImageData();
    }
}