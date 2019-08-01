<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

class PluginCompany_ProductLeaflet_Model_System_Config_Source_Blockposition
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
            'alert.urls' => 'Alert URLS',
            'product.info.availability' => 'Availability',
            'product.info.sharing' => 'Sharing',
            'product.info.addto' => 'Add to Wishlist / Compare',
            'product.info.media' => 'Media',
            'product.info.media.after' => 'Media After',
            'product.info.addtocart' => 'Add to Cart',
            'product.info.additional' => 'Additional',
            'product.attributes' => 'Product Attributes',
            'product.info.options' => 'Product Options',
            'dontshowlink' => 'Don\'t show PDF link'
       );
    }
}