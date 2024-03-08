<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension;

use Shopware\Core\Framework\Plugin;
use SwagTraining\ProductEntityExtension\DependencyInjection\CustomPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SwagTrainingProductEntityExtension extends Plugin
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new CustomPass(), PassConfig::TYPE_BEFORE_REMOVING);
        parent::build($container);
    }
}
