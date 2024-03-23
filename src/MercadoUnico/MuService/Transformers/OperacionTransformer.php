<?php

namespace MercadoUnico\MuService\Transformers;

use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\Operacion;

class OperacionTransformer implements TransformerInterface
{

    public function transform(array $data): Operacion
    {
        return new Operacion(
            $data['id'] ?? null,
            $data['slug'] ?? null,
            $data['nombre'] ?? null
        );

    }

    /**
     * @param iterable $rows
     * @return iterable
     */
    public function transformCollection(iterable $rows): iterable
    {
        $operaciones = [];
        foreach ($rows as $row) {
            $operaciones[] = self::transform($row);
        }

        return $operaciones;
    }

}
