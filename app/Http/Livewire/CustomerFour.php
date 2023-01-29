<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use App\Models\CustomerStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class CustomerFour extends Component
{
    use WithPagination;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;


    public $filters = [
        'search' => '',
        'platforms' => [],
        'dateStart' => '',
        'dateEnd' => '',
    ];


    public function updated($field, $value)
    {
        info('filed: ' . collect($field));
        info('value: ' . collect($value));
    }

    public function updatedFiltersPlatforms($field, $value)
    {
        info('filed22: ' . collect($field));
        info('value22: ' . collect($value));
    }

    public function getRowsQueryProperty()
    {
        // $query = Customer::selectRaw('
        //     customers.id,
        //     customers.customer_id,
        //     customers.date,
        //     active_listings.id as activeListingId,
        //     SUM(al.active_listing) AS total
        // ')

        // MAX(customer_statuses.name) AS customer_status,
        // customer_statuses.name AS customer_status,
        // LAST(customers.customer_status_id) AS customer_status_id,

        // LAST(customers.customer_status_id) AS customer_status_id,
        $query =
            DB::table('customers as c')
            ->select(DB::raw('SUM(al.active_listing) as total_active_listing,
                c.customer_id,
                (SELECT customer_statuses.name FROM customer_statuses
                    JOIN customers ON
                        customers.customer_status_id = customer_statuses.id
                    WHERE customers.id = max(c.id)
                    ORDER BY customers.id DESC LIMIT 1)
                    as statusName'))
            ->join('active_listings as al', 'c.id', '=', 'al.customer_id')
            ->join('customer_statuses as cs', 'c.customer_status_id', '=', 'cs.id')
            ->groupBy('c.customer_id')


            // DB::table('customers as c')
            // ->select(DB::raw('SUM(al.active_listing) as total_active_listing, c.customer_id,
            //     (SELECT customer_statuses.name
            //     FROM customer_statuses
            //     JOIN customers ON customers.customer_status_id = customer_statuses.id
            //     WHERE customers.id = MAX(c.id)
            //     ORDER BY customers.id DESC
            //     LIMIT 1) AS statusName'))
            // ->join('active_listings as al', 'c.id', '=', 'al.customer_id')
            // ->join('customer_statuses as cs', 'c.customer_status_id', '=', 'cs.id')
            // ->whereIn('al.platform', ['mercari', 'ebay', 'poshmark'])
            // ->whereBetween('al.date', ['2023-02-04', '2023-02-05'])
            // ->groupBy('c.customer_id')

            // DB::table('customers as c')
            // ->select(
            //     'c.customer_id',
            //     DB::raw('SUM(al.active_listing) as total_active_listing'),
            //     DB::raw("(SELECT customer_statuses.name FROM customer_statuses JOIN customers ON customers.customer_status_id = customer_statuses.id WHERE customers.customer_id = c.customer_id ORDER BY customers.id DESC LIMIT 1) as statusName")
            // )
            // ->leftJoin('active_listings as al', 'c.id', '=', 'al.customer_id')
            // ->leftJoin('customer_statuses as cs', 'c.customer_status_id', '=', 'cs.id')
            // ->groupBy('c.customer_id')







            //     Customer::selectRaw('
            //     customers.customer_id,
            //     SUM(active_listings.active_listing) AS total_active_listing

            // ')
            //     ->addSelect([
            //         'statusName' => CustomerStatus::select('name')
            //             ->whereColumn('id', 'customers.customer_status_id')
            //             ->orderByDesc('customers.id')
            //             ->limit(1)
            //     ])
            //     ->leftJoin('active_listings', 'customers.id', 'active_listings.customer_id')
            //     ->groupBy('customers.customer_id')





            //     Customer::selectRaw('
            //     customers.customer_id,
            //     customer_statuses.name as customerStatusName,
            //     SUM(active_listings.active_listing) AS total_active_listing
            // ')
            //     ->leftJoin('active_listings', 'customers.id', 'active_listings.customer_id')
            //     // ->leftJoin('customer_statuses', 'customers.customer_status_id', 'customer_statuses.id')
            //     ->leftJoin('customer_statuses', function ($join) {
            //         $join->on('customers.customer_status_id', '=', 'customer_statuses.id')
            //             ->orderBy('customer_statuses.id', 'desc')
            //             ->limit(1);
            //     })
            // ->with('status')
            // ->groupBy('customers.customer_id')
            ->when($this->filters['platforms'], function ($query, $platform) {
                $query->whereIn('al.platform', $platform);
            })
            ->when($this->filters['dateStart'], function ($query, $date) {
                $query->where('al.date', '>=', $date);
            })
            ->when($this->filters['dateEnd'], function ($query, $date) {
                $query->where('al.date', '<=', $date);
            })
            // ->leftJoin('programs', 'plannings.program_id', 'programs.id')
            // ->leftJoin('areas', 'plannings.areable_id', 'areas.id')
            // ->leftJoin('teams', 'plannings.team_id', 'teams.id')
            // ->leftJoin('tools', 'plannings.tool_id', 'tools.id')
            // ->leftJoin('employee_history_for_sudit_programs', 'plannings.driver_id', 'employee_history_for_sudit_programs.id')
            // ->leftJoin('employees', 'employee_history_for_sudit_programs.employee_id', 'employees.id')
            // ->when($this->directionId, function ($query) {
            //     $query->whereIn(
            //         'plannings.department_id',
            //         Department::whereDirectionId($this->directionId)->pluck('id')
            //     );
            // })->when(!collect(config('client.globalAccessRoles'))->contains(auth()->user()->role_id), function ($query) {
            //     $query->whereIn(
            //         'plannings.department_id',
            //         Department::whereDirectionId($this->directionId)->pluck('id')
            //     );
            // })->when($this->departmentId, function ($query) {
            //     $query->where('plannings.department_id', $this->departmentId);
            // })->when($this->filters['shift'], function ($query) {
            //     $query->where('plannings.shift', $this->filters['shift']);
            // })->when($this->filters['search'], function ($query, $search) {
            //     $query->where('plannings.name', 'like', '%' . $search . '%');
            // })->when($this->filters['date'], function ($query) {
            //     $query->where('plannings.date', Carbon::parse($this->filters['date'])->format('Y-m-d'));
            //     $this->init();
            // })
        ;

        $this->applySorting($query);

        if (empty($this->sorts)) {
            return $query->orderBy('c.customer_id', 'desc');
        }

        return $query;
    }


    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.customer-four', [
            'customers' => $this->rows,
        ]);
    }
}
