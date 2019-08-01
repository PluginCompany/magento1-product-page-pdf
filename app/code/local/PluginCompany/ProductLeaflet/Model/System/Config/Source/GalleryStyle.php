<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

class PluginCompany_ProductLeaflet_Model_System_Config_Source_GalleryStyle
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
            'medium-main-1c-side-2c-bottom' => 'Medium main image, 1 column side, 2 colum below',
            'medium-main-2c-side-3c-bottom' => 'Medium main image, 2 column side, 3 colum below',
            '1-col-grid' => 'Single column large images',
            '2-col-grid' => 'Two column grid',
            '3-col-grid' => 'Three column grid',
            'large-main-image-2-col-grid' => 'Large main image, 2 column grid below',
            'large-main-image-3-col-grid' => 'Large main image, 3 column grid below'
       );
    }
}