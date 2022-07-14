<?php declare(strict_types=1);

namespace NcpConfig\Core\Content\Entities\Class1;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ConfiguratorClassEntity extends Entity
{

    /**
     * @var string
     */
    protected string $name;


    use EntityIdTrait;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

}
