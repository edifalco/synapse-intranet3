<?php

namespace App\Http\Controllers\Admin;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInvoicesRequest;
use App\Http\Requests\Admin\UpdateInvoicesRequest;

class InvoicesController extends Controller
{
    /**
     * Display a listing of Invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('invoice_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('invoice_delete')) {
                return abort(401);
            }
            $invoices = Invoice::onlyTrashed()->get();
        } else {
            $invoices = Invoice::all();
        }

        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating new Invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('invoice_create')) {
            return abort(401);
        }
        
        $expense_types = \App\ExpenseType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $meetings = \App\Meeting::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contingencies = \App\Contingency::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $providers = \App\Provider::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $service_types = \App\ServiceType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $pms = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $finances = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.invoices.create', compact('expense_types', 'meetings', 'contingencies', 'providers', 'service_types', 'pms', 'finances', 'users', 'projects', 'created_bies'));
    }

    /**
     * Store a newly created Invoice in storage.
     *
     * @param  \App\Http\Requests\StoreInvoicesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoicesRequest $request)
    {
        if (! Gate::allows('invoice_create')) {
            return abort(401);
        }
        $invoice = Invoice::create($request->all());



        return redirect()->route('admin.invoices.index');
    }


    /**
     * Show the form for editing Invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('invoice_edit')) {
            return abort(401);
        }
        
        $expense_types = \App\ExpenseType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $meetings = \App\Meeting::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contingencies = \App\Contingency::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $providers = \App\Provider::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $service_types = \App\ServiceType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $pms = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $finances = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $invoice = Invoice::findOrFail($id);

        return view('admin.invoices.edit', compact('invoice', 'expense_types', 'meetings', 'contingencies', 'providers', 'service_types', 'pms', 'finances', 'users', 'projects', 'created_bies'));
    }

    /**
     * Update Invoice in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoicesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoicesRequest $request, $id)
    {
        if (! Gate::allows('invoice_edit')) {
            return abort(401);
        }
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());



        return redirect()->route('admin.invoices.index');
    }


    /**
     * Display Invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('invoice_view')) {
            return abort(401);
        }
        $invoice = Invoice::findOrFail($id);

        return view('admin.invoices.show', compact('invoice'));
    }


    /**
     * Remove Invoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('invoice_delete')) {
            return abort(401);
        }
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('admin.invoices.index');
    }

    /**
     * Delete all selected Invoice at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('invoice_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Invoice::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Invoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('invoice_delete')) {
            return abort(401);
        }
        $invoice = Invoice::onlyTrashed()->findOrFail($id);
        $invoice->restore();

        return redirect()->route('admin.invoices.index');
    }

    /**
     * Permanently delete Invoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('invoice_delete')) {
            return abort(401);
        }
        $invoice = Invoice::onlyTrashed()->findOrFail($id);
        $invoice->forceDelete();

        return redirect()->route('admin.invoices.index');
    }
}
