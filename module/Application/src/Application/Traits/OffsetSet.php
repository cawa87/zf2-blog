<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Traits;
/**
 * Description of OffsetSet
 *
 * @author cawa
 */
trait OffsetSet
{

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

}
