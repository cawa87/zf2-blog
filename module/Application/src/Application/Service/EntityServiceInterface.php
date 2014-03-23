<?php
namespace Application\Service;
/**
 * Description of EntityServiceInterface
 *
 * @author cawa
 */
interface EntityServiceInterface
{
    public function getRepository();

    public function getList();
    
    public function findById($id);
    
    public function removeById($id);
    
    public function exchangeArray($entity, array $data);
    
    public function save($entity);
}
