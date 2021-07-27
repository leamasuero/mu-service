<?php

namespace MercadoUnico\MuService\Util;

class Alerta extends Query
{

    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $apellido;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $telefono;

    /**
     * Alerta constructor.
     */
    public function __construct()
    {
        $this->id = null;
        parent::__construct();
    }


    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Alerta
     */
    public function id(string $id): Alerta
    {
        $this->id = $id;
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
     * @return Alerta
     */
    public function nombre(string $nombre): Alerta
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellido(): string
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     * @return Alerta
     */
    public function apellido(string $apellido): Alerta
    {
        $this->apellido = $apellido;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Alerta
     */
    public function email(string $email): Alerta
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @param string|null $telefono
     * @return Alerta
     */
    public function telefono(?string $telefono): Alerta
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function getFormaDeContacto(): string
    {
        return 'whatsapp';
    }

    public function getCriteriosTexto(): string
    {
        return "Casas con 2 dormitorios con cochera en venta en la ciudad de Santo Tome, hasta USD 1225000, de hasta 5 años, apta crédito y ofrecido por APL Inmobiliaria.";
    }

    public function toArray(string $alquilerId, string $compraVentaId): array
    {
        return
            array_filter(
                array_merge(
                    [
                        'id' => $this->getId(),
                        'pedido' => [
                            'nombre' => "{$this->nombre} {$this->apellido}",
                            'telefono' => $this->telefono,
                            'formaDeContacto' => $this->getFormaDeContacto(),
                        ],
                        'criteriosTexto' => $this->getCriteriosTexto(),
                        'email' => $this->email,
                    ],
                    [
                        'criterios' => parent::toArray($alquilerId, $compraVentaId)
                    ]
                )
            );

//{
//    "email":"leandro.masuero@gmail.com",
//        "criterios":
//        {
//            "precio.venta.valor":["<=1225000"],
//        "precio.venta.moneda":"USD",
//        "ubicacion.ciudad":"5a8f39a95842a2580cb7e432",
//        "inmobiliaria":"58bac1d3c2138539ce7f82d0",
//        "dormitorios":">=2",
//        "antiguedad":"<=5",
//        "tipoPropiedad":["58f5563e2a90f5cb1104b49c"],
//        "operacion":["58f554cebf61939961ee734c"],
//        "cochera":true,
//        "aptaCredito":true
//        },
//        "criteriosTexto":"Casas con 2 dormitorios con cochera en venta en la ciudad de Santo Tome, hasta USD 1225000, de hasta 5 años, apta crédito y ofrecido por APL Inmobiliaria.",
//           "pedido":{
//    "nombre":"Leandro",
//              "telefono":"154429372",
//              "formaDeContacto":"whatsapp"
//       }
//}

    }


}

