<?php
/**
 * Copyright (c) 2014-2026 Plugin Company
 *
 * This file is part of Product Page PDF, released under the MIT License.
 * See the LICENSE file in the project root.
 */

$this->startSetup();

Mage::getModel('plugincompany_productleaflet/fontDownloader')->execute();

$this->endSetup();
