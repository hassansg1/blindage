<?php

namespace App\Http\Controllers;

use App\Models\AppointmentBook;
use App\Models\AppointmentType;
use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AppointmentBookController extends BaseController
{
    protected $model;
    protected $route;
    protected $heading;
    protected $topHeading;

    public function __construct()
    {
        $this->model = new AppointmentBook();
        $this->route = 'appointment_book';
        $this->heading = 'AppointmentBook';
        \Illuminate\Support\Facades\View::share('top_heading', 'AppointmentBook');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->fetchData($this->model);
        return view($this->route . "/index")
            ->with(['items' => $data['items'], 'data' => $data, 'route' => $this->route, 'heading' => $this->heading]);
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
        if (isset($request->appointment_book_id)) {
            $item = $this->model->find($request->appointment_book_id);
        } else
            $item = $this->model;
        $result = $this->model->saveFormData($item, $request);

        return response()->json([
            'status' => true,
            'id' => $result->id
        ]);
    }

    public function create_new_store(Request $request)
    {
        $request->validate($this->model->rules);
        $item = $this->model;
        $result = $this->model->saveFormData_create_new_schedule($item, $request);

        return response()->json([
            'status' => $result
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

    public function cancalAppointment(Request $request)
    {

        // $result = $this->model->deleteAppointment($request);
        $result = $this->model->cancelAppointment($request);
        if ($result) {
            flashSuccess(getLang($this->heading . " Successfully Deleted."));
            return redirect(route($this->route . ".index"));

        }

        flashSuccess(getLang($this->heading . " Appointment Did Not Cancel."));
        return redirect(route($this->route . ".index"));

    }

    public function get_Appointment(Request $request)
    {
        $obj = new AppointmentBook();

        $columns = array(
            0 => 'id',
            1 => 'clientName',
        );

        // dd($request->input('status_flag'));

        // dd($date_Range);

        $totalData = $obj->appointmentbook_count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $today = $request->input('today');
        $status_flag = $request->input('status_flag');
        $branch_id = $request->input('branch_id');

        $date_Range = $request->date_range;


        if (empty($request->input('search.value'))) {
            $results = $obj->appointmentbook_listing($limit, $start, $order, $dir,$branch_id ,$today, $status_flag, $date_Range);
        } else {
            $search = $request->input('search.value');
            $results = $obj->appointmentbook_listing($limit, $start, $order, $dir,$branch_id, $today, $status_flag, $date_Range, $search);
            $totalFiltered = $obj->appointmentbook_count($search,$branch_id,$today, $status_flag, $date_Range);
        }
        $data = array();
        if (!empty($results)) {
            $count = $start + 1;
            foreach ($results as $result) {

                $show = '';
                // $edit = route('editUser', ['id' => $result->id]);
                // $nestedData['DT_RowClass'] = "add_row";
                $nestedData['id'] = $count++;
                $nestedData['clientName'] = view('appointment_book.tabs.table._client_name')->with(['loop_variable' => $result])->render();
                $nestedData['dated'] = view('appointment_book.tabs.table._date')->with(['loop_variable' => $result])->render();
                $nestedData['services'] = view('appointment_book.tabs.table._services')->with(['loop_variable' => $result])->render();
                $nestedData['status'] = view('appointment_book.tabs.table._status')->with(['loop_variable' => $result])->render();
                $nestedData['employee'] = view('appointment_book.tabs.table._employee')->with(['loop_variable' => $result])->render();
                $nestedData['payment'] = view('appointment_book.tabs.table._payment')->with(['loop_variable' => $result])->render();
                $nestedData['total'] = view('appointment_book.tabs.table._total')->with(['loop_variable' => $result])->render();

                $data[] = $nestedData;
            }
        }

        return response()->json(['draw' => intval($request->input('draw')), 'recordsTotal' => intval($totalData), 'recordsFiltered' => intval($totalFiltered), 'data' => $data]);

        // $apptBook = new AppointmentBook;

        // $apptBook = $apptBook->get();
        // return $apptBook;
    }

    public function serviceColor(Request $request)
    {
        if ($request->row) {
            foreach ($request->row as $data) {
                Service::where('id', $data['id'])->update(['color' => $data['color']]);
            }
        }
        return redirect()->back();
    }
    public function appointmentColor(Request $request)
    {
        if ($request->row) {
            foreach ($request->row as $data) {
                AppointmentType::where('id', $data['id'])->update(['color' => $data['color']]);
            }
        }
        return redirect()->back();
    }
}
