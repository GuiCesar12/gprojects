<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/administrator/users/actions/*',
        '/administrator/sizes/actions/*',
        '/administrator/contacts/actions/*',
        '/administrator/products/actions/*',
        '/administrator/customers/actions/*',
        '/administrator/status/actions/*',
        '/projects/projects/actions/*',
        '/projects/notes/actions/*',
        '/projects/checklists/actions/*',
        '/managers/dashboards/actions/*',
        '/managers/reports/actions/*',
    ];
}
