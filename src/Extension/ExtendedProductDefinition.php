<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension\Extension;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Inherited;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ExtendedProductDefinition extends ProductDefinition
{
    public function getEntityClass(): string
    {
        return ExtendedProductEntity::class;
    }

    public function getCollectionClass(): string
    {
        return ExtendedProductCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        $field = new StringField('custom_extension4', 'customExtension4');
        $field->addFlags(new ApiAware(), new Inherited());

        $fields = parent::defineFields();
        $fields->add($field);
        return $fields;
    }
}
