<?php
declare(strict_types=1);

namespace NcpConfig\Struct;

use Shopware\Core\Framework\Struct\Struct;

class StructConfigurator extends Struct
{
    public string $productName = "";
    public string $projectGroupName = "";
    public array $arrDimension = [];
}
