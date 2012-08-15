<?php

// No direct access to this file
defined('_JEXEC') or die;

// import Joomla controller library
jimport('joomla.application.component.controller');

class CommandController extends JController {

    public function display($cachable = false, $urlparams = false) {
        require JPATH_COMPONENT . '/helpers/command.php';

        $input = JFactory::getApplication()->input;

        $helper = new CommandHelper();
        $helper->addSubmenu($input->get('view', 'command', 'word'));
        
        // set default view if not set
//        $view = $input->get('view', 'command', 'word');

        // call parent behavior
        parent::display($cachable, $urlparams);
    }

}
