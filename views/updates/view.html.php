<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CommandViewUpdates extends JView {

    public function display($tpl = null) {
        // Initialize variables
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }
        
        JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

        // Configure the toolbar.
        $this->addToolbar();

        // Set the title
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_COMMAND_UPDATES'));
        
        parent::display($tpl);
    }

    protected function addToolbar() {
        // Get permissions
        $canDo = CommandHelper::getActions();

        JToolBarHelper::title(JText::_('COM_COMMAND_ADMINISTRATION_TITLE'), 'command');

        if ($canDo->get('core.delete')) {
            JToolBarHelper::deleteList('', 'sites.delete');
            JToolBarHelper::divider();
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_command');
        }
    }

}