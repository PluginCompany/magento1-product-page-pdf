<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */
class PluginCompany_ProductLeaflet_Block_Pdf_Content_Media
    extends PluginCompany_ProductLeaflet_Block_Pdf_Content
{

    /**
     * @var Varien_Data_Collection
     */
    private $mediaGalleryImages;

    private $mediaGalleryRangeCollections = array();

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('plugincompany/productleaflet/pdf/content/media/wrapper.phtml');
        return $this;
    }

    public function getGalleryImagesHtml()
    {
        return $this->setTemplate(
            'plugincompany/productleaflet/pdf/content/media/' . $this->getConfig('gallery_style') . '.phtml'
        )->toHtml();
    }

    public function getMediaGalleryImagesWithMainImage()
    {
        $collection = new Varien_Data_collection();
        if($this->getMainImage()){
            $collection->addItem($this->getMainImage());
        }
        foreach($this->getMediaGalleryImages() as $image){
            $collection->addItem($image);
        }
        return $collection;
    }

    public function getMediaGalleryImages()
    {
        if(!$this->mediaGalleryImages)
        {
            $this->initMediaGalleryImages();
        }
        return $this->mediaGalleryImages;
    }

    private function initMediaGalleryImages()
    {
        if(!$this->getMaxAllowedGalleryImages()) {
            $this->mediaGalleryImages = new Varien_Data_Collection();
            return $this;
        }
        $images =  $this->getProduct()->getMediaGalleryImages();
        $mediaGallery = new Varien_Data_Collection();
        foreach($images as $image){
            if(stristr($image->getFile(), 'swatch_')){
               continue;
            }

            if($this->isMainProductImage($image->getFile())){
                continue;
            }
            $mediaGallery->addItem($image);
        }
        $this->mediaGalleryImages = $mediaGallery;
        if($this->getConfig('add_child_images')){
            $this->addConfigurableChildImages();
        }
        $this->mediaGalleryImages = new LimitIterator($this->mediaGalleryImages->getIterator(),0, $this->getMaxAllowedGalleryImages());
        return $this;
    }

    private function isMainProductImage($imagePath)
    {
        return $imagePath == $this->getProduct()->getImage();
    }

    private function addConfigurableChildImages()
    {
        if(!$this->isProductConfigurable())
            return $this;

        foreach($this->getConfigurableProductChildren() as $child) {
            $this->addProductImagesToCurrentMediaGallery($child);
        }
        return $this;
    }

    private function addProductImagesToCurrentMediaGallery(Mage_Catalog_Model_Product $product)
    {
        $product->load($product->getId());
        $this
            ->addMainImageToCurrentGallery($product)
            ->addGalleryImagesToCurrentGallery($product)
        ;
        return $this;
    }

    private function addMainImageToCurrentGallery($product)
    {
        if($this->getMainImage($product)) {
            $this->addImageToGalleryIfNotDuplicate(
                $this->getMainImage($product)
            );
        }
        return $this;
    }

    private function addGalleryImagesToCurrentGallery($product)
    {
        foreach($product->getMediaGalleryImages() as $image) {
            $this->addImageToGalleryIfNotDuplicate($image);
        }
        return $this;
    }

    private function addImageToGalleryIfNotDuplicate(Varien_Object $image)
    {
        if(stristr($image->getFile(), 'no_selection')){
            return $this;
        }
        if(!$this->getConfig('filter_duplicate_images')){
            return $this->addImageToMediaGallery($image);
        }
        if($this->isImageAlreadyAddedToGallery($image->getFile())){
            return $this;
        }
        if($this->isMainProductImage($image->getFile())){
            return $this;
        }
        return $this->addImageToMediaGallery($image);
    }

    private function isImageAlreadyAddedToGallery($imagePath)
    {
        if(!is_null($this->mediaGalleryImages->getItemByColumnValue('file', $imagePath))){
            return true;
        }
        $path1 = $this->getFullImagePath($imagePath);
        $mainImagePath = $this->getFullImagePath($this->getMainImage()->getFile());
        if($this->areImagesTheSame($path1, $mainImagePath)){
            return true;
        }
        foreach($this->mediaGalleryImages as $image) {
            $path2 = $this->getFullImagePath($image->getFile());
            if($this->areImagesTheSame($path1, $path2)){
                return true;
            }
        }
        return false;
    }

    private function getFullImagePath($imagePath)
    {
        $path = $this->getProductMediaBaseDir() . $imagePath;
        return $path;
    }

    private function getProductMediaBaseDir()
    {
        return Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA)
            . DS . 'catalog'
            . DS . 'product'
            ;
    }

    private function areImagesTheSame($a, $b)
    {
        $result = Mage::helper('plugincompany_productleaflet/imageCompare')
            ->compare($a, $b);
        return $result < 3;
    }

    private function addImageToMediaGallery($image)
    {
        $this->mediaGalleryImages->addItem(
            new Varien_Object(
                array(
                    'file' => $image->getFile(),
                    'url'  => $image->getUrl()
                )
            )
        ) ;
        return $this;
    }

    public function getMainImage($product = false)
    {
        if(!$product){
            $product = $this->getProduct();
        }

        $url = (string)Mage::helper('catalog/image')->init($product, 'image');

        return new Varien_Object(
            array(
                'url' => $url,
                'file' => $product->getImage()
            )
        );
    }

    public function getImageCount()
    {
        $count = $this->getMediaGalleryImages()->count();
        if($count > $this->getMaxAllowedGalleryImages()) {
            return $this->getMaxAllowedGalleryImages();
        }
        return $count;
    }

    public function getMediaGalleryImagesSelection($start, $end)
    {
        if(!isset($this->mediaGalleryRangeCollections[$start . '-' . $end])){
            $this->initMediaGalleryImagesSelection($start, $end);
        }
        return $this->mediaGalleryRangeCollections[$start . '-' .$end];
    }

    private function initMediaGalleryImagesSelection($start, $end)
    {
        $collection = new Varien_Data_Collection();
        $i = 1;
        foreach($this->getMediaGalleryImages() as $image)
        {
            if($i >= $start && $i <= $end)
            {
                $collection->addItem($image);
            }
            $i++;
        }
        $this->mediaGalleryRangeCollections[$start . '-' .$end] = $collection;
        return $this;
    }

    public function getSelectionImageCount($start, $end)
    {
        return $this->getMediaGalleryImagesSelection($start, $end)->count();
    }

    public function shouldAddPageBreakBefore()
    {
        if($this->isTitleFirstAndMediaGallerySecond()){
            return false;
        }
        if($this->isImageGalleryFirstSection()){
            return false;
        }
        return true;
    }

    public function isTitleFirstAndMediaGallerySecond()
    {
        $sections = $this->getSortedContentElementsKeys();
        return $sections[0] == 'title-price' && $sections[1] == 'image-gallery';
    }

    public function isImageGalleryFirstSection()
    {
        $contentElementKeys = $this->getSortedContentElementsKeys();
        return $contentElementKeys[0] == 'image-gallery';
    }

    private function getMaxAllowedGalleryImages()
    {
        return $this->getConfig('gallery_image_count');
    }

    public function getConfig($field)
    {
        return $this->getGalleryConfig($field);
    }

    public function getConfigFlag($field)
    {
        return $this->getGalleryConfigFlag($field);
    }

}