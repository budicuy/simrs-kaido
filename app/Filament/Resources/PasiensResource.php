<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasiensResource\Pages;
use App\Filament\Resources\PasiensResource\RelationManagers;
use App\Models\Pasiens;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PasiensResource extends Resource
{
    protected static ?string $model = Pasiens::class;
    protected static ?string $modelLabel = 'Pasien';
    protected static ?string $pluralModelLabel = 'Pasien';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('rm')
                ->label('Rekam Medis')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nik')
                    ->label('Nomor Induk Kependudukan (NIK)')
                    ->required()
                    ->maxLength(16)
                    ->minLength(16)
                    ->numeric(),
                Forms\Components\TextInput::make('nama_pasien')
                    ->label('Nama Pasien')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DatePicker::make('tgl_lahir')
                    ->label('Tanggal Lahir')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\Select::make('agama')
                ->label('Agama')
                    ->required()
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Buddha' => 'Buddha',
                        'Konghucu' => 'Konghucu',
                        'Lainnya' => 'Lainnya',
                    ]),
                Forms\Components\Select::make('kabupaten')
                    ->label('Kabupaten/Kota')
                    ->required()
                    ->options([
                        'Kabupaten Balangan' => 'Kabupaten Balangan',
                        'Kabupaten Banjar' => 'Kabupaten Banjar',
                        'Kabupaten Barito Kuala' => 'Kabupaten Barito Kuala',
                        'Kabupaten Hulu Sungai Selatan' => 'Kabupaten Hulu Sungai Selatan',
                        'Kabupaten Hulu Sungai Tengah' => 'Kabupaten Hulu Sungai Tengah',
                        'Kabupaten Hulu Sungai Utara' => 'Kabupaten Hulu Sungai Utara',
                        'Kabupaten Kotabaru' => 'Kabupaten Kotabaru',
                        'Kabupaten Tabalong' => 'Kabupaten Tabalong',
                        'Kabupaten Tanah Bumbu' => 'Kabupaten Tanah Bumbu',
                        'Kabupaten Tanah Laut' => 'Kabupaten Tanah Laut',
                        'Kabupaten Tapin' => 'Kabupaten Tapin',
                        'Kota Banjarbaru' => 'Kota Banjarbaru',
                        'Kota Banjarmasin' => 'Kota Banjarmasin',
                        'Lainnya' => 'Lainnya',
                    ]),
                Forms\Components\TextInput::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('jns_kelamin')
                    ->label('Jenis Kelamin')
                    ->required()
                    ->options([
                        'pria' => 'Laki-Laki',
                        'perempuan' => 'Perempuan',
                    ]),
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('no_hp_pasien')
                    ->label('Nomor HP Pasien')
                    ->required()
                    ->maxLength(13)
                    ->minLength(11)
                    ->numeric(),
                Forms\Components\TextInput::make('email_pasien')
                    ->label('Email Pasien')
                    ->email()
                    ->required()
                    ->maxLength(48),
                Forms\Components\Select::make('gol_darah')
                    ->label('Golongan Darah')
                    ->required()
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                        '-' => 'Tidak diketahui',                        
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rm')
                    ->label('Rekam Medis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pasien')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->label('Tanggal Lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agama')
                    ->label('Agama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->label('Kabupaten/Kota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jns_kelamin')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn ($state) => $state === 'pria' ? 'Laki-Laki' : ($state === 'perempuan' ? 'Perempuan' : $state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp_pasien')
                    ->label('Nomor HP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_pasien')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gol_darah')
                    ->label('Golongan Darah')
                    ->searchable(),
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
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasiens::route('/create'),
            'edit' => Pages\EditPasiens::route('/{record}/edit'),
        ];
    }
}
