<?php

namespace Src\Domain\Mailing;

use Src\Domain\Authentication\Exceptions\InvalidParamsException;

abstract class Params
{
    public function __construct(
        private array $params = []
    ) {
        $this->checkIfValid();
    }

    public function value(): array
    {
        return $this->params;
    }

    protected function checkParam(string $key)
    {
        if (!isset($this->params[$key]))
            throw new InvalidParamsException("Parameter '$key' is missing.");
    }

    protected abstract function checkIfValid();
}
