<?php

namespace MercadoUnico\MuService\Models;

class Importe
{
    const MONEDA_ARS = '$';
    const MONEDA_USD = 'USD';

    protected float $valor;

    protected string $moneda;

    /**
     * @param float $valor
     * @param string|null $moneda
     */
    public function __construct(float $valor, ?string $moneda = null)
    {
        $this->valor = $valor;
        $this->moneda = self::MONEDA_ARS;
        if ($moneda) {
            $this->moneda = $moneda;
        }
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getMoneda(): string
    {
        return $this->moneda;
    }

    public function __toString(): string
    {
        return sprintf("{$this->moneda}&nbsp;%s", number_format($this->importe, 2));
    }

    public function toArray(): array
    {
        return [
            'moneda' => $this->moneda,
            'valor' => $this->valor,
        ];
    }
}
