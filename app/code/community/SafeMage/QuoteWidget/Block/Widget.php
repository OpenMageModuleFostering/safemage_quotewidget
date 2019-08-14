<?php
/*
NOTICE OF LICENSE

This source file is subject to the SafeMageEULA that is bundled with this package in the file LICENSE.txt.

It is also available at this URL: https://www.safemage.com/LICENSE_EULA.txt

Copyright (c)  SafeMage (https://www.safemage.com/)
*/

class SafeMage_QuoteWidget_Block_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
    const AUTHOR_DELIMITER = '|';
    const ITEMS_DELIMITER = "\n";

    const DAY_SEC = 86399;

    protected function _construct()
    {
        $this->setTemplate('safemage/quotewidget/widget.phtml');
        parent::_construct();
    }

    public function getAuthorDelimiter()
    {
        return self::AUTHOR_DELIMITER;
    }

    public function getItemsDelimiter()
    {
        return self::ITEMS_DELIMITER;
    }

    public function getDaySeconds()
    {
        return self::DAY_SEC;
    }

    public function getItems()
    {
        $items = explode($this->getItemsDelimiter(), $this->getList() . $this->getCopyright());
        $objects = array();
        if (count($items)) {
            foreach($items as $item) {
                $parts = explode($this->getAuthorDelimiter(), $item, 2);
                $object = new Varien_Object(
                    array('quote' => $parts[0], 'author' => $parts[1])
                );
                $objects[] = $object;
            }
        }
        return $objects;
    }

    public function getFromTime()
    {
        $from = $this->getData('from_date');
        if (empty($from)) {
            return null;
        }

        $time = strtotime($from);
        return $time;
    }

    public function getToTime()
    {
        $to = $this->getData('to_date');
        if (empty($to)) {
            return null;
        }

        $time = strtotime($to) + $this->getDaySeconds();
        return $time;
    }

    public function getDuration()
    {
        $duration = (int)$this->getData('animation_duration');
        $duration = $duration ? $duration : 6;
        return $duration;
    }

    public function canShow()
    {
        $currentLocaleTime = Mage::getModel('core/date')->timestamp(time());
        $from = $this->getFromTime();
        $to = $this->getToTime();

        $can = true;
        if (!empty($from)) {
            $can = ($from <= $currentLocaleTime);
        }
        if (!empty($to)) {
            $can = $can && ($currentLocaleTime <= $to);
        }

        return $can;
    }

    protected function _getUniqueId()
    {
        return $this->getNameInLayout();
    }

    public function getWrapperClassName()
    {
        $className = 'quotesWrapper' . $this->_getUniqueId();
        return $className;
    }

    public function getJsObjectName()
    {
        $jsObjName = 'safeMageQuoteWidget' . $this->_getUniqueId();
        return $jsObjName;
    }

    public function getCopyright()
    {
        return "\n" . 'Here you will find complex eCommerce solutions! | ' .
            '<a href="https://www.safemage.com/">SafeMage.com</a>';
    }

    public function getQuotesSelector()
    {
        $selector = ".{$this->getWrapperClassName()} .random-quote-widget-item";
        return $selector;
    }
}
