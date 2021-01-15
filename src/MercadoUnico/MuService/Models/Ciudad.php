<?php

namespace MercadoUnico\MuService\Models;


class Ciudad
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $provincia;

    /**
     * Ciudad constructor.
     * @param string $id
     * @param string $nombre
     * @param string $slug
     * @param string $provincia
     */
    public function __construct(string $id, string $nombre, ?string $slug, ?string $provincia = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->slug = $slug;
        $this->provincia = $provincia;
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
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    /**
     * @param string $provincia
     * @return Ciudad
     */
    public function setProvincia(string $provincia): Ciudad
    {
        $this->provincia = $provincia;
        return $this;
    }

    public function __toString()
    {
        return "{$this->getNombre()}, {$this->getProvincia()}";
    }

}