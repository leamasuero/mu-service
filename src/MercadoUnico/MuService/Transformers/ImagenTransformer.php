<?php

namespace MercadoUnico\MuService\Transformers;

use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\Imagen;

class ImagenTransformer implements TransformerInterface
{
    /**
     * @param array $data
     * @return Imagen
     */
    public function transform(array $data): Imagen
    {


        return new Imagen($data['url']);
    }

    /**
     * @param iterable $rows
     * @return iterable
     */
    public function transformCollection(iterable $rows): iterable
    {
        $imagenes = [];
        foreach ($rows as $row) {
            $imagenes[] = self::transform(['url' => $row]);
        }

        return $imagenes;
    }
}
