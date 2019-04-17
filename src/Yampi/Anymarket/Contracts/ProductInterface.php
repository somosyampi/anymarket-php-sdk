<?php 

namespace Yampi\Anymarket\Contracts;

interface ProductInterface
{
    public function create(array $params);
    public function update($id , array $params);
    public function find($id);
}