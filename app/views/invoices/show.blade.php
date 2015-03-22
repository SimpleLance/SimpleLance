@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice # {{ $invoice->id }}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        {{ $invoice->owner->first_name.' '.$invoice->owner->last_name }}<br>
                        {{ $invoice->owner->address }}<br>
                        {{ $invoice->owner->city.', '.$invoice->owner->post_code }}<br>
                        {{ $invoice->owner->country }}
                    </address>
                </div>
                <div class="form-group col-xs-4">
                    <strong>Created date:</strong><br>
                    {{ $invoice->created_at->format('Y-m-d') }}
                </div>
                <div class="form-group col-xs-4">
                    <strong>Due date:</strong><br>
                    {{ $invoice->due }}
                </div>
                <div class="form-group col-xs-4">
                    <strong>Status:</strong><br>
                    {{ $invoice->status->title }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <form role="form" action="" method="post" name="invoice_item">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed" id="invoice_items">
                                <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">{{ number_format($item->price, 2, '.', ',') }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-right">{{ number_format($item->total, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Total:</strong></td>
                                    <td class="thick-line text-right">{{ number_format($invoice->amount, 2, '.', ',') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        {{ Form::open(array(
             'action' => array('InvoicesController@destroy', $invoice->id),
             'method' => 'delete',
             'class' => $invoice->id . '-delete',
             'id' => $invoice->id . '-delete',
             'name' => $invoice->id . '-delete',
             'role' => ''
             )) }}

        {{ Form::submit('Delete Invoice', ['class' => 'btn btn-danger', 'id' => 'delete-' . $invoice->id])}}
        {{ Form::close() }}
        <a href="/invoices{{ $invoice->id }}/send"  class="btn btn-primary">Send Invoice</a>
        <button id="edit-{{ $invoice->id }}" class="btn btn-primary" onClick="location.href='{{ action('InvoicesController@edit', array($invoice->id)) }}'">Edit Invoice</button>
    </div>
@stop