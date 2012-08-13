<?php

defined('_JEXEC') or die('Access Restricted');

jimport('joomla.application.component.view');

class CommandViewCommand extends JView {

    public function display($tpl = null) {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();
        
        $this->loadHelper('command');
        
        $params = $app->getParams();

        $doc->addStyleSheet($this->baseurl . '/components/com_command/assets/command.css');
        $doc->addStyleDeclaration('#command { display:none; }');   
        $doc->addScriptDeclaration('var command = true;');
        $doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js');

        $this->assignRef('params', $params);
        
        parent::display($tpl);
    }

}
