<?php

namespace MercadoUnico\MuService\Models;


class TipoPropiedad
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * TipoPropiedad constructor.
     * @param string $id
     * @param string $slug
     * @param string $nombre
     */
    public function __construct(string $id, string $slug, string $nombre)
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

}
