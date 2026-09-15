<?php

namespace Tests\Unit\Architecture;

use PHPUnit\Framework\TestCase;

class Psr4CriticalClassesTest extends TestCase
{
    public function test_ot_model_and_controller_are_psr4_loadable(): void
    {
        $this->assertTrue(class_exists(\App\Models\Ot::class));
        $this->assertTrue(class_exists(\App\Http\Controllers\OtController::class));
    }
}
