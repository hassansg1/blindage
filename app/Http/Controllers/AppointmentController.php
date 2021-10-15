<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentBook;
use App\Parsers\AppointmentBookParser;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class AppointmentController extends BaseController
{
    protected $model;
    protected $route;
    protected $heading;
    protected $topHeading;

    public function __construct()
    {
        $this->model = new Appointment();
        $this->route = 'appointment';
        $this->heading = 'Appointment';
        \Illuminate\Support\Facades\View::share('top_heading', 'Appointment');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = AppointmentBookParser::parse();


        return response()->json([
            'status' => true,
            'items' => $data
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $data = $this->fetchData($this->model, $request);

        return response()->json([
            'status' => true,
            'html' => view($this->route . "/form_rows")
                ->with(['items' => $data['items'], 'data' => $data, 'route' => $this->route, 'heading' => $this->heading])->render(),
            'data' => $data
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view($this->route . "/create")
            ->with(['route' => $this->route, 'heading' => $this->heading]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->model->rules);
        $this->model->saveFormData($this->model, $request);

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * @param $item
     */
    public function show($item)
    {
        $item = $this->model->find($item);

        return view($this->route . '.view')->with(['route' => $this->route, 'item' => $item, 'heading' => $this->heading, 'clone' => $request->clone ?? null]);
    }

    /**
     * @param Request $request
     * @param $item
     * @return Application|Factory|View|\Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $item)
    {
        if ($item == 0) {
            if (is_array($request->item))
                $item = $this->model->find('id', $request->item);
        }
        $item = $this->model->find($item);


        if ($request->ajax) {
            return response()->json([
                'status' => true,
                'html' => view($this->route . '.edit_modal')->with(['route' => $this->route, 'item' => $item, 'clone' => $request->clone ?? null])->render()
            ]);
        } else
            return view($this->route . '.edit')->with(['route' => $this->route, 'item' => $item, 'heading' => $this->heading, 'clone' => $request->clone ?? null]);
    }

    /**
     * @param Request $request
     * @param $item
     */
    public function update(Request $request, $item)
    {
        $request->validate($this->model->rules);

        $item = $this->model->find($item);
        $this->model->saveFormData($item, $request);

        flashSuccess(getLang($this->heading . " Successfully Updated."));

        return redirect(route($this->route . ".index"));
    }

    /**
     * @param $item
     */
    public function destroy($item)
    {
        $item = $this->model->find($item);
        $item->delete();

        flashSuccess(getLang($this->heading . " Successfully Deleted."));

        return redirect(route($this->route . ".index"));
    }

    public function getBranchAppointments(Request $request)
    {
        $data  = AppointmentBookParser::parse($request);
        return response()->json([
            'status' => true,
            'items' => $data
        ]);
    }

    public function getAppointmentView(Request $request)
    {
        $data  = AppointmentBook::find($request->appointment_book_id);
        // dd($request->all());
        return response()->json([
            'status' => true,
            'html' => view('appointment_book.partials._appointmentView')->with(['data' => $data])->render()
        ]);
    }


}
