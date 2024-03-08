<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension\Extension;

use Shopware\Core\Content\Product\ProductEntity;

class ExtendedProductEntity extends ProductEntity
{
    protected $customExtension4;

    public function getCustomExtension4(): ?string
    {
        return $this->customExtension4;
    }

    public function setCustomExtension4(string $customExtension4): void
    {
        $this->customExtension4 = $customExtension4;
    }
}
