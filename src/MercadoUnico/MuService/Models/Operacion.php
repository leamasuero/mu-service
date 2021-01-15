<?php

namespace MercadoUnico\MuService\Models;


class Operacion
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
     * Operacion constructor.
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
     * @param string $id
     * @return Operacion
     */
    public function setId(string $id): Operacion
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Operacion
     */
    public function setSlug(string $slug): Operacion
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Operacion
     */
    public function setNombre(string $nombre): Operacion
    {
        $this->nombre = $nombre;
        return $this;
    }


    public function __toString()
    {
        return $this->getNombre();
    }

}