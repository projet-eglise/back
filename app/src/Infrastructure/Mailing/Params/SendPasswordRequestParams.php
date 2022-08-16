<?php

namespace Src\Infrastructure\Mailing\Params;

use Src\Domain\Mailing\Params;

final class SendPasswordRequestParams extends Params
{
    protected function checkIfValid()
    {
        $this->checkParam('url');
    }
}
