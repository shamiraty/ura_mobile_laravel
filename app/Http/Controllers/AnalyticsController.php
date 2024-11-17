<?php

namespace App\Http\Controllers;

use App\Models\PersonNew;
use App\Models\PersonReset;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Fetch data for PersonNew
        $personNews = $this->getStatusByBranchAndDistrict(PersonNew::class);
        
        // Fetch data for PersonReset
        $personResets = $this->getStatusByBranchAndDistrict(PersonReset::class);

        // Prepare branch-level summary and overall summary
        $branchSummary = $this->getBranchSummary([$personNews, $personResets]);
        $overallSummary = $this->getOverallSummary($branchSummary);

        // Return data to the view
        return view('analytics.analytics', compact('personNews', 'personResets', 'branchSummary', 'overallSummary'));
    }

    private function getStatusByBranchAndDistrict($model)
    {
        $data = $model::with(['user.employee.district', 'user.employee.district.branch'])
            ->get()
            ->groupBy(function ($item) {
                $branch = $item->user->employee->district->branch ?? null;
                return $branch ? $branch->name : 'Unknown Branch';
            });

        $statusCount = [];

        foreach ($data as $branchName => $persons) {
            foreach ($persons as $person) {
                $district = $person->user->employee->district ?? null;
                $districtName = $district ? $district->name : 'Unknown District';
                $status = $person->status ? 'Active' : 'Inactive';

                if (!isset($statusCount[$branchName][$districtName][$status])) {
                    $statusCount[$branchName][$districtName][$status] = 0;
                }

                $statusCount[$branchName][$districtName][$status]++;
            }
        }

        return $statusCount;
    }

    private function getBranchSummary($dataSets)
    {
        $branchSummary = [];

        foreach ($dataSets as $dataSet) {
            foreach ($dataSet as $branchName => $districts) {
                if (!isset($branchSummary[$branchName])) {
                    $branchSummary[$branchName] = ['Active' => 0, 'Inactive' => 0];
                }

                foreach ($districts as $statuses) {
                    $branchSummary[$branchName]['Active'] += $statuses['Active'] ?? 0;
                    $branchSummary[$branchName]['Inactive'] += $statuses['Inactive'] ?? 0;
                }
            }
        }

        return $branchSummary;
    }

    private function getOverallSummary($branchSummary)
    {
        $overallSummary = ['Active' => 0, 'Inactive' => 0];

        foreach ($branchSummary as $statuses) {
            $overallSummary['Active'] += $statuses['Active'];
            $overallSummary['Inactive'] += $statuses['Inactive'];
        }

        return $overallSummary;
    }
}
