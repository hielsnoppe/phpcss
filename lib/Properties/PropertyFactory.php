<?php

namespace NielsHoppe\PHPCSS;

class PropertyFactory {

    public static $IDENT = array(
        /*
        // Background

        background-color
        background-image
        background-repeat
        background-attachment
        background-position
        background

        // Border

        border-width
        border-top-width
        border-right-width
        border-bottom-width
        border-left-width
        border-color
        border-top-color
        border-right-color
        border-bottom-color
        border-left-color
        border-style
        border-top-style
        border-right-style
        border-bottom-style
        border-left-style
        border
        border-top
        border-right
        border-bottom
        border-left

        // Outline

        outline-width
        outline-style
        outline-color
        outline

        // Color

        color
        opacity

        // Text

        text-align
        text-decoration
        text-indent
        text-transform
        line-height
        vertical-align
        letter-spacing
        word-spacing
        white-space
        direction

        // Font

        font-family
        font-style
        font-variant
        font-weight
        font-size
        font

        // Margin & Padding

        margin
        margin-top
        margin-right
        margin-bottom
        margin-left
        padding
        padding-top
        padding-right
        padding-bottom
        padding-left

        // List

        list-style-type
        list-style-image
        list-style-position
        list-style

        // Box Size

        width
        min-width
        max-width
        height
        min-height
        max-height

        // Visual formatting

        display
        position
        top
        right
        bottom
        left
        float
        clear
        z-index
        overflow
        clip
        visibility
        cursor

        // Table

        caption-side
        table-layout
        border-collapse
        border-spacing
        empty-cells

        // Generated content

        content
        quotes
        counter-reset
        counter-increment

        // Print

        page-break-before
        page-break-after
        page-break-inside
        orphans
        widows
        */
    );

    public static createProperty ($ident) {

        return new FooProperty();
    }
}

interface Property {

    public function acceptsValue ($value) {

    }
}

class WidthProperty implements Property {

    public function acceptsValue ($value) {

        if ($value instanceof "LengthValue") {

        }
        else if ($value instanceof "PercentageValue") {

        }
        else if ($value == 'auto' || $value == 'inherit') {

        }
        else {
            return false;
        }
    }
}
