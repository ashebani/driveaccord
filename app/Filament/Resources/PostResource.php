<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\CategoryRelationManager;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')->relationship(
                'user',
                'name'
            )->preload()->required()->searchable(),
            Forms\Components\Select::make('category_id')->relationship(
                'category',
                'name'
            )->preload()->required(),
            Forms\Components\TextInput::make('title')->required()->maxLength(255),
            Forms\Components\TextInput::make('slug')->maxLength(255),
            Forms\Components\MarkdownEditor::make('description')->required()->maxLength(
                65535
            )->columnSpanFull(),
            //            Forms\Components\TextInput::make('solution_comment_id')->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')->numeric(),
            Tables\Columns\TextColumn::make('category.name'),
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('slug')->searchable()->toggleable(
                isToggledHiddenByDefault: true
            ),
            Tables\Columns\TextColumn::make('solution_comment_id')->numeric()->sortable(
            )->toggleable(
                isToggledHiddenByDefault: true
            ),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(
                isToggledHiddenByDefault: true
            ),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(
                isToggledHiddenByDefault: true
            ),
        ])->filters([//
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\ViewAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            CategoryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
