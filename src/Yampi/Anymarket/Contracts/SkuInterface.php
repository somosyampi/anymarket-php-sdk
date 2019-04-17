<?php 

namespace Yampi\Anymarket\Contracts;

interface SkuInterface
{
    public function get($productId);
    public function create($productId, array $params);
    public function update($productId, $id, array $params);
    public function find($productId, $id);
}