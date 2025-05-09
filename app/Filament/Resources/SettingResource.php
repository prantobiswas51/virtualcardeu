<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Setting;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\SettingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SettingResource\RelationManagers;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('paypal_client_id')->label('PayPal Client ID'),
                TextInput::make('paypal_secret')->label('PayPal Secret'),
                TextInput::make('paypal_merchant_id')->label('Paypal Merchant ID'),

                TextInput::make('paypal_client_id_demo')->label('Paypal Sanbox Client Id'),
                TextInput::make('paypal_secret_demo')->label('Paypal Sanbox Secret'),
                TextInput::make('paypal_merchant_id_demo')->label('Paypal Sanbox Merchant Id'),

                Toggle::make('paypal_mode')->label('Is Live'),

                TextInput::make('deposit_fee')->label('Deposit Fee')->default(0),
                TextInput::make('withdrawal_fee')->label('Deposit Fee')->default(0),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('paypal_client_id'),
                TextColumn::make('paypal_secret'),
                TextColumn::make('paypal_merchant_id'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
