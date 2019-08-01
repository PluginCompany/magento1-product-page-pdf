<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

require_once(Mage::getBaseDir('lib') . '/PC_Mpdf6.1/mpdf.php');

class PluginCompany_ProductLeaflet_FileController extends Mage_Core_Controller_Front_Action {

    public function getpdfAction(){
        try {
            Mage::getModel('plugincompany_productleaflet/fontDownloader')
                ->installIfNotAvailable()
            ;

            $productID = $this->getRequest()->getParam('fileId');
            if ($productID){

                //controller passes data to model and loads product information
                $product = Mage::getModel('catalog/product')->load($productID);
                Mage::register('current_product', $product);
                Mage::register('product', $product);

                /** @var PluginCompany_ProductLeaflet_Block_Pdf $pdf */
                $pdf = $this->getLayout()
                    ->createBlock('plugincompany_productleaflet/pdf');
                $pdf->setProduct($product);

                if($this->getRequest()->getParam('html')){
                    return $this->getResponse()->setBody(
                        $pdf->toHtml()
                    );
                }

                $marginBottom = 5;
                if($pdf->canShowFooter()){
                    $marginBottom = 15;
                }
                $mpdf = new Mpdf(
                    'UTF-8', //mode
                    'A4', //format
                    0, //default font size
                    $pdf->getDefaultFont(), //default font
                    0, //margin-left
                    0, //margin-right
                    12, //margin-top
                    $marginBottom, //margin-bottom
                    0,
                    7
                );

                $mpdf->useSubstitutions = true;
                $mpdf->use_kwt = true;

                if($pdf->canShowFooter()){
                    $mpdf->SetHtmlFooter(
                        $pdf->getFooterHtml()
                    );
                }
                if($pdf->printWindowEnabled()) {
                    $mpdf->SetJs('this.print();');
                }
                $mpdf->WriteHTML($pdf->toHtml());
                $mpdf->Close();

                $fileName = urldecode(str_replace(' ','_',$pdf->getProduct()->getName())).'.pdf';
                $this->getResponse()
                    ->setHttpResponseCode(200)
                    ->setHeader('Pragma', 'public', true)
                    ->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true)
                    ->setHeader('Content-type', 'application/pdf', true)
                    ->setHeader('Content-Disposition', 'inline; filename="' . $fileName . '"', true)
                    ->setHeader('Last-Modified', date('r'), true)
                    ->setBody($mpdf->buffer)
                ;
            } else {
                $this->getResponse()->setBody(
                    'Download File Error'
                );

            }
        } catch (Exception $e){
            throw $e;
            Mage::log("FileController.php: " . $e->getMessage(), NULL, 'productleaflet.log', true);
        }
    }

    public function geticonAction(){
        $model = Mage::getModel('plugincompany_productleaflet/download');
        if ($model){
            $model->getIconPDF();
            unset($model);
        }
    }
} 
