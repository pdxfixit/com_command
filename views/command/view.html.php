<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CommandViewCommand extends JView {

    public function display($tpl = null) {
        // Initialise variables
//        $this->items = $this->get('Items');
//        $this->total = $this->get('Total');
//        $this->pagination = $this->get('Pagination');
//        $this->state = $this->get('State');

        // Check for errors.
//        if (count($errors = $this->get('Errors'))) {
//            JError::raiseError(500, implode("\n", $errors));
//            return false;
//        }
        // Configure the toolbar.
        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar() {
        // Get permissions
        $canDo = CommandHelper::getActions();
        
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_COMMAND_ADMINISTRATION'));
        JToolBarHelper::title(JText::_('COM_COMMAND_ADMINISTRATION_TITLE'), 'command');

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_command');
        }

    }

}