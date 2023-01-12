<?php

namespace App\Http\Controllers;

use App\DataTables\AuditDataTable;
use App\Models\Audit;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;


class AuditController extends AppBaseController
{
    private const MODEL_NOT_FOUND = 'No se ha encontrado el registro a auditar';

    private const MODEL_NAME = 'Audit';


    /**
     * Display a listing of the Audit.
     * @param AuditDataTable $auditDataTable
     * @return mixed
     */
    public function index(AuditDataTable $auditDataTable): mixed
    {
        return $auditDataTable->render('audit.index');
    }


    /**
     * Display the specified Audit.
     * @param string $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(string $id): View|Factory|Redirector|RedirectResponse|Application
    {
        $audit = Audit::find($id);

        if (empty($audit)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('audit.index'));
        }

        return view('audit.show')->with('audit', $audit);
    }


    /**
     * Remove the specified Audit from storage.
     *
     * @param string $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(string $id): Redirector|RedirectResponse|Application
    {
        $audit = Audit::find($id);

        if (empty($audit)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('audit.index'));
        }

        $audit->delete();

        Flash::success(sprintf("%s eliminado correctamente.", self::MODEL_NAME));

        return redirect(route('audit.index'));
    }
}
