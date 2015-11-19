<?php
namespace App\Http\Controllers;

class SearchControllerFcns {
    public function advQuery($query) {
        if($query[0] == '"' && substr($query, -1) == '"') {
            $query = substr($query, 1, -1);
        }
        else {
            $query = '%' . $query . '%';
        }
        return $query;
    }
}
 ?>
