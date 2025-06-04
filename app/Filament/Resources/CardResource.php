<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Filament\Resources\CardResource\RelationManagers;
use App\Models\Card;
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

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')->maxLength(30)->unique()->visibleOn('create'),
                TextInput::make('expiry_date')->maxLength(10),
                Select::make('type')->options([
                    'Reloadable Mastercard' => 'Reloadable Mastercard',
                    'One Time Mastercard' => 'One Time Mastercard',
                    'Reloadable Visa' => 'Reloadable Visa',
                    'One Time Visa' => 'One Time Visa',
                ]),
                TextInput::make('cvc')->numeric()->maxLength(3),
                TextInput::make('amount')->numeric(),
                TextInput::make('status')->default('Inactive'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')->searchable(),
                TextColumn::make('expiry_date'),
                TextColumn::make('type')->searchable(),
                TextColumn::make('cvc'),
                TextColumn::make('amount'),
                TextColumn::make('status'),
                TextColumn::make('user.name')->label('Owner'),
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
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }
}
