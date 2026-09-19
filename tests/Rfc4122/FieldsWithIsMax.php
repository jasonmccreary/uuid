<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Test\Rfc4122;

use Ramsey\Uuid\Rfc4122\FieldsInterface;

/**
 * Fields is final and FieldsInterface does not declare isMax(), so this gives a double something to target
 */
interface FieldsWithIsMax extends FieldsInterface
{
    public function isMax(): bool;
}
