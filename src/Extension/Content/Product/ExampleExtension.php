<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension\Extension\Content\Product;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Runtime;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\Struct\ArrayStruct;

class ExampleExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->addArrayExtension('customExtension2', ['foo2' => 'bar2']);
        $collection->addExtension('customExtension2', new ArrayStruct(['foo2' => 'bar2']));

        $collection->add(
            (new StringField('customExtension3', 'customExtension3'))->addFlags(new Runtime())
        );
    }

    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }

}
