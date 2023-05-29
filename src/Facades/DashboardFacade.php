<?php

namespace Devpac\Dashboard\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class DashboardFacade
 * @package Devpac\Dashboard
 */
class DashboardFacade extends Facade
{
    /**
     * @return string
     */
    public static function dump()
    {
        dd('Dashboard');
    }
}