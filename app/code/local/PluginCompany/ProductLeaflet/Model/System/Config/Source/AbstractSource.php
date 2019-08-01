<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
abstract class PluginCompany_ProductLeaflet_Model_System_Config_Source_AbstractSource
{
    public function toOptionArray()
    {
        $options = array();
        foreach($this->toArray() as $k => $v){
            $options[] = array(
                'label' => $v,
                'value' => $k
            );
        }
        return $options;
    }

    abstract function toArray();

}