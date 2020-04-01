<?PHP

require_once("inc/exceptions.inc.php");

class Account {
    private $id;
    private $username;
    private $email;
    private $password;
    private $name_first;
    private $name_last;
    private $name_full;
    private $addressing;
    private $merchant_account;
    private $merchant_id;

    
    // Getters
    function getID() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getEmail() {
        return $this->email;
    }

    function getFirstName() {
        return $this->name_first;
    }

    function getLastName() {
        return $this->name_last;
    }

    function getFullName() {
        return $this->name_full;
    }

    // Get shipping, billing or both addresses
    function getAddressing($type="shipping") {
        $ret = NULL;

        if (is_null($type)) {
            $ret = $this->addressing;
        } else if ($type == "shipping" || $type == "billing") {
            $ret = $this->addressing[$type];
        } else {
            throw JSONReadException::fieldDoesNotExist($type);
        }

        return $ret;
    }

    function getIsMerchantAccount() {
        return $this->merchant_account;
    }

    function getMerchantID() {
        return $this->merchant_id;
    }

    function setUsername(string $value) {
        $this->username = $value;
    }

    function setEmail(string $value) {
        $this->email = $value;
    }

    function setPassword(string $value) {
        $password = password_hash($value, PASSWORD_DEFAULT);
        $this->password = $value;
    }

    function setFirstName(string $value) {
        $this->name_first = $value;
    }

    function setLastName(string $value) {
        $this->name_last = $value;
    }

    function setAddressing(JSON $value) {
        $this->addressing = $value;
    }

    function setMerchantAccount($value) {
        $this->merchant_account = $value;
    }

    function setMerchantID(int $value) {
        $this->merchant_id = $value;
    }

    function verifyPassword(string $input) {
        return password_verify($input, $this->password);
    }
}

?>