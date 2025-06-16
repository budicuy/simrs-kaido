<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerawatResource\Pages;
use App\Filament\Resources\PerawatResource\RelationManagers;
use App\Models\Perawat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerawatResource extends Resource
{
    protected static ?string $model = Perawat::class;
    protected static ?string $modelLabel = 'Perawat';
    protected static ?string $pluralModelLabel = 'Perawat';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_perawat')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('no_hp_perawat')
                    ->required()
                    ->maxLength(13),
                Forms\Components\Select::make('id_user')
                ->relationship('user', 'name')
                    ->label('Pilih User')
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_perawat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp_perawat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListPerawats::route('/'),
            'create' => Pages\CreatePerawat::route('/create'),
            'edit' => Pages\EditPerawat::route('/{record}/edit'),
        ];
    }
}
