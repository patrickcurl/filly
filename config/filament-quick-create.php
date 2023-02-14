<?php declare(strict_types=1);

use App\Filament\Resources\Organizations\OrganizationResource;

return [
    'exclude' => [
        // UserResource::class
        OrganizationResource::class,
    ],
];
