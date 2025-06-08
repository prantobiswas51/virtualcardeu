<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('bank_name'),
                Select::make('bank_location')->options([
                    'USA' => 'USA',
                    'England' => 'England',
                    'Japan' => 'Japan'
                ]),
                TextInput::make('account_holder_name'),
                Select::make('account_type')->options([
                    'Checking' => 'Checking',
                    // 'Savings' => 'Savings'
                ]),
                Select::make('currency')->options([
                    'USD' => 'USD',
                    'GBP' => 'GBP',
                    'EURO' => 'EURO'
                ]),
                TextInput::make('routing_number'),
                TextInput::make('bank_account_number'),
                TextInput::make('bic'),
                TextInput::make('iban'),
                TextInput::make('bank_balance'),
                TextInput::make('bank_short_code'),
                Select::make('status')->options([
                    'Active' => 'Active',
                    'Inactive' => 'Inactive',
                    'Expired' => 'Expired',
                ])->default('Inactive'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bank_name'),
                TextColumn::make('bank_location'),
                TextColumn::make('account_holder_name'),
                TextColumn::make('account_type'),
                TextColumn::make('routing_number'),
                TextColumn::make('bank_account_number'),
                TextColumn::make('bic'),
                TextColumn::make('iban'),
                TextColumn::make('bank_short_code'),
                TextColumn::make('status'),
                TextColumn::make('registered_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBanks::route('/'),
            'create' => Pages\CreateBank::route('/create'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }
}
