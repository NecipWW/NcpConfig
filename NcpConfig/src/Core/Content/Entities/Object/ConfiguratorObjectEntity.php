<?php declare(strict_types=1);

namespace NcpConfig\Core\Content\Entities\Object;

use NcpConfig\Core\Content\Entities\Class1\ConfiguratorClassEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ConfiguratorObjectEntity extends Entity
{

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string
     */
    protected string $idCls;

    /**
     * @var ConfiguratorClassEntity|null
     */
    protected ?ConfiguratorClassEntity $class;


    use EntityIdTrait;

    /**
     * @return string
     */
    public function getIdCls(): string
    {
        return $this->idCls;
    }

    /**
     * @param string $idCls
     * @return void
     */
    public function setIdCls(string $idCls): void
    {
        $this->idCls = $idCls;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return ConfiguratorClassEntity|null
     */
    public function getClass(): ?ConfiguratorClassEntity
    {
        return $this->class;
    }

    /**
     * @param ConfiguratorClassEntity|null $class
     * @return void
     */
    public function setClass(?ConfiguratorClassEntity $class): void
    {
        $this->class = $class;
    }


    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->class ? $this->class->getName() : "";
    }
}
