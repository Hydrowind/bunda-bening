<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class StudentResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Data Siswa';
    protected static ?string $modelLabel = 'Siswa';
    protected static ?string $pluralModelLabel = 'Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->label('NISN')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('name'),
                DatePicker::make('dob')->label('Tanggal Lahir'),
                FileUpload::make('avatar')
                        ->directory('uploads')
                        ->image()
                        ->label('Foto'),
                TextInput::make('address')->label('Alamat'),
                TextInput::make('disability_type')->label('Kebutuhan Khusus'),
                    
                Hidden::make('roles')
                    ->default(Role::where('name', 'student')->first()?->id),
                
                TextInput::make('classroom')->label('Kelas')
            ]);
    }

    public static function table(Table $table): Table
    {
        $actions = [
            Tables\Actions\ViewAction::make(),
        ];

        if (Auth::user()->hasAnyRole(['superadmin', 'admin', 'staff'])) {
            array_push($actions, Tables\Actions\EditAction::make());
        }

        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();
                
                
                $studentRole = Role::where('name', 'student')->first();
                if ($studentRole) {
                    $query->whereHas('roles', function ($q) use ($studentRole) {
                        $q->where('role_id', $studentRole->id);
                    });
                }

                if($user->hasRole('teacher')){
                    $query->where('classroom', '=', $user->classroom);
                }

                return $query;

            })
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('name')->sortable(),
                TextColumn::make('dob')->sortable()->date()->label('Tanggal Lahir'),
                ImageColumn::make('avatar')->label('Foto')->circular()
                    ->defaultImageUrl(Storage::url('uploads/no-image.jpg')),
                TextColumn::make('address')->sortable()->label('Alamat'),
                TextColumn::make('disability_type')->sortable()->label('Disabilitas')
                    ->hidden(Auth::user()->hasRole('staff')),
                TextColumn::make('classroom')->sortable()->label('Kelas')
                    ->hidden(Auth::user()->hasRole('staff')),
            ])
            ->filters([
                //
            ])
            ->actions($actions)
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['teacher', 'staff', 'admin', 'superadmin']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['staff', 'admin', 'superadmin']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasAnyRole(['staff', 'admin', 'superadmin']);
    }
}
