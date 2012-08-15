<?php

// No direct access to this file
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_command')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by Command
$controller = JController::getInstance('Command');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task', 'display', 'cmd'));

// Redirect if set by the controller
$controller->redirect();
