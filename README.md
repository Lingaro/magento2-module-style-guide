Magento 2 Style Guide Module
============================

by [Orba](https://orba.co)

## 1. Introduction

This module was created to help Magento 2 developers in building consistent themes.

It adds the following page to the store: `/style_guide`. The Style Guide lists generic blocks, widgets and HTML elements. 
The idea is to style all these elements at first and then build specific theme pages on top of them.
The Style Guide is also a place for any custom element that was designed for a specific theme, like fancy sliders, accordions, etc.
Each item of the Style Guide is easily customizable thanks to DI and theme inheritance system.
It is very easy to add or remove an item from the Style Guide.

The library is open sourced. Feel free to contribute!

## 2. Installation

The recommended way to install this package is through [Composer](https://getcomposer.org/).

```
composer require orba/magento2-module-style-guide
```

## 3. Overview of Style Guide sections

The main component of Style Guide is section. Each section has a label and a PHTML template.
Section may have a view model if needed. Section may be marked as removed to not show it on Style Guide page.

Default sections are defined in `etc/frontend/di.xml` file as an argument of `Orba\StyleGuide\ViewModel\SectionBlocksProvider` type.

### 3.1. Layouts

This section provides links to exemplary pages, each set up with different page layout: 1column, 2columns-left, 2columns-right, 3columns.
Use them to style things like: breakpoints, columns widths, margins and paddings, sidebar blocks headings.

### 3.2. Colors

This section provides list of theme colors with nice visualizations.
Its purpose is to show developers in one place the main theme color palette.

### 3.3. Headings

This section provides HTML heading elements (h1, h2, h3, h4, h5, h6).
Don't hesitate to add custom headings if the design of the theme requires different style of same level headings on different pages.

### 3.4. Paragraph

This section provides HTML paragraph element (p).
Don't hesitate to add custom paragraphs if they were designed for global usage.

### 3.5. Unordered list

This section provides HTML unordered list elements (ul, li).
Don't hesitate to add custom unordered lists if they were designed for global usage.

### 3.5. Ordered list

This section provides HTML ordered list elements (ol, li).
Don't hesitate to add custom ordered lists if they were designed for global usage.

### 3.6. Links

This section provides HTML links (a).
Don't hesitate to add custom links if they were designed for global usage.

Remember to style hover, active, focus and visited states!

### 3.7. Buttons

This section provides HTML buttons (button).
Don't hesitate to add custom buttons if they were designed for global usage.

Remember to style hover, active, focus and visited states!

### 3.8. Form

This section provides HTML form elements (form, fieldset, legend, label, text input, password input, textarea, select, radio, checkbox, submit button).
Basic validation is added to the form. Each form input element is present also in disabled version.
Don't hesitate to add custom form elements if they were designed for global usage (eg. inputs in different sizes).

Remember to style validation error messages and inputs hover, active, focus and error states!

### 3.9. Tabs

This section provides native Magento tabs widget.
Don't hesitate to remove it, if your theme does not plan to use the widget, or change it to custom one.

### 3.10. Tabs

This section provides native Magento breadcrumbs block.

### 3.11. Tooltips

This section provides examples of native Magento tooltips.
Don't hesitate to remove it, if your theme does not plan to use tooltips, or change it to custom implementation / examples.

### 3.12. Messages

This section provides native Magento flash messages.

Watchout: There are some Magento modules that use different message HTML structure in their template files.
For consistency, in such cases you should override these templates and use standard HTML structure.

### 3.13. Pagination 

This section provides native Magento paginator.
Don't hesitate to remove it, if your theme does not plan to use paginators.

### 3.14. Popup

This section provides native Magento popup.
Don't hesitate to add custom popups if they were designed for global usage.

### 3.15. Colors

This section provides list of theme icons with their visualizations.
Its purpose is to show developers in one place the main theme icons palette.

## 4. Customizations

Style Guide module allows creating highly customizable style guides for your themes.
In this chapter customization techniques are presented.

### 4.1. Prerequisites

A custom module is required for creating custom style guides.
You can name it whatever you want, but the convention is to use your project's vendor name followed by "StyleGuide", eg. "ProjectVendor_StyleGuide".

Style Guide module relies heavily on Magento's DI system.
For the customizations you will need to create `etc/frontend/di.xml` file. Below you can find a boilerplate.

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\SectionBlocksProvider">
        <arguments>
            <argument name="sections" xsi:type="array">
            </argument>
        </arguments>
    </virtualType>
</config>
```

`Orba\StyleGuide\ViewModel\SectionBlocksProvider` is the main view model of style guide page.
All the customizations will be injected there.

The reason of defining `ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName` virtual type on top of this class is that thanks to that you can have different style guides defined for each theme used in the project.

To apply custom view model to specific theme you need to create the following layout XML file in your theme folder: `Orba_StyleGuide/layout/orba_style_guide_index_index.xml`.
Below you can find an example:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="orba.style_guide">
            <arguments>
                <argument name="view_model" xsi:type="object">ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName</argument>
            </arguments>
        </referenceBlock>
    </body>
</page>
```

You can find the default style guide configuration in Style Guide module's `etc/frontend/di.xml` file.

### 4.2. Adding new section

To add a new section to your theme's style guide you need to define it in `etc/frontend/di.xml` file and inject it into your custom sections view model.
Below you can find an example:

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <virtualType name="ProjectVendor\StyleGuide\Model\Section\YourSection" type="Orba\StyleGuide\Model\Section">
        <arguments>
            <argument name="title" xsi:type="string" translatable="true">Your section name</argument>
            <argument name="template" xsi:type="string">ProjectVendor_StyleGuide::section/your_section.phtml</argument>
            <!-- View model is optional. Add it only if you need to collect some data in section's template -->
            <argument name="viewModel" xsi:type="object">ProjectVendor\StyleGuide\ViewModel\YourSection</argument>
        </arguments>
    </virtualType>
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\SectionBlocksProvider">
        <arguments>
            <argument name="sections" xsi:type="array">
                <item name="your_section_code" xsi:type="object" sortOrder="100">ProjectVendor\StyleGuide\Model\Section\YourSection</item>
            </argument>
        </arguments>
    </virtualType>
</config>
```

Notice the "sortOrder" attribute of "sections" array. Thanks to it you can position your custom section towards already created sections.

When that's done, you need to create PHTML template file for your section, defined in DI XML file.
For our example it should be located at `view/frontend/teplates/section/your_section.phtml` of `ProjectVendor_StyleGuide` module.
Below you can find a boilerplate.

```php
<?php

declare(strict_types=1);

/** @var \Orba\StyleGuide\Block\Section $block */
/** @var \Magento\Framework\Escaper $escaper */
?>
<!-- Your code here -->
```

If you defined a view model for your section, of course you need to create it in your module.
Below you can find a boilerplate.

```php
<?php

declare(strict_types=1);

namespace ProjectVendor\StyleGuide\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class YourSection implements ArgumentInterface
{
    // Your code here
}
```

Clean the following caches to see your changes: config, full_page.

### 4.3. Removing a section

To remove a section from your theme's style guide you need to override it in your `etc/frontend/di.xml` file and inject the change into your custom sections view model.
Below you can find an example:

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <virtualType name="ProjectVendor\StyleGuide\Model\Section\Tooltips" type="Orba\StyleGuide\Model\Section\Tooltips">
        <arguments>
            <argument name="isRemoved" xsi:type="boolean">true</argument>
        </arguments>
    </virtualType>
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\SectionBlocksProvider">
        <arguments>
            <argument name="sections" xsi:type="array">
                <item name="tooltips" xsi:type="object">ProjectVendor\StyleGuide\Model\Section\Tooltips</item>
            </argument>
        </arguments>
    </virtualType>
</config>
```

Clean the following caches to see your changes: config, full_page.

### 4.4. Overriding existing section

To override existing section you simply need to override its template in your theme.

Clean the following caches to see your changes: full_page.

### 4.5. Changing existing section's position

To change existing section's position in your theme's style guide you need to change section's 'sortOrder' attribute in your `etc/frontend/di.xml` file.
Below you can find an example:

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\SectionBlocksProvider">
        <arguments>
            <argument name="sections" xsi:type="array">
                <item name="tooltips" xsi:type="object" sortOrder="123">Orba\StyleGuide\Model\Section\Tooltips</item>
            </argument>
        </arguments>
    </virtualType>
</config>
```

Clean the following caches to see your changes: config, full_page.

### 4.6. Adding a color to color palette

To add a color to your theme's style guide color palette, you need to create custom color provider in your `etc/frontend/di.xml` file, add a custom color item to it and inject the provider into your custom theme view model.
Below you can find an example.

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <!-- Colors -->
    <virtualType name="ProjectVendor\StyleGuide\Model\Color\YourThemeName\ColorName" type="Orba\StyleGuide\Model\Color">
        <arguments>
            <argument name="code" xsi:type="string">color_code</argument>
            <argument name="label" xsi:type="string" translatable="true">label for visualization</argument>
            <argument name="cssColor" xsi:type="string">#000000</argument>
        </arguments>
    </virtualType>
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\ColorsProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\ColorsProvider">
        <arguments>
            <argument name="colors" xsi:type="array">
                <item name="color_code" xsi:type="object">ProjectVendor\StyleGuide\Model\Color\YourThemeName\ColorName</item>
            </argument>
        </arguments>
    </virtualType>
    <virtualType name="ProjectVendor\StyleGuide\Model\Section\Colors\YourThemeName"
                 type="Orba\StyleGuide\Model\Section\Colors">
        <arguments>
            <argument name="viewModel" xsi:type="object">ProjectVendor\StyleGuide\ViewModel\ColorsProvider\YourThemeName</argument>
        </arguments>
    </virtualType>
    <!-- / Colors -->
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\SectionBlocksProvider">
        <arguments>
            <argument name="sections" xsi:type="array">
                <item name="colors" xsi:type="object">ProjectVendor\StyleGuide\Model\Section\Colors\YourThemeName</item>
            </argument>
        </arguments>
    </virtualType>
</config>
```

When that's done, you need to add some styles for your color visualization. Place the changes in `Orba_StyleGuide/web/css/source/_extend.less` file of your theme.
Below you can find a bolierplate.

```less
.style-guide-container {
  .style-guide-colors {
    .style-guide-color {
      &.style-guide-color-example {
        .style-guide-color-visualization {
          background-color: @color-color-name;
        }
      }
    }
  }
}
```

Remember to define `@color-color-name` in your theme's variables file.

Clean the following caches to see your changes: config, full_page.

### 4.7. Adding an icon to icons set

To add an icon to your theme's style guide icons set, you need to create custom icon provider in your `etc/frontend/di.xml` file, add a custom icon item to it and inject the provider into your custom theme view model.
Below you can find an example.

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <!-- Icons -->
    <virtualType name="ProjectVendor\StyleGuide\Model\Icon\YourThemeName\IconName" type="Orba\StyleGuide\Model\Icon">
    <arguments>
        <argument name="name" xsi:type="string">icon-name</argument>
        <argument name="cssClass" xsi:type="string">icon-css-class</argument>
    </arguments>
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\IconsProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\IconsProvider">
        <arguments>
            <argument name="icons" xsi:type="array">
                <item name="icon-name" xsi:type="object">ProjectVendor\StyleGuide\Model\Icon\YourThemeName\IconName</item>
            </argument>
        </arguments>
    </virtualType>
    <virtualType name="ProjectVendor\StyleGuide\Model\Section\Icons\YourThemeName"
                 type="Orba\StyleGuide\Model\Section\Icons">
        <arguments>
            <argument name="viewModel" xsi:type="object">ProjectVendor\StyleGuide\ViewModel\IconsProvider\YourThemeName</argument>
        </arguments>
    </virtualType>
    <!-- / Icons -->
    <virtualType name="ProjectVendor\StyleGuide\ViewModel\SectionBlocksProvider\YourThemeName"
                 type="Orba\StyleGuide\ViewModel\SectionBlocksProvider">
        <arguments>
            <argument name="sections" xsi:type="array">
                <item name="icons" xsi:type="object">ProjectVendor\StyleGuide\Model\Section\Icons\YourThemeName</item>
            </argument>
        </arguments>
    </virtualType>
</config>
```

Of course, you need to also add proper styling of `.icon-css-class` in your theme.

Clean the following caches to see your changes: config, full_page.

## 5. Magento versions supported

Currently Style Guide module supports the following Magento versions:

* 2.4.x