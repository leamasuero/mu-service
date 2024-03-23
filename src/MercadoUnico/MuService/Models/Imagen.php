<?php

namespace MercadoUnico\MuService\Models;

class Imagen
{
    protected string $url;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function __toString(): string
    {
        return $this->getUrl();
    }
}
