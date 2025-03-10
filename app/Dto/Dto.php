<?php

namespace App\Dto;

use App\Exceptions\DtoException;
use Illuminate\Contracts\Support\Arrayable;

abstract class Dto implements Arrayable
{
    public function __construct(private readonly array $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if ($v instanceof Dto) {
                        $this->$key = $value;
                    }
                }
                continue;
            }
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
