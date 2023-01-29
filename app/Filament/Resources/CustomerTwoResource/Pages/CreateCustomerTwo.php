<?php

namespace App\Filament\Resources\CustomerTwoResource\Pages;

use App\Filament\Resources\CustomerTwoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerTwo extends CreateRecord
{
    protected static string $resource = CustomerTwoResource::class;
}
