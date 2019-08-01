<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Model_System_Config_Source_Blocktype
    extends PluginCompany_ProductLeaflet_Model_System_Config_Source_AbstractSource
{
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'link' => 'Link',
            'icon' => 'Icon',
       );
    }
}