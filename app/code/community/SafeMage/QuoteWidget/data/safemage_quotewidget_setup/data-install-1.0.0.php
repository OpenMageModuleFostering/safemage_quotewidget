<?php
/*
NOTICE OF LICENSE

This source file is subject to the SafeMageEULA that is bundled with this package in the file LICENSE.txt.

It is also available at this URL: https://www.safemage.com/LICENSE_EULA.txt

Copyright (c)  SafeMage (https://www.safemage.com/)
*/

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

try {
    $widgetParams = array(
        'title' => 'Random Quote',
        'list' => 'Try not to become a man of success, but rather try to become a man of value. | Albert Einstein
Look deep into nature, and then you will understand everything better. | Albert Einstein
Whoever is careless with the truth in small matters cannot be trusted with important matters. | Albert Einstein
A person who never made a mistake never tried anything new. | Albert Einstein',
        'from_date' => '',
        'to_date' => '',
        'animation_duration' => '6',
        'cache_lifetime' => '',
    );

    $package = Mage::getSingleton('core/design_package')->getPackageName();
    $theme = Mage::getSingleton('core/design_package')->getTheme('frontend');
    $storeIds = array();
    foreach(Mage::app()->getStores() as $storeId => $data) {
        $storeIds[]= $storeId;
    }

    $widgetInstance = Mage::getModel('widget/widget_instance')
        ->addData(array(
            'instance_type' => 'safemage_quotewidget/widget',
            'package_theme' => "{$package}/{$theme}",
            'title' => 'Random Quote',
            'widget_parameters' => serialize($widgetParams),
            'page_groups' => array(
                array(
                    'group' => 'pages',
                    'page_group' => 'pages',
                    'layout_handle' => 'cms_index_index',
                    'block_reference' => 'bottom.container',
                    'entities' => '',
                    'template' => '',
                    'pages' => array(
                        'page_id' => '',
                        'layout_handle' => 'cms_index_index',
                        'template' => '',
                        'block' => 'top.menu',
                        'for' => 'all',
                    )
                )
            ),
            'store_ids' => $storeIds
        ))
        ->save();

} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();
