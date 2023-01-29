<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerTwoResource\Pages;
use App\Filament\Resources\CustomerTwoResource\RelationManagers;
use App\Models\CustomerTwo;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerTwoResource extends Resource
{
    protected static ?string $model = CustomerTwo::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static string $view = 'filament.resources.users.pages.list-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerTwos::route('/'),
            // 'create' => Pages\CreateCustomerTwo::route('/create'),
            // 'view' => Pages\ViewCustomerTwo::route('/{record}'),
            // 'edit' => Pages\EditCustomerTwo::route('/{record}/edit'),
        ];
    }
}
