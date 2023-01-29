<?php

namespace App\Filament\Resources\CustomerTwoResource\Pages;

use App\Filament\Resources\CustomerTwoResource;
use Filament\Forms\Components\View;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerTwos extends ListRecords
{
    protected static string $resource = CustomerTwoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    // override the view page
    protected function getViewPage()
    {
        return view('livewire.customer-three');
    }
}
