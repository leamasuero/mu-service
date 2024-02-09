<?php

namespace MercadoUnico\MuService\Models;

class Caracteristica implements \JsonSerializable
{
    protected string $nombre;

    /**
     * @param string $nombre
     */
    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function toArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'value' => true,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
