<?php

defined('_JEXEC') or die('Access Restricted');

jimport('joomla.application.component.view');

class CommandViewUpdates extends JView {

    public function display($tpl = null) {
        JToolBarHelper::title(JText::_('COM_COMMAND_ADMINISTRATION_TITLE'), 'command');
        JToolBarHelper::preferences('com_command', '500');
        
        parent::display($tpl);
        
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_COMMAND_UPDATES'));
    }

}