<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class CommandControllerSite extends JControllerForm {

    function __construct() {
        // Check for the token.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        parent::__construct();
    }

    public function batch($model = null) {
        // Set the model
        $model = $this->getModel('Site', '', array());

        // Preset the redirect
        $this->setRedirect(JRoute::_('index.php?option=com_command&view=sites' . $this->getRedirectToListAppend(), false));

        return parent::batch($model);
    }
    
    public function refresh() {
        // Set the model
        $model = $this->getModel('Site', '', array());

        // Get the update IDs
        $input = JFactory::getApplication()->input;
        $updates = $input->get('cid', null, 'array');
        
        foreach ($updates as $update) {
            $success = $model->refreshSite((int) $update);
            if (!$success) {
                $this->setRedirect('index.php?option=com_command&view=sites', JText::sprintf('COM_COMMAND_ERR_SITE_X_REFRESH_FAIL', $update), 'error');
                return;
            } else {
                continue;
            }
        }

        $this->setRedirect('index.php?option=com_command&view=sites', JText::sprintf('COM_COMMAND_X_SITES_REFRESH_SUCCESS', count($updates)));
    }

    public function update() {
        // Set the model
        $model = $this->getModel('Site', '', array());

        // Get the update IDs
        $input = JFactory::getApplication()->input;
        $sites = $input->get('cid', null, 'array');

        foreach ($sites as $siteId) {
            $success = $model->updateSite((int) $siteId);
            if (!$success) {
                $this->setRedirect('index.php?option=com_command&view=sites', JText::sprintf('COM_COMMAND_ERR_SITE_X_UPDATE_FAIL', $siteId), 'error');
                return;
            } else {
                continue;
            }
        }

        $this->setRedirect('index.php?option=com_command&view=sites', JText::sprintf('COM_COMMAND_X_SITES_UPDATE_SUCCESS', count($sites)));
    }

}
