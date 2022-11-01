<?php

namespace App\Listeners;

use App\Events\EventsCompanyDeleted;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeletedEmployeesByCompany implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Evento para deletar a empresa e funcionarios dela, e salvar no log
     *
     * @param  EventsCompanyDeleted $event
     * @return void
     */
    public function handle(EventsCompanyDeleted $event): void
    {
        try {
            DB::beginTransaction();
            Company::destroy($event->companyId);
            Employee::where('company_id', $event->companyId)->delete();
            DB::commit();
            Log::info("Empresa {$event->companyId} e seus funcionarios foram deletados");
        } catch (\Throwable $e) {
            DB::commit();
            Log::info("Não foi possivel deletar a empresa {$event->companyId} e seus funcionarios. " . $e->getMessage());
        }
    }
}
