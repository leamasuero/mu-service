<?php

namespace MercadoUnico\MuService\Models;

class Documento
{
    protected string $name;
    protected string $url;

    /**
     * @param string $name
     * @param string $url
     */
    public function __construct(string $name, string $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'url' => $this->getUrl(),
        ];
    }

}
