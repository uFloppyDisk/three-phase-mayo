<?php

require_once("inc/exceptions.inc.php");

class ISOCodeMapper {

    private static $db;

    static function initialize() {
        self::$db = new PDOManager('ISOCode');
    }

    static private function _getISOByField(string $field, $value, string $return_string="*") {
        $sql = "SELECT
                    $return_string
                FROM
                    iso_countrycodes
                WHERE
                    $field = :value;";

        self::$db->query($sql);

        self::$db->bind(":value", $value);

        self::$db->execute();

        return self::$db->getResults();       
    }

    // Get a single ISO-3166 entry by ID
    static function getISOByID(int $ID) {
        return self::_getISOByField("id", $ID);
    }

    // Get a single ISO-3166 entry by Alpha-2 or Alpha-3
    static function getISOByAlpha(string $value, int $type=3) {
        $field = "";

        switch ($type) {
            case 2:
                $field = "alpha2";
            break;

            default:
                $field = "alpha3";
            break;
        }

        return self::_getISOByField($field, $value);
    }

    // Get ISO-3166 entry(ies) based on field-value with optional return columns
    static function getISOByField(string $field, string $value, array $return_columns=array("*")) {
        if ($field == "") {
            return FALSE;
        }

        if (strtolower($value) == "null") {
            $value = NULL;
        }

        if (empty($return_columns) || in_array("all", $return_columns)) {
            $return_columns = array("*");
        }

        $return_string = "";
        if (count($return_columns) > 1) {
            $return_string = implode(", ", $return_columns);
        } else {
            $return_string = $return_columns[0];
        }

        return self::_getISOByField($field, $value, $return_string);
    }

    static function getAll() {
        $sql = "SELECT * FROM iso_countrycodes;";

        self::$db->query($sql);
        self::$db->execute();

        return self::$db->getResults();  
    }
}

?>