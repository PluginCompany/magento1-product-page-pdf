# Customizing PDF Templates

If you're looking to customize the Product PDFs even more, it's quite straightforward to edit the included .phtml templates by following the steps below.

## Default template locations

You can find the original PDF .phtml templates in the following directory:

```
app/design/frontend/base/default/template/plugincompany/productleaflet/pdf
```

## Copy template to your theme directory

To modify a template, it's recommended to copy it to your custom theme directory. That way it won't be overwritten when you update our extension.

If you'd for example like to modify the attributes table (additional information section), you can copy the following file:

```
app/design/frontend/base/default/template/plugincompany/productleaflet/pdf/content/attributes.phtml
```

To the following directory:

```
app/design/frontend/<your_package>/<your_theme>/template/plugincompany/productleaflet/pdf/content/attributes.phtml
```

Or if you'd for example like to modify the footer, you can copy the following file:

```
app/design/frontend/base/default/template/plugincompany/productleaflet/pdf/footer.phtml
```

To the following directory:

```
app/design/frontend/<your_package>/<your_theme>/template/plugincompany/productleaflet/pdf/footer.phtml
```

## Edit the template

Now you can edit the copy of the template file and for example add the product SKU in the template with the following code snippet:

```php
<?php echo $this->getProduct()->getSku(); ?>
```

---

[Documentation index](./README.md) · [README](../README.md) · [Online version](https://plugin.company/knowledge-base/docs/magento-product-page-pdf/user-manual/customizing-pdf-templates/)
