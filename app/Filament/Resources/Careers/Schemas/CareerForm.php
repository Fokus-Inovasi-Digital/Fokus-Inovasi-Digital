<?php

namespace App\Filament\Resources\Careers\Schemas;

use App\Models\Career;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

class CareerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $slug = Str::slug($state);

                        $existingSlug = Career::where('slug', $slug)->first();

                        if ($existingSlug) {
                            $slug = $slug . '-' . uniqid();
                        }

                        $set('slug', $slug);
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->hint('Generated from the title automatically.')
                    ->required()->readOnly()->disabled()->dehydrated(true),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->default('
                                    <h3>Job Title</h3>
                                    <p>Provide a brief introduction to the job role.</p>
                                    
                                    <h3>Salary</h3>
                                    <p>Include salary details here (e.g., monthly, annual salary range, bonuses, etc.).</p>
                                    
                                    <h3>Requirements</h3>
                                    <ul>
                                        <li>Experience in the relevant field</li>
                                        <li>Relevant degree or certification</li>
                                        <li>Skills required for the position</li>
                                    </ul>
                                    
                                    <h3>Responsibilities</h3>
                                    <ul>
                                        <li>Managing daily tasks and reporting</li>
                                        <li>Collaborating with cross-functional teams</li>
                                        <li>Ensuring project deadlines are met</li>
                                        <li>Preparing and presenting reports to stakeholders</li>
                                    </ul>
                                    
                                    <h3>Benefits</h3>
                                    <ul>
                                        <li>Health and wellness programs</li>
                                        <li>Paid vacation and holidays</li>
                                        <li>Retirement savings plan</li>
                                    </ul>
                                    
                                    <h3>How to Apply</h3>
                                    <p>Please submit your resume and cover letter to <a href="mailto:hr@example.com">hr@example.com</a> with the subject line "Application for [Job Title]".</p>
                                ')
                    ->extraInputAttributes([
                        'style' => 'min-height: 200px; max-height: 500px; overflow-y: auto;',
                    ]),
                TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Select::make('work_type')
                    ->options([
                        'onsite' => 'Onsite',
                        'remote' => 'Remote',
                        'hybrid' => 'Hybrid',
                    ])->default('onsite')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required()
                    ->reactive(),
                Hidden::make('created_by')->dehydrated()->default(fn() => auth()->id()),
                Hidden::make('updated_by')->dehydrated()->default(fn() => auth()->id()),
            ]);
    }
}
