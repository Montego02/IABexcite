<?php

 function getCreditsByOwnerId($id) {
        $db = IabDB::getInstance();
        $q = "SELECT credits FROM j25f_credits WHERE userid = '" . $id . "'";
        $query = $db->query($q);
        $credits = $query->fetch_object()->credits;
        return $credits;
} 


