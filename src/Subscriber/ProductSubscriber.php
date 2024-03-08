<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension\Subscriber;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Content\Product\ProductEvents;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Storefront\Page\Product\ProductPageCriteriaEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            ProductEvents::PRODUCT_LOADED_EVENT => 'onProductsLoaded',
            ProductPageCriteriaEvent::class => 'onProductPageCriteria'
        ];
    }

    public function onProductsLoaded(EntityLoadedEvent $event): void
    {
        /** @var ProductEntity $productEntity */
        foreach ($event->getEntities() as $productEntity) {
            $productEntity->addExtension('customExtension1', new ArrayEntity(['foo1' => 'bar1']));

        }
    }

    public function onProductPageCriteria(ProductPageCriteriaEvent $event): void
    {
        $event->getCriteria()->addAssociation('customExtension0');
    }
}
