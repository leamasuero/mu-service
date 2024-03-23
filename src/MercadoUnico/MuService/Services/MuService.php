<?php

namespace MercadoUnico\MuService\Services;

use MercadoUnico\MuClient\Exceptions\JsonErrorException;
use MercadoUnico\MuClient\Exceptions\MuErrorResponseException;
use MercadoUnico\MuClient\Exceptions\MuException;
use MercadoUnico\MuClient\MuClient;
use MercadoUnico\MuService\Models\Caracteristica;
use MercadoUnico\MuService\Models\Ciudad;
use MercadoUnico\MuService\Models\Documento;
use MercadoUnico\MuService\Models\Imagen;
use MercadoUnico\MuService\Models\Operacion;
use MercadoUnico\MuService\Models\Propiedad;
use MercadoUnico\MuService\Models\TipoPropiedad;
use MercadoUnico\MuService\Requests\PropiedadRequest;
use MercadoUnico\MuService\Transformers\CiudadTransformer;
use MercadoUnico\MuService\Transformers\DocumentoTransformer;
use MercadoUnico\MuService\Transformers\OperacionTransformer;
use MercadoUnico\MuService\Transformers\PropiedadTransformer;
use MercadoUnico\MuService\Transformers\TipoPropiedadTransformer;
use MercadoUnico\MuService\Util\Alerta;
use MercadoUnico\MuService\Util\Query;
use SplFileInfo;

class MuService
{

    const BASE_URL = "https://mercado-unico.com";
    const SANDBOX_BASE_URL = "https://prop44.info";

    /**
     * @var MuClient
     */
    protected MuClient $muClient;

    /**
     * @var string
     */
    protected string $compraVentaId;

    /**
     * @var string
     */
    protected string $alquilerId;

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
     * @throws JsonErrorException
     * @throws MuException
     */
    public function storePropiedad(Propiedad $propiedad): Propiedad
    {
//        SCOPE
//        []: solo la ve la inmobiliaria
//        ['mu:corredores:main']: la ven todos los corredores
//        ['mu:publico', 'mu:corredores:main']: visible por todos

        $response = $this->muClient->storePropiedad(PropiedadRequest::create($propiedad)->getData());

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    /**
     * @param SplFileInfo $documento
     * @param string $filename
     * @return Documento|null
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function storeDocumento(SplFileInfo $documento, string $filename): ?Documento
    {
        $response = $this->muClient->storeDocumento($documento, $filename);

        $documentos = (new DocumentoTransformer())->transformCollection($response->getBody());
        if (isset($documentos[0])) {
            return $documentos[0];
        }

        return null;
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
     * @throws JsonErrorException
     * @throws MuException
     */
    public function updatePropiedad(Propiedad $propiedad): Propiedad
    {
//        SCOPE
//        []: solo la ve la inmobiliaria
//        ['mu:corredores:main']: la ven todos los corredores
//        ['mu:publico', 'mu:corredores:main']: visible por todos

        $response = $this->muClient->updatePropiedad($propiedad->getId(), PropiedadRequest::create($propiedad)->getData());

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    public function updatePropiedadScopes(string $id, array $scopes)
    {
        return $this->muClient->updatePropiedadScopes($id, $scopes);
    }


    /**
     * @param Query $query
     * @return Propiedad[]
     * @throws MuException
     * @throws MuErrorResponseException
     */
    public function search(Query $query): iterable
    {
        $response = $this->muClient->getPropiedades($query->toArray($this->alquilerId, $this->compraVentaId));

        return (new PropiedadTransformer($this->getBaseUrl()))->transformCollection($response->getBody());
    }

    /**
     * @return TipoPropiedad[]
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function getTiposDePropiedad(): iterable
    {
        $response = $this->muClient->getTiposPropiedad();

        return (new TipoPropiedadTransformer())->transformCollection($response->getBody());
    }

    /**
     * @return Ciudad[]
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function getCiudades(?string $inmobiliariaId = null): iterable
    {
        $response = $this->muClient->getCiudades($inmobiliariaId);

        return (new CiudadTransformer())->transformCollection($response->getBody());
    }

    /**
     * @return Operacion[]
     * @throws MuErrorResponseException
     * @throws MuException
     */
    public function getOperaciones(): iterable
    {
        $response = $this->muClient->getOperaciones();

        return (new OperacionTransformer())->transformCollection($response->getBody());
    }


}
