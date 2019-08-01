<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Model_FontReader extends Mage_Core_Model_Abstract
{
    private $io;
    private $googleFontDir;

    public function __construct()
    {
        $this->io = new Varien_Io_File();

        $this->googleFontDir =
            Mage::getBaseDir()
            . PluginCompany_ProductLeaflet_Model_FontDownloader::FONT_DIR
            . 'ttfonts/googlefonts/'
        ;
        return $this;
    }

    public function getAdditionalFontsForMpdf()
    {
        $fonts = array();
        foreach($this->readFontDir() as $fontDir){
            $this->io->open(array('path' => $fontDir['id']));
            $fontKey = $fontDir['text'];
            $fonts[$fontKey] = array(
                'R' => 'googlefonts' . '/' . $fontKey . '/' . $this->getRegularFont(),
                'B' => 'googlefonts' . '/' . $fontKey . '/' . $this->getBoldFont(),
                'I' => 'googlefonts' . '/' . $fontKey . '/' . $this->getItalicFont(),
                'BI' => 'googlefonts' . '/' . $fontKey . '/' . $this->getBoldItalicFont()
            );
        }
        return $fonts;
    }

    public function doesFontDirExist()
    {
        return $this->io->fileExists($this->googleFontDir, false);
    }

    private function readFontDir()
    {
        $this->io->open(array('path' => $this->googleFontDir));
        return $this->io->ls();
    }

    private function getRegularFont()
    {
        return $this->getFontFile('-Regular.ttf');
    }

    private function getBoldFont()
    {
        return $this->getFontFile('-Bold.ttf');
    }

    private function getItalicFont()
    {
        if($font = $this->getFontFile('-Italic.ttf')){
            return $font;
        }
        return $this->getFontFile('-Regular.ttf');
    }

    private function getBoldItalicFont()
    {
        if($font = $this->getFontFile('-BoldItalic.ttf')){
            return $font;
        }
        return $this->getFontFile('-Bold.ttf');
    }

    private function getFontFile($suffix)
    {
        foreach($this->io->ls() as $file) {
            if(stristr($file['text'], $suffix)){
                return $file['text'];
            }
        }
        return false;
    }

    public function getFontImageData()
    {
        if(Mage::registry('font_image_data')){
            return Mage::registry('font_image_data');
        }
        $images = array();
        foreach($this->readFontDir() as $fontDir) {
            $imageData = $this->generateImageData($fontDir);
            $images[$imageData['identifier']] = $imageData;
        }
        ksort($images);
        Mage::register('font_image_data', $images);
        return $images;
    }

    private function generateImageData($fontDir)
    {
        $this->io->open(array('path' => $fontDir['id']));
        return array(
            'identifier' => $fontDir['text'],
            'file' => $this->getImageFontFile($fontDir),
            'title' => $this->getFontTitle($fontDir),
            'image_base64' => $this->generateImage($fontDir)
        );
    }

    private function getImageFontFile($fontDir)
    {
        return $fontDir['id'] . DS . $this->getRegularFont();
    }

    private function generateImage($fontDir)
    {
        $image = $this->generateBaseImage();
        $this->addText($image, $fontDir);
        return $this->convertBase64Image($image);
    }

    private function addText($image, $fontDir)
    {
        $grey = imagecolorallocate($image, 66, 66, 66);
        imagettftext ( $image , 18, 0, 0 , 33 , $grey, $this->getImageFontFile($fontDir), $this->getFontTitle($fontDir));
        return $this;
    }

    private function convertBase64Image($image)
    {
        ob_start();
        imagepng($image);
        $buffer = ob_get_clean();
        return base64_encode($buffer);
    }

    private function generateBaseImage()
    {
        $image = imagecreatetruecolor(270, 50);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);
        return $image;
    }

    private function getFontTitle($fontDir)
    {
        $metadata = $this->io->read($fontDir['id'] . '/METADATA.pb');
        preg_match('/"(.*?)"/', $metadata, $matches);
        return isset($matches[1]) ? $matches[1] : FALSE;
    }

}
