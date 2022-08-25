<?php

namespace MercadoUnico\MuService\Models;


class Ciudad
{
    /**
     * @var string|null
     */
    private ?string $id;

    /**
     * @var string|null
     */
    private ?string $slug;

    /**
     * @var string|null
     */
    private ?string $nombre;

    /**
     * @var float|null
     */
    private ?float $latitud;

    /**
     * @var float|null
     */
    private ?float $longitud;

    /**
     * @var int|null
     */
    private ?int $zoom;

    /**
     * @var string|null
     */
    private ?string $provincia;

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

    public static function create(?string $id, ?string $nombre, ?string $slug, ?string $provincia = null): static
    {
        return static($id, $nombre, $slug, $provincia);
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
     * @return string|null
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @return string|null
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

    /**
     * @return float|null
     */
    public function getLatitud(): ?float
    {
        return $this->latitud;
    }

    /**
     * @param float|null $latitud
     * @return Ciudad
     */
    public function setLatitud(?float $latitud): Ciudad
    {
        $this->latitud = $latitud;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitud(): ?float
    {
        return $this->longitud;
    }

    /**
     * @param float|null $longitud
     * @return Ciudad
     */
    public function setLongitud(?float $longitud): Ciudad
    {
        $this->longitud = $longitud;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getZoom(): ?int
    {
        return $this->zoom;
    }

    /**
     * @param int|null $zoom
     * @return Ciudad
     */
    public function setZoom(?int $zoom): Ciudad
    {
        $this->zoom = $zoom;
        return $this;
    }


    public function __toString()
    {
        return "{$this->getNombre()}, {$this->getProvincia()}";
    }

}
