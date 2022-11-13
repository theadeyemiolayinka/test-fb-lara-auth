<?php

declare(strict_types=1);

namespace TheAdeyemiOlayinka\FbLaraAuth\Exceptions;

use TheAdeyemiOlayinka\FbLaraAuth\Exceptions\BaseException;
use RuntimeException;

final class UIDCheckFailed extends RuntimeException implements BaseException
{
}