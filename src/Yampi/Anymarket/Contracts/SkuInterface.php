<?php 

namespace Yampi\Anymarket\Contracts;

interface SkuInterface
{
    public function get();
    public function create(array $params);
    public function update($id, array $params);
    public function find($id);
    public function setProduct($productId);
}