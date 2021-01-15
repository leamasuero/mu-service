<?php

namespace MercadoUnico\MuService\Transformers;


use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\Inmobiliaria;

class InmobiliariaTransformer implements TransformerInterface
{

    /**
     * @param array $data
     * @return Inmobiliaria
     */
    public function transform(array $data): Inmobiliaria
    {
        return new Inmobiliaria(
            $data['id'] ?? null,
            $data['nombre'] ?? null,
            $data['ciudad'] ?? null,
            $data['domicilio'] ?? null,
            $data['telefono'] ?? null,
            $data['email'] ?? null,
            $data['logo'] ?? null,
            $data['sitio_web'] ?? null,
            $data['whatsapp'] ?? null
        );
    }

    /**
     * @param iterable $rows
     * @return iterable
     */
    public function transformCollection(iterable $rows): iterable
    {
        $inmobiliarias = [];
        foreach ($rows as $row) {
            $inmobiliarias[] = self::transform($row);
        }

        return $inmobiliarias;
    }

}