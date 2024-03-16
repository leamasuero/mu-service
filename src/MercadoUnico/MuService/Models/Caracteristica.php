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

    public function __toString(): string
    {
        return $this->nombre;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
