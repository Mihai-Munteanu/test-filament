<?php

namespace App\Filament\Resources\CustomerTwoResource\Pages;

use App\Filament\Resources\CustomerTwoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerTwo extends EditRecord
{
    protected static string $resource = CustomerTwoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
