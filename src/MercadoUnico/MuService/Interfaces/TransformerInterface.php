<?php

namespace MercadoUnico\MuService\Interfaces;


interface TransformerInterface
{

    const DATE_TIME_FORMAT = 'Y-m-d\TH:i:s.u\Z';

    public function transform(array $row);

    public function transformCollection(iterable $rows): iterable;

}