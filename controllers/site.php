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

    public function update() {
        // Set the model
        $model = $this->getModel('Site', '', array());

        // Get the update IDs
        $input = JFactory::getApplication()->input;
        $updates = $input->get('cid', null, 'array');

        foreach ($updates as $i => $update) {
            $success = $model->updateSite((int) $update);
            if (!$success) {
                $this->setRedirect('index.php?option=com_command&view=sites', 'Site #' . $i . ' failed to update.', 'error');
                return;
            } else {
                continue;
            }
        }

        $this->setRedirect('index.php?option=com_command&view=sites', count($updates) . ' sites updated.');
    }

}
