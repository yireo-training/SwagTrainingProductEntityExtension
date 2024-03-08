# SwagTrainingProductEntityExtension plugin

**Shopware plugin to illustrate how you can extend a product entity in various ways**

## Installation
```bash
bin/console plugin:install --activate SwagTrainingProductEntityExtension
```

## Proof of Concepts

### `customExtension0`: NOT IN THIS REPO
**An entity extension in a separate table, added to the entity via associations (`$criteria->addAssociation()`)**

This is supported by the core. You own data will reside in a separate table which is joined by the association.

### `customExtension1`: WORKING
**Simple array extension added via event observer `\SwagTraining\ProductEntityExtension\Subscriber\ProductSubscriber::onProductsLoaded**()`

This is supported by the core. Unfortunately, all of the data loading needs to happen by you, which leads to additional queries.

### `customExtension3`: NOT WORKING
**Array Extension field added via `\SwagTraining\ProductEntityExtension\Extension\Content\Product\ExampleExtension::extendFields()`**

This is supported by the core. Unfortunately, all of the data loading needs to happen by you, which leads to additional queries.

### `customExtension3`: WORKING
**A Product Entity Extension field added via `\SwagTraining\ProductEntityExtension\Extension\Content\Product\ExampleExtension::extendFields()` as a `Runtime` field.**

This is supported by the core. Unfortunately, all of the data loading needs to happen by you, which leads to additional queries.

### `customExtension4`: ALMOST WORKING
**A new class `ExtendedProductDefinition` extends the original core `ProductDefinition`, not by adding a simple service rewrite, but by adding a compiler pass. Next, the new definition also leads to a new entity class and new collection class. And the field is added directly to the `product` table with a migration**

This currently does not work, because data-loading is not happening for some reason.

However, this method is performant (like with associations) but totally hacky: Do not use this.

### `customExtension5`: REMOVED
**Decoration of `ProductDefinition`**

This is not working: The `Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition::$registry` is not initialized properly. Also, the constructor `EntityDefinition::__construct` is `final` so can't be extended.