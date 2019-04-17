<?php 

namespace Yampi\Anymarket\Contracts;

interface BrandInterface
{
    public function get($offset, $limit);
    public function create(array $params);
    public function update($id , array $params);
    public function find($id);
    public function delete($id);
}