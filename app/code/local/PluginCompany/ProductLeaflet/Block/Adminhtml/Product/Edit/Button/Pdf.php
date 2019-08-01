<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Adminhtml_Product_Edit_Button_Pdf extends Mage_Adminhtml_Block_Abstract
{
    protected $_template = 'plugincompany/productleaflet/product/edit/download_pdf_button.phtml';

    protected function _prepareLayout()
    {
        $this->setChild('download_pdf_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('catalog')->__('Download PDF'),
                    'onclick' => sprintf("window.open('%s');", $this->getProductPdfUrl()),
                    'class' => 'download-pdf-button'
                ))
        );
        return parent::_prepareLayout();
    }

    private function getProductPdfUrl()
    {
        $product = Mage::registry('current_product');
        return Mage::helper('plugincompany_productleaflet')->getPdfUrl($product);
    }


}