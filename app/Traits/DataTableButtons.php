<?php

namespace App\Traits;

/**
 * Trait DataTableButtons
 * @package App\Traits
 */
trait DataTableButtons
{
    /** @var string Button CSS Default Style */
    protected static string $buttonsCSS = 'btn btn-default btn-sm no-corner';

    /**
     * Get Default Buttons
     * @return array
     */
    public static function defaultButtons(): array
    {
        return [
            ['extend' => 'export', 'className' => self::$buttonsCSS,],
            ['extend' => 'print', 'className' => self::$buttonsCSS,],
            ['extend' => 'reset', 'className' => self::$buttonsCSS,],
            ['extend' => 'reload', 'className' => self::$buttonsCSS,],
            ['extend' => 'colvis', 'className' => self::$buttonsCSS,],
        ];
    }
}
