@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.income-category.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.income-category.fields.name')</th>
                            <td field-key='name'>{{ $income_category->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Income</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="income">
<table class="table table-bordered table-striped {{ count($incomes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income.fields.income-category')</th>
                        <th>@lang('global.income.fields.entry-date')</th>
                        <th>@lang('global.income.fields.amount')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($incomes) > 0)
            @foreach ($incomes as $income)
                <tr data-entry-id="{{ $income->id }}">
                    <td field-key='income_category'>{{ $income->income_category->name ?? '' }}</td>
                                <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                <td field-key='amount'>{{ $income->amount }}</td>
                                                                <td>
                                    @can('income_view')
                                    <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_edit')
                                    <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('income_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.incomes.destroy', $income->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.income_categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


