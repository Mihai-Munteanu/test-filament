<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\CustomerTwo;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerTwoResource\Pages;
use App\Filament\Resources\CustomerTwoResource\RelationManagers;

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
                TextColumn::make('customer_id')->sortable()->searchable(),
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
