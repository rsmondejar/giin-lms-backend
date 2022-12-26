<?php

namespace App\Traits;

/**
 * Trait DataTableRender
 * @package App\Traits
 */
trait DataTableRender
{
    /**
     * Render Image
     * @param string|null $size
     * @return string
     */
    public static function renderImage(string $size = null): string
    {
        $classSize = "c-datatable-img-preview" . ((null !== $size) ? "--" . $size : "");

        return "'<a href=\"'+data+'\" title=\"zoom\" target=\"_blank\" class=\"c-datatable-img-preview__link\">" .
            "<img src=\"' +data+ '\" class=\"$classSize\" alt=\"zoom\" /></a>'";
    }

    /**
     * Render Font Awesome Icon
     * @return string
     */
    public static function renderFontAwesomeIcon(): string
    {
        return "'<i class=\"fa fa-fw fa-2x '+ data+'\"></i>'";
    }

    /**
     * Render URL
     * @param bool $icon
     * @return string
     */
    public static function renderUrl(bool $icon = false): string
    {
        if ($icon) {
            return "'<a href=\"'+data+'\" target=\"_blank\"><i class=\"fa fa-external-link fa-2x \"></a>'";
        } else {
            return "'<a href=\"'+data+'\" target=\"_blank\">' +data+ '</a>'";
        }
    }

    /**
     * Render Color
     * @return string
     */
    public static function renderColor(): string
    {
        return "'<span class=\"c-datatable-color-preview\"  style=\"background-color\:'+data+'\" >' +data+ '</span>'";
    }

    /**
     * Render Paragraph
     * @param int $height
     * @return string
     */
    public static function renderParagraph(int $height = 100): string
    {
        $maxHeight = "max-height: {$height}px;";

        return "'<div style=\"$maxHeight overflow: auto;\">' +data+ '</div>'";
    }

    /**
     * Render Checkbox
     * @return string
     */
    public static function renderCheckbox(): string
    {
        return "'<input type=\"checkbox\" class=\"js-datatable-checkbox\" value=\"'+data+'\" checked />'";
    }

    /**
     * Render Boolean
     * @return string
     */
    public static function boolean(): string
    {
        return "(1 === parseInt(data) || data === true) ? 'true' : 'false'";
    }

    /**
     * Render Boolean Yes or Not
     * @return string
     */
    public static function booleanYesOrNot(): string
    {
        return "(1 === parseInt(data) || data === true) ? 'Sí' : 'No'";
    }

    /**
     * Split
     * @param string $separator
     * @return string
     */
    public static function split($separator = ','): string
    {
        return "data.split('$separator').join('<br>')";
    }

    /**
     * Date To Format DMY
     * @return string
     */
    public static function dateToFormatDMY(): string
    {
        return "(null === data) ? '' : new Date(data).toLocaleDateString()";
    }

    /**
     * Date To Format YMD
     * @return string
     */
    public static function dateToFormatYMD(): string
    {
        return "(null === data) ? '' : new Date(data).toISOString().split('T')[0].replace(/-/g, '/')";
    }

    /**
     * Render Format Number Currency.
     *
     * @param string $locale Locale. Default 'de'
     * @param string $currency Currency. Default 'eur'
     * @return string Number converter
     */
    public static function renderFormatNumberCurrency(string $locale = 'de', string $currency = 'eur'): string
    {
        // Locale 'es' not include thousand separator if only has 4 digits. Example: 1000.12 doesnt work.
        return "(new Intl.NumberFormat('$locale', {style: 'currency', currency: '$currency', minimumFractionDigits: 2, maximumFractionDigits: 2})).format(data)"; // NOSONAR
    }

    /**
     * Format Number Currency
     * @param $number
     * @param string $decimals
     * @param string $decimalPoint
     * @param string $thousandsSeparator
     * @param bool $showCurrency
     * @return string
     */
    public static function formatNumberCurrency(
        $number,
        $decimals = '2',
        $decimalPoint = ',',
        $thousandsSeparator = '.',
        $showCurrency = true
    ): string {
        return number_format($number, $decimals, $decimalPoint, $thousandsSeparator) . ($showCurrency ? '€' : '');
    }
}
