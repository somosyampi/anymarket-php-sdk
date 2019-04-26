<?php

namespace Yampi\Anymarket\Contracts;

interface VariationValueInterface
{
    public function get();

    public function create(array $params);

    public function update($id, array $params);

    public function find($id);

    public function setVariation($variationId);
}
