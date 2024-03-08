<?php

namespace MercadoUnico\MuService\Transformers;

use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\Documento;

class DocumentoTransformer implements TransformerInterface
{
    /**
     * @param array $data
     * @return Documento
     */
    public function transform(array $data): Documento
    {
        return new Documento($data['url'], $data['name']);
    }

    /**
     * @param iterable $rows
     * @return iterable
     */
    public function transformCollection(iterable $rows): iterable
    {
        $documentos = [];
        foreach ($rows as $row) {
            $documentos[] = self::transform($row);
        }

        return $documentos;
    }

}
