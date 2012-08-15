<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CommandViewSite extends JView {

    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar() {
        $document = JFactory::getDocument();
        JRequest::setVar('hidemainmenu', true);

        JToolBarHelper::apply('site.apply');
        JToolBarHelper::save('site.save');
        JToolBarHelper::save2new('site.save2new');
        if (empty($this->item->id)) {
            JToolBarHelper::cancel('site.cancel');
            JToolBarHelper::title(JText::_('COM_COMMAND_NEW_SITE'), 'weblinks.png');
            $document->setTitle(JText::_('COM_COMMAND_NEW_SITE'));
        } else {
            JToolBarHelper::save2copy('site.save2copy');
            JToolBarHelper::cancel('site.cancel', 'JTOOLBAR_CLOSE');
            JToolBarHelper::title(JText::_('COM_COMMAND_EDIT_SITE'), 'weblinks.png');
            $document->setTitle(JText::_('COM_COMMAND_EDIT_SITE'));
        }

//        JToolBarHelper::divider();
//        JToolBarHelper::help('JHELP_COMPONENTS_COMMAND_SITES_EDIT');
    }

}