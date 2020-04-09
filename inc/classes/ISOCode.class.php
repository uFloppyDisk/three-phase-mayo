<?PHP

require_once("inc/exceptions.inc.php");

class ISOCode {
    private $id;
    private $name;
    private $alpha2;
    private $alpha3;
    private $country_code;
    private $iso_3166_2;
    private $region;
    private $sub_region;
    private $immediate_region;
    private $region_code;
    private $sub_region_code;
    private $immediate_region_code;


    function __toString() {
        return $this->name;
    }

    // Getters
    function getID() {
        return (int)$this->id;
    }

    function getName() {
        return $this->name;
    }

    function getAlpha(int $type=3) {
        switch ($type) {
            case 2:
                return $this->alpha2;
            break;

            default:
                return $this->alpha3;
            break;
        }
    }

    function getCountryCode() {
        return (int)$this->country_code;
    }

    function getISO3166_2() {
        return $this->iso_3166_2;
    }

    function getRegion() {
        return $this->region;
    }

    function getSubRegion() {
        return $this->sub_region;
    }

    function getImmediateRegion() {
        return $this->immediate_region;
    }

    function getRegionCode() {
        return (int)$this->region_code;
    }

    function getSubRegionCode() {
        return (int)$this->sub_region_code;
    }

    function getImmediateRegionCode() {
        return (int)$this->immediate_region_code;
    }

    function getJSON() {
        $object = new stdClass();
        
        $object->id = (int)$this->id;
        $object->name = $this->name;

        $object->alpha2 = $this->alpha2;
        $object->alpha3 = $this->alpha3;
        $object->country_code = (int)$this->country_code;
        $object->iso_3166_2 = $this->iso_3166_2;

        $object->region = $this->region;
        $object->sub_region = $this->sub_region;
        $object->immediate_region = $this->immediate_region;

        $object->region_code = (int)$this->region_code;
        $object->sub_region_code = (int)$this->sub_region_code;
        $object->immediate_region_code = (int)$this->immediate_region_code;

        return json_encode($object);
    }
}

?>
