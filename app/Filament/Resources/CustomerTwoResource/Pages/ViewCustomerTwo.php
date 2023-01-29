<?php

namespace App\Filament\Resources\CustomerTwoResource\Pages;

use App\Filament\Resources\CustomerTwoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomerTwo extends ViewRecord
{
    protected static string $resource = CustomerTwoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
