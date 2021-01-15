<?php

namespace MercadoUnico\MuService\Transformers;

use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\TipoPropiedad;

class TipoPropiedadTransformer implements TransformerInterface
{
    /**
     * @param array $data
     * @return TipoPropiedad
     */
    public function transform(array $data): TipoPropiedad
    {
        return new TipoPropiedad(
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
        $tiposPropiedad = [];
        foreach ($rows as $row) {
            $tiposPropiedad[] = self::transform($row);
        }

        return $tiposPropiedad;
    }

}