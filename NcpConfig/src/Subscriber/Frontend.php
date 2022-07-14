<?php declare(strict_types=1);

namespace NcpConfig\Subscriber;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Connection;
use NcpConfig\Struct\StructConfigurator;
use Shopware\Core\Content\Product\Aggregate\ProductMedia\ProductMediaCollection;
use Shopware\Core\Content\Product\Events\ProductListingResultEvent;
use Shopware\Core\Content\Product\ProductEvents;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Shopware\Storefront\Pagelet\Footer\FooterPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;


class Frontend implements EventSubscriberInterface
{
    /**
     * @var Connection
     */
    private Connection $connection;

    /**
     * @var SystemConfigService
     */
    private SystemConfigService $systemConfigService;

    /**
     * @var EntityRepositoryInterface
     */
    private EntityRepositoryInterface $repositoryClassCon;

    /**
     * @var EntityRepositoryInterface
     */
    private EntityRepositoryInterface $repositoryObjCon;

    /**
     * @var EntityRepositoryInterface
     */
    private EntityRepositoryInterface $repositoryProductMedia;

    /**
     * @var ProductMediaCollection
     */
    private ProductMediaCollection $media;


    /**
     * @var StructConfigurator
     */
    private StructConfigurator $structConfigurator;

    /**
     * @param Connection $connection
     * @param SystemConfigService $systemConfigService
     * @param EntityRepositoryInterface $repositoryClassCon
     * @param EntityRepositoryInterface $repositoryObjCon
     * @param EntityRepositoryInterface $repositoryProductMedia
     */
    public function __construct(
        Connection                $connection,
        SystemConfigService       $systemConfigService,
        EntityRepositoryInterface $repositoryClassCon,
        EntityRepositoryInterface $repositoryObjCon,
        EntityRepositoryInterface $repositoryProductMedia
    )
    {
        $this->connection = $connection;
        $this->systemConfigService = $systemConfigService;
        $this->repositoryClassCon = $repositoryClassCon;
        $this->repositoryObjCon = $repositoryObjCon;
        $this->repositoryProductMedia = $repositoryProductMedia;
        $this->structConfigurator = new structConfigurator();
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductPageLoadedEvent::class => 'onProductPageLoaded'
        ];
    }

    /**
     * @param ProductPageLoadedEvent $event
     *
     * @return void
     */
    public function onProductPageLoaded(ProductPageLoadedEvent $event)
    {
        $productId = $event->getPage()->getProduct()->getId();
        if ($productId == '') {
            return;
        }

        $productGroupId = $this->getProductGroupIdOfProduct($productId, $event->getContext());
        if ($productGroupId == '') {
            return;
        }

        $this->getObjConnections($productGroupId, $event->getContext());

        $event->getPage()->getProduct()->addExtension('structConfigurator', $this->structConfigurator);
    }

    private function getProductGroupIdOfProduct($productId, $context): string
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('idObjTo', $productId));
        $result = $this->repositoryObjCon->search($criteria, $context)->first();
        return $result ? $result->getIdObjFrom() : '';

//        $results = $this->repositoryObjCon->search($criteria, $context);
//        if ($results->count() == 0) {
//            return '';
//        } elseif ($results->count() == 1) {
//            foreach ($results as $result) {
//                return $result->getIdObjFrom();
//            }
//        }
//
//        return '';
    }

    private function getObjConnections($idObjFrom, $context): void
    {
        $criteria = new Criteria();
        $criteria->addAssociation('classCon');
        $criteria->addAssociation('objFrom');
        $criteria->addAssociation('objTo');
        $criteria->addAssociation('objFrom.class');
        $criteria->addAssociation('objTo.class');
        $criteria->addFilter(new EqualsFilter('idObjFrom', $idObjFrom));

        $result = $this->repositoryObjCon->search($criteria, $context);
        if ($result->getTotal() > 0) {
            foreach ($result as $item) {
                switch ($item->objFrom->class->name) {
                    case 'ProjectGroup':
                        $this->structConfigurator->projectGroupName = $item->objFrom->name;
                        break;
                }

                switch ($item->objTo->class->name) {
                    case 'Dimension':
                        if (!in_array($item->objTo->name, $this->structConfigurator->arrDimension)) {
                            $this->structConfigurator->arrDimension[$item->objTo->name] = [
//                                "name" => $item->objTo->name,
                                "pgDmValueMin" => $item->pgDmValueMin,
                                "pgDmValueMax" => $item->pgDmValueMax
                            ];
                        }
                        break;
                    case 'Product':
                        $this->structConfigurator->productName = $item->objTo->name;
                        break;
                }

                $this->getObjConnections($item->getIdObjTo(), $context);
            }
        }
    }
}
