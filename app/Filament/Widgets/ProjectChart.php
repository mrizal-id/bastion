<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\PieChartWidget;

class ProjectChart extends PieChartWidget
{
    protected static ?string $heading = 'Komposisi Status Proyek';

    protected function getData(): array
    {
        $data = Project::groupBy('project_status')
            ->selectRaw('project_status, count(*) as total')
            ->pluck('total', 'project_status')
            ->toArray();

        return [
            'datasets' => [
                'label' => 'Projects',
                'data' => array_values($data),
                'backgroundColor' => ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'],
            ],
            'labels' => array_keys($data),
        ];
    }
}
