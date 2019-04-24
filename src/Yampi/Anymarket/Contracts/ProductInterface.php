<?php

namespace Yampi\Anymarket\Contracts;

interface ProductInterface
{
    public function get($offset, $limit);
    public function create(array $params);

    public function update($id, array $params);

    public function find($id);

    public function updateTitle($id, $title);
}
