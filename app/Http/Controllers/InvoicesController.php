<?php namespace SimpleLance\Http\Controllers;

use Invoice;
use InvoiceItem;
use InvoiceStatus;
use SimpleLance\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use SimpleLance\Http\Requests\StoreInvoiceRequest;
use SimpleLance\Http\Requests\UpdateInvoiceRequest;
use SimpleLance\Http\Requests\StoreInvoiceItemRequest;

class InvoicesController extends Controller
{
    protected $invoice;

    public function __construct(Invoice $invoice, User $user, InvoiceStatus $status, InvoiceItem $item)
    {
        $this->invoice = $invoice;
        $this->user = $user;
        $this->status = $status;
        $this->items = $item;

        $this->beforeFilter('Sentinel\inGroup:Admins',
            [
                'only' => [
                    'create',
                    'destroy',
                    'update',
                    'edit'
                ]
            ]
        );
    }

    /**
     * Display a listing of the resource.
     * GET /invoices
     *
     * @return Response
     */
    public function index()
    {
        $invoices = $this->invoice->with('owner')->with('status')->paginate(10);

        return View::make('invoices.index')
                   ->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     * GET /invoices/create
     *
     * @return Response
     */
    public function create()
    {
        $owners = $this->user->getOwners();
        $statuses = $this->status->getStatuses();

        return View::make('invoices.create')
                   ->with('owners', $owners)
                   ->with('statuses', $statuses);
    }

    /**
     * Store a newly created resource in storage.
     * POST /invoices
     *
     * @param StoreInvoiceRequest $request
     * @return Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $input = Input::all();

        $input['status_id'] = 3;

        $invoice = $this->invoice->create($input);

        return Redirect::route('invoices.index')->with('message', [
            'class' => 'success',
            'text' => 'Invoice Created.'
        ]);
    }

    /**
     * Display the specified resource.
     * GET /invoices/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $thisInvoice = $this->invoice->with('owner')->with('status')->find($id);
        $items = $this->items->where('invoice_id', $id)->orderBy('updated_at', 'ASC')->get();

        return View::make('invoices.show')
            ->with('invoice', $thisInvoice)
            ->with('items', $items);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /invoices/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $thisInvoice = $this->invoice->find($id);
        $owners = $this->user->getOwners();
        $statues = $this->status->getStatuses();

        return View::make('invoices.edit')
                   ->with('invoice', $thisInvoice)
                   ->with('owners', $owners)
                   ->with('statuses', $statues);
    }

    /**
     * Update the specified resource in storage.
     * PUT /invoices/{id}
     *
     * @param UpdateInvoiceRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateInvoiceRequest $request, $id)
    {
        $input = Input::all();

        $invoice = $this->invoice->find($id);
        $invoice->due = $input['due'];
        $invoice->status_id = $input['status_id'];
        $invoice->owner_id = $input['owner_id'];

        $invoice->save();

        return Redirect::route('invoices.index')->with('message', [
            'class' => 'success',
            'text' => 'Invoice Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /invoices/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->invoice->destroy($id)) {
            $status = [
//				'success' => [
                    'class' => 'success',
                    'text' => 'Invoice Deleted'
//				]
            ];
        } else {
            $status = [
//				'error' => [
                    'class' => 'error',
                    'text' => 'Unable to Delete Invoice'
//				]
            ];
        }

        return Redirect::action('InvoicesController@index')->with($status);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function items($id)
    {
        $thisInvoice = $this->invoice->with('owner')->with('status')->find($id);
        $items = $this->items->where('invoice_id', $id)->orderBy('updated_at', 'ASC')->get();

        return View::make('invoices.items')
            ->with('invoice', $thisInvoice)
            ->with('items', $items);
    }

    /**
     * @param StoreInvoiceItemRequest $request
     * @param $id
     * @return mixed
     */
    public function storeItem(StoreInvoiceItemRequest $request, $id)
    {
        $input = Input::all();
        $input['invoice_id'] = $id;

        $this->items->create($input);

        $invoice = $this->invoice->find($id);
        $invoice->amount = $invoice->amount = $input['total'];
        $invoice->save();

        return Redirect::to('invoices/'.$id.'/items')->with('message', [
            'class' => 'success',
            'message' => 'Invoice Updated.'
        ]);
    }

    public function send($id)
    {
        $invoice = $this->invoice->find($id);
        $invoice->status_id = 1;
        $invoice->save();

        return Redirect::to('invoices')->with('message', [
            'class' => 'success',
            'message' => 'Invoice Sent.'
        ]);
    }
}
