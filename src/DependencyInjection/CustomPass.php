<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension\DependencyInjection;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Content\Product\ProductEntity;
use SwagTraining\ProductEntityExtension\Extension\ExtendedProductDefinition;
use SwagTraining\ProductEntityExtension\Extension\ExtendedProductEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CustomPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $productDefinition = $container->getDefinition(ProductDefinition::class);
        $productDefinition->setClass(ExtendedProductDefinition::class);
    }
}
