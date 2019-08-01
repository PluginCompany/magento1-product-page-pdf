<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Model_FontDownloader
{
    const FONT_PACKAGE_URL = 'https://codeload.github.com/PluginCompany/product-pdf-fonts-mirror/tar.gz/1.0.1';
    const FONT_DIR = '/lib/PC_Mpdf6.1/';

    private $io;

    public function __construct()
    {
        $this->io = new Varien_Io_File();
        return $this;
    }

    public function installIfNotAvailable()
    {
        if(is_dir($this->getFontDir() . 'ttfonts')){
            return $this;
        }
        return $this->execute();
    }

    public function execute()
    {
        $this
            ->removeOldFiles()
            ->downloadPackage()
            ->extractPackage()
            ->renameFolder()
            ->removePackage()
        ;
        return $this;
    }

    private function removeOldFiles()
    {
        if(is_dir($this->getFontDir() . 'ttfonts')){
            $this->io->rmdir(
                $this->getFontDir() . 'ttfonts',
                true
            );
        }
        if(is_dir($this->getFontDir() . 'product-pdf-fonts-mirror-1.0.1')){
            $this->io->rmdir(
                $this->getFontDir() . 'product-pdf-fonts-mirror-1.0.1',
                true
            );
        }
        if(is_file($this->getFontPackagePath())) {
            $this->io->rm($this->getFontPackagePath());
        }
        return $this;
    }

    private function downloadPackage()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::FONT_PACKAGE_URL);
        $fp = fopen($this->getFontPackagePath(), 'w');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_exec ($ch);
        curl_close ($ch);
        fclose($fp);
        return $this;
    }

    private function getFontPackagePath($tarOnly = false)
    {
        if($tarOnly){
            return $this->getFontDir() . 'fonts.tar';
        }
        return $this->getFontDir() . 'fonts.tar.gz';
    }

    private function getFontDir()
    {
        return Mage::getBaseDir() . self::FONT_DIR;
    }

    private function extractPackage()
    {
        if(class_exists('PharData') && version_compare(PHP_VERSION, '5.4') >= 0){
            try{
                $p = new PharData($this->getFontPackagePath());
                $p->extractTo($this->getFontDir());
                return $this;
            }catch(\Exception $e) { }
        }
        exec("cd {$this->getFontDir()}; tar -zxf {$this->getFontPackagePath()}");
        return $this;
    }

    private function renameFolder()
    {
        @rename(
            $this->getFontDir() . 'product-pdf-fonts-mirror-1.0.1',
            $this->getFontDir() . 'ttfonts'
        );
        return $this;
    }

    private function removePackage()
    {
        $this->io->rm(
            $this->getFontPackagePath()
        );
        return $this;
    }
}
