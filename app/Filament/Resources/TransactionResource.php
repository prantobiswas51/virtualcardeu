<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Bank;
use App\Models\Card;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->label('User')
                ->options(User::pluck('name', 'id')), // adjust as needed

                Select::make('card_id')
                ->label('Card')
                ->options(Card::pluck('number', 'id')), // adjust as needed

                Select::make('bank_id')
                    ->label('Bank')
                    ->options(Bank::pluck('bank_name', 'id')), // adjust as needed

                Select::make('payment_method')->options([
                    'Paypal' => 'Paypal',
                    'Payeer' => 'Payeer',
                    'Crypto' => 'Crypto',
                    'Bank' => 'Bank',
                    'Card' => 'Card',
                ]),
                TextInput::make('payment_id'),
                TextInput::make('amount')->numeric(),
                TextInput::make('status'),
                TextInput::make('type')->default('Unknown'),
                TextInput::make('merchant')->label('Merchant (Ex-Amazon)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Owner'),
                TextColumn::make('card_id'),
                TextColumn::make('card.number')->label('Card Number'),
                TextColumn::make('bank_id'),
                TextColumn::make('payment_method'),
                TextColumn::make('amount'),
                TextColumn::make('status'),
                TextColumn::make('type'),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
