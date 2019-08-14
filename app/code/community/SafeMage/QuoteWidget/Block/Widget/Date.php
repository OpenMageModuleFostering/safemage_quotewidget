<?php
/*
NOTICE OF LICENSE

This source file is subject to the SafeMageEULA that is bundled with this package in the file LICENSE.txt.

It is also available at this URL: https://www.safemage.com/LICENSE_EULA.txt

Copyright (c)  SafeMage (https://www.safemage.com/)
*/

class SafeMage_QuoteWidget_Block_Widget_Date extends Mage_Core_Block_Template
{
    public function prepareElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $element->setFormat('M/d/yyyy');
        $this->_fix($element);
        $element->setImage($this->getSkinUrl('images/grid-cal.gif'));
        return $element;
    }

    protected function _fix(Varien_Data_Form_Element_Abstract $element)
    {
        if ($element->getValue()) {
            $parts = explode('/', $element->getValue());
            $value = $parts[0] . '/' . $parts[1] . '/' . $parts[2];
            $element->setValue($value);
        }
    }
}