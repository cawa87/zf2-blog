<?php

namespace Application\Entity;

use Application\Traits\JsonSerializeble;
use Application\Traits\OffsetSet;

/**
 * Description of AbstractEntity
 *
 * @author cawa
 */
abstract class AbstractEntity implements \Zend\Stdlib\JsonSerializable
{

    use JsonSerializeble,
        OffsetSet;

    /**
     * Construct object
     *
     * @param mixed $data
     * @return Entity
     */
    public function __construct($data = null)
    {
        //Populate
        if (is_array($data))
            $this->fromArray($data);
        if (is_string($data))
            $this->fromJson($data);
    }

    /**
     * Populate current object with data
     * @param $data
     * @return Entity
     */
    public function fromArray(array $data = array())
    {

        foreach ($data as $property => $value) {
            $setter = 'set' . ucfirst($property);
            if (method_exists($this, $setter))
                $this->$setter($value);
            elseif (property_exists($this, $property))
                $this->$property = $value;
        }
        return $this;
    }

    /**
     * Return current object representation as JSON
     * @param string $data
     * @return Entity
     */
    public function fromJson($data = '')
    {
        if (empty($data))
            return;

        $jsonObject = json_decode($data);
        $dataArray = (array) $jsonObject; // stdClass to array

        $this->fromArray($dataArray);
        return $this;
    }

    /**
     * getArrayCopy function.
     *
     * @access public
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
