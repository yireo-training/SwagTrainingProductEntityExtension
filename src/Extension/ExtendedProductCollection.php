<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension\Extension;

use Shopware\Core\Content\Product\ProductCollection;

class ExtendedProductCollection extends ProductCollection
{
    protected function getExpectedClass(): string
    {
        return ExtendedProductEntity::class;
    }
}
