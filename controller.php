<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class CommandController extends JController {

    public function display($cachable = false) {
        JRequest::setVar('view', JRequest::getCmd('view', 'command'));
        parent::display($cachable);
    }
    
}
