<?php

namespace MercadoUnico\MuService\Transformers;

use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\Ciudad;

class CiudadTransformer implements TransformerInterface
{
    /**
     * @param array $data
     * @return Ciudad
     */
    public function transform(array $data): Ciudad
    {

        return Ciudad::create(
            $data['id'] ?? null,
            $data['nombre'] ?? null,
            $data['slug'] ?? null,
            $data['provincia'] ?? null
        )
            ->setLatitud($data['latitud'] ?? null)
            ->setLongitud($data['longitud'] ?? null)
            ->setZoom($data['zoom'] ?? null);
    }

    /**
     * @param iterable $rows
     * @return iterable
     */
    public function transformCollection(iterable $rows): iterable
    {
        $ciudades = [];
        foreach ($rows as $row) {
            $ciudades[] = self::transform($row);
        }

        return $ciudades;
    }

}
