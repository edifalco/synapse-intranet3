<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class InvoiceTest extends DuskTestCase
{

    public function testCreateInvoice()
    {
        $admin = \App\User::find(1);
        $invoice = factory('App\Invoice')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $invoice) {
            $browser->loginAs($admin)
                ->visit(route('admin.invoices.index'))
                ->clickLink('Add new')
                ->select("project_id", $invoice->project_id)
                ->select("expense_type_id", $invoice->expense_type_id)
                ->select("meeting_id", $invoice->meeting_id)
                ->select("contingency_id", $invoice->contingency_id)
                ->type("due_date", $invoice->due_date)
                ->type("invoice_subtotal", $invoice->invoice_subtotal)
                ->type("invoice_taxes", $invoice->invoice_taxes)
                ->type("invoice_total", $invoice->invoice_total)
                ->type("budget_subtotal", $invoice->budget_subtotal)
                ->type("budget_taxes", $invoice->budget_taxes)
                ->type("budget_total", $invoice->budget_total)
                ->select("provider_id", $invoice->provider_id)
                ->select("service_type_id", $invoice->service_type_id)
                ->type("service", $invoice->service)
                ->type("selection_criteria", $invoice->selection_criteria)
                ->select("pm_id", $invoice->pm_id)
                ->press('Save')
                ->assertRouteIs('admin.invoices.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $invoice->project->name)
                ->assertSeeIn("tr:last-child td[field-key='expense_type']", $invoice->expense_type->name)
                ->assertSeeIn("tr:last-child td[field-key='meeting']", $invoice->meeting->name)
                ->assertSeeIn("tr:last-child td[field-key='contingency']", $invoice->contingency->name)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $invoice->due_date)
                ->assertSeeIn("tr:last-child td[field-key='provider']", $invoice->provider->name)
                ->assertSeeIn("tr:last-child td[field-key='pm']", $invoice->pm->name)
                ->logout();
        });
    }

    public function testEditInvoice()
    {
        $admin = \App\User::find(1);
        $invoice = factory('App\Invoice')->create();
        $invoice2 = factory('App\Invoice')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $invoice, $invoice2) {
            $browser->loginAs($admin)
                ->visit(route('admin.invoices.index'))
                ->click('tr[data-entry-id="' . $invoice->id . '"] .btn-info')
                ->select("project_id", $invoice2->project_id)
                ->select("expense_type_id", $invoice2->expense_type_id)
                ->select("meeting_id", $invoice2->meeting_id)
                ->select("contingency_id", $invoice2->contingency_id)
                ->type("due_date", $invoice2->due_date)
                ->type("invoice_subtotal", $invoice2->invoice_subtotal)
                ->type("invoice_taxes", $invoice2->invoice_taxes)
                ->type("invoice_total", $invoice2->invoice_total)
                ->type("budget_subtotal", $invoice2->budget_subtotal)
                ->type("budget_taxes", $invoice2->budget_taxes)
                ->type("budget_total", $invoice2->budget_total)
                ->select("provider_id", $invoice2->provider_id)
                ->select("service_type_id", $invoice2->service_type_id)
                ->type("service", $invoice2->service)
                ->type("selection_criteria", $invoice2->selection_criteria)
                ->select("pm_id", $invoice2->pm_id)
                ->press('Update')
                ->assertRouteIs('admin.invoices.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $invoice2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='expense_type']", $invoice2->expense_type->name)
                ->assertSeeIn("tr:last-child td[field-key='meeting']", $invoice2->meeting->name)
                ->assertSeeIn("tr:last-child td[field-key='contingency']", $invoice2->contingency->name)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $invoice2->due_date)
                ->assertSeeIn("tr:last-child td[field-key='provider']", $invoice2->provider->name)
                ->assertSeeIn("tr:last-child td[field-key='pm']", $invoice2->pm->name)
                ->logout();
        });
    }

    public function testShowInvoice()
    {
        $admin = \App\User::find(1);
        $invoice = factory('App\Invoice')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $invoice) {
            $browser->loginAs($admin)
                ->visit(route('admin.invoices.index'))
                ->click('tr[data-entry-id="' . $invoice->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='user']", $invoice->user->name)
                ->assertSeeIn("td[field-key='project']", $invoice->project->name)
                ->assertSeeIn("td[field-key='expense_type']", $invoice->expense_type->name)
                ->assertSeeIn("td[field-key='meeting']", $invoice->meeting->name)
                ->assertSeeIn("td[field-key='contingency']", $invoice->contingency->name)
                ->assertSeeIn("td[field-key='date']", $invoice->date)
                ->assertSeeIn("td[field-key='due_date']", $invoice->due_date)
                ->assertSeeIn("td[field-key='invoice_subtotal']", $invoice->invoice_subtotal)
                ->assertSeeIn("td[field-key='invoice_taxes']", $invoice->invoice_taxes)
                ->assertSeeIn("td[field-key='invoice_total']", $invoice->invoice_total)
                ->assertSeeIn("td[field-key='budget_subtotal']", $invoice->budget_subtotal)
                ->assertSeeIn("td[field-key='budget_taxes']", $invoice->budget_taxes)
                ->assertSeeIn("td[field-key='budget_total']", $invoice->budget_total)
                ->assertSeeIn("td[field-key='provider']", $invoice->provider->name)
                ->assertSeeIn("td[field-key='service_type']", $invoice->service_type->name)
                ->assertSeeIn("td[field-key='service']", $invoice->service)
                ->assertSeeIn("td[field-key='selection_criteria']", $invoice->selection_criteria)
                ->assertSeeIn("td[field-key='pm']", $invoice->pm->name)
                ->assertSeeIn("td[field-key='pm_approval_date']", $invoice->pm_approval_date)
                ->assertSeeIn("td[field-key='finance']", $invoice->finance->name)
                ->assertSeeIn("td[field-key='finance_approval_date']", $invoice->finance_approval_date)
                ->logout();
        });
    }

}
