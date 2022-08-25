<?php

namespace MercadoUnico\MuService\Services;

use MercadoUnico\MuClient\Exceptions\MuErrorResponseException;
use MercadoUnico\MuClient\Exceptions\MuException;
use MercadoUnico\MuClient\MuClient;
use MercadoUnico\MuService\Models\Ciudad;
use MercadoUnico\MuService\Models\Propiedad;
use MercadoUnico\MuService\Models\TipoPropiedad;
use MercadoUnico\MuService\Transformers\CiudadTransformer;
use MercadoUnico\MuService\Transformers\OperacionTransformer;
use MercadoUnico\MuService\Transformers\PropiedadTransformer;
use MercadoUnico\MuService\Transformers\TipoPropiedadTransformer;
use MercadoUnico\MuService\Util\Alerta;
use MercadoUnico\MuService\Util\Query;

class MuService
{

    const BASE_URL = "https://mercado-unico.com";
    const SANDBOX_BASE_URL = "https://prop44.info";

    /**
     * @var MuClient
     */
    protected $muClient;

    /**
     * @var string
     */
    protected $compraVentaId;

    /**
     * @var string
     */
    protected $alquilerId;

    public function __construct(MuClient $muClient, string $alquilerId, string $compraVentaId)
    {
        $this->muClient = $muClient;
        $this->muClient->connect();

        $this->alquilerId = $alquilerId;
        $this->compraVentaId = $compraVentaId;
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        return $this->muClient->isSandboxMode() ? self::SANDBOX_BASE_URL : self::BASE_URL;
    }

    /**
     * @param string $id
     * @return Propiedad
     * @throws MuException
     */
    public function findPropiedad(string $id): Propiedad
    {
        $response = $this->muClient->findPropiedad($id);

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    /**
     * @param string $slug
     * @return Propiedad|null
     */
    public function findPropiedadBySlug(string $slug): ?Propiedad
    {
        $query = new Query();
        $query->slug($slug);
        $response = $this->muClient->getPropiedades($query->toArray($this->alquilerId, $this->compraVentaId));

        $propiedades = (new PropiedadTransformer($this->getBaseUrl()))->transformCollection($response->getBody());
        return count($propiedades) ? $propiedades[0] : null;
    }

    /**
     * @param string $id
     * @return Ciudad
     * @throws MuException
     */
    public function findCiudad(string $id): Ciudad
    {
        $data = $this->muClient->findCiudad($id)->getBody();

        return (new CiudadTransformer())->transform($data);
    }

    /**
     * @param string $id
     * @return TipoPropiedad
     * @throws MuException
     */
    public function findTipoPropiedad(string $id): TipoPropiedad
    {
        $response = $this->muClient->findTipoPropiedad($id);

        return (new TipoPropiedadTransformer())->transform($response->getBody());
    }

    /**
     * @param Propiedad $propiedad
     * @return Propiedad
     * @throws \MercadoUnico\MuClient\Exceptions\JsonErrorException
     * @throws MuException
     */
    public function storePropiedad(Propiedad $propiedad): Propiedad
    {
//        SCOPE
//        []: solo la ve la inmobiliaria
//        ['mu:corredores:main']: la ven todos los corredores
//        ['mu:publico', 'mu:corredores:main']: visible por todos
        $data = [
            "scopes" => [],
            "operacion" => $this->alquilerId,
            "tipoPropiedad" => $propiedad->getTipoPropiedad()->getId(),
            "descripcion" => $propiedad->getDescripcion(),
            "precio" => $propiedad->getPrecio(),
            "ubicacion" => [
                "ciudad" => $propiedad->getCiudad()->getId(),
                "provincia" => "{$propiedad->getCiudad()->getProvincia()}",
                "direccion" => $propiedad->getDireccion(),
                "coordenadas" => [
                    $propiedad->getLatitud(),
                    $propiedad->getLongitud(),
                ]
            ]
        ];

        $response = $this->muClient->storePropiedad($data);

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    /**
     * @param Ciudad $ciudad
     * @return Ciudad
     */
    public function storeCiudad(Ciudad $ciudad): Ciudad
    {

        $data = [
            'nombre' => $ciudad->getNombre(),
            'provincia' => $ciudad->getProvincia(),
            "latitud" => $ciudad->getLatitud(),
            "longitud" => $ciudad->getLongitud(),
            "zoom" => $ciudad->getZoom(),
        ];

        $response = $this->muClient->storeCiudad($data);

        return (new CiudadTransformer())->transform($response->getBody());
    }


    public function storeAlerta(Alerta $alerta): Alerta
    {
        $response = $this->muClient->storeAlerta($alerta->toArray($this->alquilerId, $this->compraVentaId));

        $alerta->id($response->getBody()['_id']);

        return $alerta;
    }

    /**
     * @param Propiedad $propiedad
     * @return Propiedad
     * @throws \MercadoUnico\MuClient\Exceptions\JsonErrorException
     * @throws MuException
     */
    public function updatePropiedad(Propiedad $propiedad): Propiedad
    {
//        SCOPE
//        []: solo la ve la inmobiliaria
//        ['mu:corredores:main']: la ven todos los corredores
//        ['mu:publico', 'mu:corredores:main']: visible por todos
        $data = [
//            "scopes" => [],
            "operaciones" => $this->alquilerId,
            "tipoPropiedad" => $propiedad->getTipoPropiedad()->getId(),
            "descripcion" => $propiedad->getDescripcion(),
            "ubicacion" => [
                "direccion" => $propiedad->getDireccion(),
                "ciudad" => "{$propiedad->getCiudad()}",
            ]
        ];

        $response = $this->muClient->storePropiedad($data);

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    public function updatePropiedadScopes(string $id, array $scopes)
    {
        return $this->muClient->updatePropiedadScopes($id, $scopes);
    }


    /**
     * @param Query $query
     * @return iterable
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function search(Query $query): iterable
    {
        $response = $this->muClient->getPropiedades($query->toArray($this->alquilerId, $this->compraVentaId));

        return (new PropiedadTransformer($this->getBaseUrl()))->transformCollection($response->getBody());
    }

    /**
     * @return iterable
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function getTiposDePropiedad(): iterable
    {
        $response = $this->muClient->getTiposPropiedad();

        return (new TipoPropiedadTransformer())->transformCollection($response->getBody());
    }

    /**
     * @return iterable
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function getCiudades(): iterable
    {
        $response = $this->muClient->getCiudades();

        return (new CiudadTransformer())->transformCollection($response->getBody());
    }

    /**
     * @return iterable
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function getOperaciones(): iterable
    {
        $response = $this->muClient->getOperaciones();

        return (new OperacionTransformer())->transformCollection($response->getBody());
    }


}
