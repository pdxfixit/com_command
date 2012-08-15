<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class CommandModelSites extends JModelList {

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'id',
                'title', 'title',
                'url', 'url',
                'published', 'published',
                'lastupdated', 'lastupdated'
            );
        }

        parent::__construct($config);
    }

    protected function getListQuery() {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')->from($db->qn('#__command_sites'));

        // Check for state filter.
        if (is_numeric($this->getState('filter.state'))) {
            $query->where($db->qn('published') . ' = ' . (int) $this->getState('filter.state'));
        }

        // Check the search phrase.
        if ($this->getState('filter.search') != '') {
            $search = $db->escape($this->getState('filter.search'));
            $query->where($db->qn('title') . ' LIKE "%' . $db->escape($search) . '%"' . ' OR ' . $db->qn('url') . ' LIKE "%' . $db->escape($search) . '%"' . ' OR ' . $db->qn('lastupdated') . ' LIKE "%' . $db->escape($search) . '%"');
        }

        // Handle the list ordering.
        $ordering = $this->getState('list.ordering');
        $direction = $this->getState('list.direction');
        if (!empty($ordering)) {
            $query->order($db->escape($ordering) . ' ' . $db->escape($direction));
        }

        return $query;
    }

    public function getTable($type = 'Site', $prefix = 'CommandTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    protected function getStoreId($id = '') {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }

    public function getUpdates() {
        
    }

    protected function populateState($ordering = null, $direction = null) {
        // Load the filter state.
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
        $this->setState('filter.state', $state);

        // Load the parameters.
        $params = JComponentHelper::getParams('com_command');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('title', 'asc');
    }

}
