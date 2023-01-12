<?php

namespace App\Observers;

use App\Models\Audit;

class AuditObserver
{
    /** @var string Model Name */
    protected static string $modelName = '';

    protected function audit(string $event, array $data): void
    {
        Audit::create([
            'event' => $event,
            'model' => $this->getModelName(),
            'data' => $data,
        ]);
    }

    /**
     * @return string
     */
    public static function getModelName(): string
    {
        return self::$modelName;
    }

    /**
     * @param string $modelName
     */
    public static function setModelName(string $modelName): void
    {
        self::$modelName = $modelName;
    }
}
