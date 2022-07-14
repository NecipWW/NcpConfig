<?php declare(strict_types=1);

namespace NcpConfig\Core\Content\Entities\ObjectCon;

use NcpConfig\Core\Content\Entities\ClassCon\ConfiguratorClassConEntity;
use NcpConfig\Core\Content\Entities\Object\ConfiguratorObjectEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ConfiguratorObjectConEntity extends Entity
{

    /**
     * @var string
     */
    protected string $idClsCon;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $idObjFrom;

    /**
     * @var string
     */
    protected string $idObjTo;

    //
    // Fields for "ProjectGroup to Dimension"
    //

    /**
     * @var float
     */
    protected float $pgDmValueMin;
    /**
     * @var float
     */
    protected float $pgDmValueMax;


    /**
     * @var ConfiguratorClassConEntity|null
     */
    protected ?ConfiguratorClassConEntity $classCon;

    /**
     * @var ConfiguratorObjectEntity|null
     */
    protected ?ConfiguratorObjectEntity $objFrom;

    /**
     * @var ConfiguratorObjectEntity|null
     */
    protected ?ConfiguratorObjectEntity $objTo;


    use EntityIdTrait;

    public function getIdClsCon(): string
    {
        return $this->idClsCon;
    }

    public function setIdClsCon(string $idClsCon): void
    {
        $this->idClsCon = $idClsCon;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIdObjFrom(): string
    {
        return $this->idObjFrom;
    }

    public function setIdObjFrom(string $idObjFrom): void
    {
        $this->idObjFrom = $idObjFrom;
    }

    public function getIdObjTo(): string
    {
        return $this->idObjTo;
    }

    public function setIdObjTo(string $idObjTo): void
    {
        $this->idObjTo = $idObjTo;
    }


    public function getPgDmValueMin(): float
    {
        return $this->pgDmValueMin;
    }

    public function setPgDmValueMin(float $pgDmValueMin): void
    {
        $this->pgDmValueMin = $pgDmValueMin;
    }

    public function getPgDmValueMax(): float
    {
        return $this->pgDmValueMax;
    }

    public function setPgDmValueMax(float $pgDmValueMax): void
    {
        $this->pgDmValueMax = $pgDmValueMax;
    }

    /**
     * @return ConfiguratorClassConEntity|null
     */
    public function getClassCon(): ?ConfiguratorClassConEntity
    {
        return $this->classCon;
    }

    /**
     * @param ConfiguratorClassConEntity|null $classCon
     * @return void
     */
    public function setClassCon(?ConfiguratorClassConEntity $classCon): void
    {
        $this->classCon = $classCon;
    }

    /**
     * @return ConfiguratorObjectEntity|null
     */
    public function getObjFrom(): ?ConfiguratorObjectEntity
    {
        return $this->objFrom;
    }

    /**
     * @param ConfiguratorObjectEntity|null $objFrom
     * @return void
     */
    public function setObjFrom(?ConfiguratorObjectEntity $objFrom): void
    {
        $this->objFrom = $objFrom;
    }

    /**
     * @return ConfiguratorObjectEntity|null
     */
    public function getObjTo(): ?ConfiguratorObjectEntity
    {
        return $this->objTo;
    }

    /**
     * @param ConfiguratorObjectEntity|null $objTo
     * @return void
     */
    public function setObjTo(?ConfiguratorObjectEntity $objTo): void
    {
        $this->objTo = $objTo;
    }




//    /**
//     * @return string
//     */
//    public function getClassConName(): string
//    {
//        return $this->classCon ? $this->classCon->getName() : "";
//    }
}
