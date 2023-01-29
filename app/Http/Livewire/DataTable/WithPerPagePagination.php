<?php

namespace App\Http\Livewire\DataTable;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public $perPage = 10;
    public $perPageKey = 'perPage';

    public function mountWithPerPagePagination()
    {
        $this->perPage = session()->get($this->perPageKey, $this->perPage);
    }

    public function updatedPerPage($value)
    {
        session()->put($this->perPageKey, $value);
    }

    public function applyPagination($query, $perPage = null)
    {
        $perPage = $perPage ? $perPage : $this->perPage;

        return $query->paginate($perPage);
    }
}
