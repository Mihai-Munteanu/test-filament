<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Resources\Form;
use App\Models\ActiveListing;
use Filament\Resources\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Customers';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card::make()->schema([
                //     TextInput::make('account_status')->required(),
                //     TextInput::make('notification_email_1'),
                //     TextInput::make('notification_email_2'),
                // ])
            ]);
    }

    protected function getTableFilters(): array
    {
        return [
            // filter by account_status
            // SelectFilter::make('status')
            //     ->options([
            //         'internal' => 'Internal',
            //         'external' => 'External',
            //         'beta' => 'Beta',
            //     ])
            //     ->attribute('account_status'),

            // // filter period
            // Filter::make('created_at')
            //     ->form([
            //         DatePicker::make('from'),
            //         DatePicker::make('until'),
            //     ])
            //     ->attribute('date')
            // ->indicateUsing(function (array $data): array {
            //     $indicators = [];

            //     if ($data['from'] ?? null) {
            //         $indicators['from'] = 'Created from ' . Carbon::parse($data['from'])->toFormattedDateString();
            //     }

            //     if ($data['until'] ?? null) {
            //         $indicators['until'] = 'Created until ' . Carbon::parse($data['until'])->toFormattedDateString();
            //     }

            //     return $indicators;
            // }),
        ];
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_id')->sortable()->searchable(),
                // TextColumn::make('customer_id')->withSum('active_listings', 'number_of_guest_accounts')->sortable()->searchable(),
                // TextColumn::make('customer_id')
                // // ->sum('active_listings', 'customer_id')
                // ,
                TextColumn::make('date')->dateTime('Y-m-d')->sortable()->searchable(),
                // Model care sa aiba coloana customer_id, created_at, active_listings, platform_mecari, plat_ebay, plat_postmark nu este afectat de daterange
                // TextColumn::make('active_listings')->sortable(),
                TextColumn::make('activeListings.active_listing_mercari')->sortable()->label('Active Listings Mercari'),

                TextColumn::make('activeListings.active_listing_mercari')
                    ->getStateUsing(function (Model $record): float {
                        info('record: ' . collect($record->activeListingByDate));
                        return $record->activeListingByDate->active_listing_mercari + $record->activeListingByDate->active_listing_ebay + $record->activeListingByDate->active_listing_poshmark;
                    })->label('Active Listing Total'),



                // same as above (cel putin 2 platforme)
                TextColumn::make('cross_linked_active_listings')->sortable(),

                // same as above, on sales, aici merge date-range
                TextColumn::make('cross_linked_sales_count')->sortable(),

                // same as above, on sales, gross revenue
                TextColumn::make('cross_linked_sales_value')->sortable(),

                // same as above
                // TextColumn::make('all_sales_count')->sortable(),

                // TextColumn::make('all_sales_value')->sortable(),
                // TextColumn::make('treecat_revenue')->sortable(),
                // TextColumn::make('new_listings_downloaded_from_ecommerce_platforms')->sortable(),
                // TextColumn::make('successful_new_listing_count')->sortable(),
                // TextColumn::make('de_listing_fail_count')->sortable(),
                // TextColumn::make('de_listing_success_count')->sortable(),

                // TextColumn::make('notification_email_1')->sortable()->searchable(),
                // TextColumn::make('notification_email_2')->sortable()->searchable(),

                TextColumn::make('number_of_guest_accounts')->sortable(),


                TextColumn::make('account_status')->sortable(),
                TextColumn::make('customer_registration_date')->sortable()->dateTime('Y-m-d'),

                TextColumn::make('created_at')->sortable()->searchable()->dateTime('Y-m-d'),
            ])
            ->filters(
                [
                    // filter by account_status
                    SelectFilter::make('status')
                        ->options([
                            'internal' => 'Internal',
                            'external' => 'External',
                            'beta' => 'Beta',
                        ])
                        ->label('Status')
                        ->attribute('account_status'),
                    Filter::make('date')
                        ->form([
                            Forms\Components\DatePicker::make('created_from')
                                ->placeholder(fn ($state): string => now()->format('Y-m-d')),
                            Forms\Components\DatePicker::make('created_until')
                                ->placeholder(fn ($state): string => now()->format('M d, Y')),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['created_from'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                                )
                                ->when(
                                    $data['created_until'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                                );
                        })
                        ->indicateUsing(function (array $data): array {
                            $indicators = [];
                            if ($data['created_from'] ?? null) {
                                $indicators['created_from'] = 'Date from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                            }
                            if ($data['created_until'] ?? null) {
                                $indicators['created_until'] = 'Date until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                            }

                            return $indicators;
                        }),
                    SelectFilter::make('platform')
                        // ->multiple()
                        ->options([
                            'poshMark' => 'PoshMark',
                            'ebay' => 'E-Bay',
                            'mercari' => 'Mercari',
                        ]),

                    // ->query(fn (Builder $query): Builder => $query->where('name' <> '')),
                    // ->attribute('account_status'),
                    // Tables\Filters\Filter::make('verified')
                    // ->query(fn (Builder $query): Builder => $query->where('name' <> '')),
                ],
                // how filter are displayed
                // layout: Layout::AboveContent,
            )
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            // 'create' => Pages\CreateCustomer::route('/create'),
            // 'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
