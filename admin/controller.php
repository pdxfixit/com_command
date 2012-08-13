<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

class CommandController extends JController {

    public function display($cachable = false) {
        // set default view if not set
        JRequest::setVar('view', JRequest::getCmd('view', 'command'));

        // call parent behavior
        parent::display($cachable);
    }

}
