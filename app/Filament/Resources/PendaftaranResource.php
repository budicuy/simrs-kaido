<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Filament\Resources\PendaftaranResource\RelationManagers;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Perawat;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;
    protected static ?string $modelLabel = 'Pendaftaran';
    protected static ?string $pluralModelLabel = 'Pendaftaran';
    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('rm')
                ->relationship('pasien', 'nama_pasien')
                ->label('Nama Pasien')
                ->required()
                ->searchable(),
            Forms\Components\Select::make('id_poli')
                ->relationship('poli', 'nama_poli')
                ->label('Poliklinik')
                ->required()
                ->searchable(),
            Forms\Components\DatePicker::make('tgl_kunjungan')
                ->label('Tanggal Kunjungan')
                ->required(),
            Forms\Components\TextInput::make('no_antrian')
                ->label('Nomor Antrian')
                ->numeric()
                ->required(),
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'Menunggu' => 'Menunggu',
                    'Dilayani' => 'Dilayani',
                    'Proses' => 'Proses',
                    'Selesai' => 'Selesai',
                ])
                ->required(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->modifyQueryUsing(function (Builder $query) {
            $user = Auth::user();

            // Filter untuk role Dokter
            if ($user->hasRole('Dokter')) {
            $query->whereHas('poli.dokter.user', function ($q) use ($user) {
                $q->where('name', $user->name);
            });
            }

            // Filter untuk role Perawat
            if ($user->hasRole('Perawat')) {
            $query->whereHas('poli.perawat.user', function ($q) use ($user) {
                $q->where('name', $user->name);
            });
            }

            // Untuk role lain, tidak ada filter tambahan
            return $query;
        })
        ->columns([
            Tables\Columns\TextColumn::make('pasien.nama_pasien')->label('Nama Pasien'),
            Tables\Columns\TextColumn::make('poli.nama_poli')->label('Poliklinik'),
            Tables\Columns\TextColumn::make('poli.dokter.nama_dokter')->label('Nama Dokter'),
            Tables\Columns\TextColumn::make('tgl_kunjungan')->date()->label('Tanggal Kunjungan'),
            Tables\Columns\TextColumn::make('no_antrian')->label('Nomor Antrian'),
            Tables\Columns\TextColumn::make('status')->label('Status'),
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
        // ... (sisanya tetap)
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
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
