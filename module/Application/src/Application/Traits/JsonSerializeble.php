<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Traits;

/**
 * Description of jsonSerialize
 *
 * @author cawa
 */
trait JsonSerializeble
{

    public function jsonSerialize()
    {
        $ref = new \ReflectionClass($this);
        $data = array();
        foreach (array_values($ref->getMethods()) as $method) {
            if ((0 === strpos($method->name, "get")) && $method->isPublic()) {
                $name = substr($method->name, 3);
                $name[0] = strtolower($name[0]);
                $value = $method->invoke($this);
                if ("object" === gettype($value)) {
                    $value = toDataObj($value);
                }
                $data[$name] = $value;
            }
        }
        return $data;
    }

}
