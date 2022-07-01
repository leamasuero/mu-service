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
     * @param string|null $id
     * @param string|null $nombre
     * @param string|null $slug
     * @param string|null $provincia
     */
    public function __construct(?string $id, ?string $nombre, ?string $slug, ?string $provincia = null)
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
     * @param string|null $provincia
     * @return Ciudad
     */
    public function setProvincia(?string $provincia): Ciudad
    {
        $this->provincia = $provincia;
        return $this;
    }

    /**
     * @param string|null $id
     * @return Ciudad
     */
    public function setId(?string $id): Ciudad
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $slug
     * @return Ciudad
     */
    public function setSlug(?string $slug): Ciudad
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @param string|null $nombre
     * @return Ciudad
     */
    public function setNombre(?string $nombre): Ciudad
    {
        $this->nombre = $nombre;
        return $this;
    }



    public function __toString()
    {
        return "{$this->getNombre()}, {$this->getProvincia()}";
    }

}
