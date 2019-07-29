<?php

/**
 * @version     1.0.0
 * @package     com_pm
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      daniel <kontakt@internet-agentur-bodensee.com> - http://internet-agentur-bodensee.com
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Pm helper.
 */
class PmHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
        JSubMenuHelper::addEntry(
                'Aktuelle Anfragen', 'index.php?option=com_anfragen&view=anfragen', $vName == 'anfragen'
        );

        JSubMenuHelper::addEntry(
                'ALLE', 'index.php?option=com_anfragen&view=anfragen&mode=all', $vName == 'anfragen'
        );

        JSubMenuHelper::addEntry(
                'EIGENE', 'index.php?option=com_anfragen&view=anfragen&mode=eigene', $vName == 'anfragen'
        );


        JSubMenuHelper::addEntry(
                'Projektmanagement', 'index.php?option=com_pm&view=projects', $vName == 'projects'
        );
    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_pm';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            //$result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }

    public static function ddStatus() {
        $strg = '  <select id="selectStatus" name="status">
                        <option value="0" >Angebotsphase</option>
                        <option value="1" >Durchführung</option>
                        <option value="2" >fertig</option>
                        <option value="3" >abgelehnt</option>
                        <option value="4" >gelöscht</option>                        
                        
                    </select>';

        echo $strg;
    }

    public static function ddStatusSelect($stat) {
        $strg = '<script type="text/javascript">
                                                $("#selectStatus option").each(function() {
                            if ($(this).val() == ' . $stat . ') {
                                $(this).attr("selected", "selected");
                            }
                        });
                    </script>';
        echo $strg;
    }

    public static function showStatus($stat) {
        switch ($stat) {
            case 0: echo "Angebotsphase";
                break;
            case 1: echo "Durchführung</option>";
                break;
            case 2: echo "fertig";
                break;
            case 3: echo "abgelehnt";
                break;
            case 4: echo "gelöscht";
                break;
        }
    }

    public static function getProjectIdsWithoutAngebot() {

        $db = JFactory::getDbo();
        $query = 'SELECT anfrage FROM #__pm'
                . '  WHERE preisIntern < 100 AND preisExtern < 100 ORDER BY anfrage DESC ';
        $db->setQuery($query);
        $result = $db->loadColumn();

        return $result;
    }

}
