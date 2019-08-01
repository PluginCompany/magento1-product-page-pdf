<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Model_System_Config_Source_ShowPrice
    extends PluginCompany_ProductLeaflet_Model_System_Config_Source_AbstractSource
{
    const USE_DEFAULT = 0;
    const SHOW_PRICE = 1;
    const HIDE_PRICE = 2;
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            0 => 'Use general title & price section settings',
            1 => 'Yes',
            2 => 'No',
       );
    }
}