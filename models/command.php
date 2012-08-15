<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class CommandModelCommand extends JModelAdmin {

    public function getForm($data = array(), $loadData = true) {
        return parent::getForm($data, $loadData);
    }
    
}
