<?php declare(strict_types=1);

namespace NcpConfig\Core\Content\Entities\Class1;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                         add(ConfiguratorClassEntity $entity)
 * @method void                         set(string $key, ConfiguratorClassEntity $entity)
 * @method ConfiguratorClassEntity[]    getIterator()
 * @method ConfiguratorClassEntity[]    getElements()
 * @method ConfiguratorClassEntity|null get(string $key)
 * @method ConfiguratorClassEntity|null first()
 * @method ConfiguratorClassEntity|null last()
 */
class ConfiguratorClassCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ConfiguratorClassEntity::class;
    }
}
