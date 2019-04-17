<?php 

namespace Yampi\Anymarket\Contracts;

interface StockInterface
{
    public function create(array $params);
    public function update($id , array $params);
    public function find($id);
    public function delete($id);
    public function updatePrice($id, $price);
    public function updateStockQuantity($id, $quantity);
}