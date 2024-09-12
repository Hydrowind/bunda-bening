<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Staff & Guru';

    protected static ?string $modelLabel = 'Anggota';

    protected static ?string $pluralModelLabel = 'Anggota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('email')->email(),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state)),
                DatePicker::make('dob')->label('Tanggal Lahir'),
                TextInput::make('address')->label('Alamat'),
                TextInput::make('disability_type')->label('Kebutuhan Khusus'),
                TextInput::make('classroom')->label('Kelas'),
                Select::make('roles')
                    ->options([
                        'staff' => 'Staff',
                        'teacher' => 'Guru',
                        'student' => 'Siswa',
                    ]),
                    
                    // ->saveRelationshipsUsing(function (Model $record, $state){
                    //     $record->assignRole('admin');
                    // })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();
                
                if ($user->hasRole('teacher')) { 
                    $studentRole = Role::where('name', 'student')->first();
                    if ($studentRole) {
                        $query->whereHas('roles', function ($q) use ($studentRole) {
                            $q->where('role_id', $studentRole->id);
                        });
                    }

                    $query->where('classroom', $user->classroom);
                }

                if ($user->hasRole('staff')) {
                    $roles = Role::whereIn('name', ['student', 'staff', 'teacher'])->pluck('id');

                    $query->whereHas('roles', function ($q) use ($roles) {
                        $q->whereIn('role_id', $roles);
                    });
                }

                if ($user->hasRole('admin')) {
                    // Get the role IDs for 'student' and 'staff'
                    $roles = Role::whereIn('name', ['student', 'staff'])->pluck('id');

                    // Filter users with either 'student' or 'staff' roles
                    $query->whereHas('roles', function ($q) use ($roles) {
                        $q->whereIn('role_id', $roles);
                    });
                }

                return $query;

            })
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('name')->sortable(),
                TextColumn::make('email')->sortable()->copyable(),
                TextColumn::make('dob')->sortable()->date()->label('Tanggal Lahir'),
                TextColumn::make('address')->sortable()->label('Alamat'),
                TextColumn::make('disability_type')->sortable()->label('Disabilitas'),
                TextColumn::make('classroom')->sortable()->label('Kelas'),
                TextColumn::make('roles.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        if(Auth::user()->hasRole(['admin', 'staff', 'superadmin'])) {
            return 'Staff & Guru';
        } else if(Auth::user()->hasRole('teacher')) {
            return 'Siswa';
        }
    }
}
