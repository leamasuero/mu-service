<?php

namespace MercadoUnico\MuService\Models;


class Ciudad
{
    /**
     * @var string|null
     */
    protected ?string $id;

    /**
     * @var string|null
     */
    protected ?string $slug;

    /**
     * @var string|null
     */
    protected ?string $nombre;

    /**
     * @var float|null
     */
    protected ?float $latitud;

    /**
     * @var float|null
     */
    protected ?float $longitud;

    /**
     * @var int|null
     */
    protected ?int $zoom;

    /**
     * @var string|null
     */
    protected ?string $provincia;

    /**
     * Ciudad constructor.
     * @param string|null $id
     * @param string|null $nombre
     * @param string|null $slug
     * @param string|null $provincia
     */
    public function __construct(?string $id = null, ?string $nombre = null, ?string $slug = null, ?string $provincia = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->slug = $slug;
        $this->provincia = $provincia;

        $this->latitud = null;
        $this->longitud = null;
        $this->zoom = null;
    }

    public static function create(?string $id = null, ?string $nombre = null, ?string $slug = null, ?string $provincia = null): static
    {
        return new static($id, $nombre, $slug, $provincia);
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
