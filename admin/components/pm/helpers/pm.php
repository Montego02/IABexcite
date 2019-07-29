<?php


class PmHelper {


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
