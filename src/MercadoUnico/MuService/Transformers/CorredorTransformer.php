<?php

namespace MercadoUnico\MuService\Transformers;

use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\Corredor;

class CorredorTransformer implements TransformerInterface
{

    /**
     * @param array $data
     * @return Corredor
     */
    public function transform(array $data): Corredor
    {
        return new Corredor(
            $data['id'] ?? null,
            $data['nombre'] ?? null,
            $data['email'] ?? null,
            $data['matricula'] ?? null,
            $data['descripcion'] ?? null,
            $data['fotografia'] ?? null,
            $data['telefono'] ?? null,
            $data['celular'] ?? null,
            $data['domicilio'] ?? null,
            $data['ciudad'] ?? null,
            $data['inmobiliaria'] ?? null,
            $data['telefonosPublicos'] ?? null
        );
    }

    /**
     * @param iterable $rows
     * @return iterable
     */
    public function transformCollection(iterable $rows): iterable
    {
        $corredores = [];
        foreach ($rows as $row) {
            $corredores[] = self::transform($row);
        }

        return $corredores;
    }

}