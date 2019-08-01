<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Config_SectionSort_List
    extends Mage_Core_Block_Template
{
    protected $_template = 'plugincompany/productleaflet/config/sectionsort/list.phtml';

    public function getValue()
    {
        $value = parent::getValue();
        if(!$value){
            return false;
        }
        return json_decode($value, true);
    }

}