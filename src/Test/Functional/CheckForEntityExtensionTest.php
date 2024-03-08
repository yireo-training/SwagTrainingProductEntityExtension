<?php declare(strict_types=1);

namespace SwagTraining\ProductEntityExtension\Test\Functional;

use Doctrine\DBAL\Connection;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\Struct\ArrayEntity;
use SwagTraining\ProductEntityExtension\Extension\ExtendedProductDefinition;
use SwagTraining\ProductEntityExtension\Extension\ExtendedProductEntity;
use Yireo\IntegrationTestHelper\Test\Functional\AbstractTestCase;
use Yireo\IntegrationTestHelper\Test\Functional\Traits\AssertBundleIsInstalled;

class CheckForEntityExtensionTest extends AbstractTestCase
{
    use AssertBundleIsInstalled;

    public function getPluginName(): string
    {
        return 'SwagTrainingProductEntityExtension';
    }

    public function testBasics()
    {
        $this->assertBundleIsInstalled();
    }

    public function testArrayExtensionWithProductLoadedEvent()
    {
        $product = $this->getAnyProduct();
        $this->assertTrue($product->hasExtension('customExtension1'));
        $this->assertInstanceOf(ArrayEntity::class, $product->getExtension('customExtension1'));
        $this->assertEquals('bar1', $product->getExtension('customExtension1')['foo1']);
    }

    public function testEntityExtensionWithRuntimeField()
    {
        /** @var ProductDefinition $productDefinition */
        $productDefinition = $this->getContainer()->get(ProductDefinition::class);
        $extensionFields = $productDefinition->getExtensionFields();
        $message = 'Current extension fields: '.implode(', ', array_keys($extensionFields));
        $this->assertArrayHasKey('customExtension3', $extensionFields, $message);
    }

    public function testAdditionalFieldInProductTable()
    {
        /** @var Connection $connection */
        $connection = $this->getContainer()->get(Connection::class);
        $columns = $connection->createSchemaManager()->listTableColumns('product');
        $this->assertArrayHasKey('custom_extension4', $columns);

        /** @var ExtendedProductDefinition $productDefinition */
        $productDefinition = $this->getContainer()->get(ProductDefinition::class);
        $fields = $productDefinition->getFields();
        $this->assertTrue($fields->has('customExtension4'));

        $product = $this->getAnyProduct();
        $this->assertInstanceOf(ExtendedProductEntity::class, $product);

        $this->assertTrue($product->has('customExtension4'), 'Product property is not found');

        $this->assertEquals('foobar4=4', $product->get('customExtension4'));
    }

    public function testAssocationWithProductLoadedEvent()
    {
        /** @var ProductDefinition $productDefinition */
        $productDefinition = $this->getContainer()->get(ProductDefinition::class);
        ///$productDefinition->get

        $product = $this->getAnyProduct();
        $this->assertTrue($product->hasExtension('customExtension2'));
    }

}