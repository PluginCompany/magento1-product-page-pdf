<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Config_GalleryPicker_GallerySelect
    extends Mage_Core_Block_Template
{
    protected $_template = 'plugincompany/productleaflet/config/gallery_select.phtml';

    public function getGalleryData()
    {
        return array(
            array(
                'identifier' => 'medium-main-1c-side-2c-bottom',
                'image' => $this->getImageUrl('medium_main_1col_right_two_col_below.png')
            ),
            array(
                'identifier' => 'medium-main-2c-side-3c-bottom',
                'image' => $this->getImageUrl('medium_main_2col_right_3_col_below.png')
            ),
            array(
                'identifier' => 'large-main-image-2-col-grid',
                'image' => $this->getImageUrl('1_col_large_2_col_grid.png')
            ),
            array(
                'identifier' => 'large-main-image-3-col-grid',
                'image' => $this->getImageUrl('1_col_large_3_col_grid.png')
            ),
            array(
                'identifier' => '1-col-grid',
                'image' => $this->getImageUrl('1_col_grid.png')
            ),
            array(
                'identifier' => '2-col-grid',
                'image' => $this->getImageUrl('2_col_grid.png')
            ),
            array(
                'identifier' => '3-col-grid',
                'image' => $this->getImageUrl('3_col_grid.png')
            ),
        );
    }

    private function getImageUrl($file)
    {
        return $this->getMediaBaseUrl() . '/plugincompany/productleaflet/gallery_picker/' . $file;
    }

    private function getMediaBaseUrl()
    {
        return Mage::getBaseUrl('media', $this->getRequest()->isSecure());
    }
}