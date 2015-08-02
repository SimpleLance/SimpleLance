<?php namespace SimpleLance\Http\Controllers;

use Ticket;
use Project;
use Invoice;
use InvoiceItem;
use InvoiceStatus;
use Priority;
use SimpleLance\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class PrioritiesController extends Controller
{
    protected $priority;

    public function __construct(Priority $priority)
    {
        $this->priority = $priority;
    }

    /**
     * Display a listing of the resource.
     * GET /priorities
     *
     * @return Response
     */
    public function index()
    {
        $priorities = $this->priority->all();

        return View::make('priorities.index')
                   ->with('priorities', $priorities);
    }

    /**
     * Show the form for creating a new resource.
     * GET /priorities/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('priorities.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /priorities
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $rules = array(
            'title' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::route('priorities.create')
                ->withErrors($validator)
                ->withInput($input);
        } else {
            $priority = $this->priority->create($input);

            return Redirect::route('priorities.index')->with('success', [
                'class' => 'success',
                'text' => 'Priority Created.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /priorities/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $thisPriority = $this->priority->find($id);
        

        return View::make('priorities.edit')
                   ->with('priority', $thisPriority);
    }

    /**
     * Update the specified resource in storage.
     * PUT /priorities/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();

        $rules = array(
            'title' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::route('priorities.edit', $id)
                ->withErrors($validator)
                ->withInput($input);
        } else {
            $priority = $this->priority->find($id);
            $priority->title = $input['title'];

            $priority->save();

            return Redirect::route('priorities.index')->with('success', [
                'class' => 'success',
                'text' => 'Priority Updated.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /priorities/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->priority->destroy($id)) {
            $status = [
                'success' => [
                    'class' => 'success',
                    'text' => 'Priority Deleted'
                ]
            ];
        } else {
            $status = [
                'error' => [
                    'class' => 'error',
                    'text' => 'Unable to Delete Priority'
                ]
            ];
        }

        return Redirect::action('PrioritiesController@index')->with($status);
    }
}
