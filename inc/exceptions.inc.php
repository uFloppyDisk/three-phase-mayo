<?PHP

class DatabaseException extends RuntimeException { }
class DatabaseValueException extends DatabaseException {
    public static function valueNotUnique($value, $code = 0, Exception $previous = NULL) {
        $msg = sprintf(
            'Attempted to insert duplicate value "%s" into a column flagged UNIQUE or PRIMARY.', $value
        );

        return new static($msg, $code, $previous);
    }

    public static function valueExceedsBounds($msg, $code = 0, Exception $previous) {
        return new static($msg, $code, $previous);
    }
}

class JSONException extends RuntimeException { }
class JSONReadException extends JSONException {
    public static function fieldDoesNotExist($field, $code = 0, Exception $previous = NULL) {
        $msg = sprintf(
            'Field "%s" does not exist.', $field
        );

        return new static($msg, $code, $previous);
    }
}

class IllegalInputException extends RuntimeException { }
?>