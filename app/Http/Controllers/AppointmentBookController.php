<?php

namespace App\Http\Controllers;

use App\Models\AppointmentBook;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

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

        $result = $this->model->deleteAppointment($request);
        if($result)
        {
            flashSuccess(getLang($this->heading . " Successfully Deleted."));
            return redirect(route($this->route . ".index"));

        }

        flashSuccess(getLang($this->heading . " Appointment Did Not Cancel."));
        return redirect(route($this->route . ".index"));

    }
<<<<<<< HEAD
=======


    public function get_Appointment(Request $request)
    {
        $obj = new AppointmentBook();
     
        $columns = array(
            0 => 'id',
            // 1 => 'name',
        );

        $totalData = $obj->appointmentbook_count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = $obj->appointmentbook_listing($limit, $start, $order, $dir);
        } else {
            $search = $request->input('search.value');
            $results = $obj->appointmentbook_listing($limit, $start, $order, $dir, $search);
            $totalFiltered = $obj->appointmentbook_count($search);
        }
        $data = array();
        if (!empty($results)) {
            $count = $start + 1;
            foreach ($results as $result) {

                $show = '';
                // $edit = route('editUser', ['id' => $result->id]);
                // $nestedData['DT_RowClass'] = "add_row";
                $nestedData['id'] = $count++;
                $nestedData['clientName'] = View::make('appointment_book.tabs.table._client_name.blade')->with(['loop_variable' => $result])->render();
                // $nestedData['Email'] = $result->email;
                // $nestedData['Role'] = !empty($result->roles->first()->name)?$result->roles->first()->name:"";
                // $nestedData['Location'] = \LocationHelper::getLocationNameById($result->location_id);
                // $nestedData['Status'] = View::make('admin.user.status')->with(['loop_variable' => $result])->render();
                // $nestedData['Options'] = View::make('admin.user.option_button')->with(['edit' => $edit, 'id' => $result->id])->render();
                $data[] = $nestedData;
            }
        }
        
        return response()->json(['draw' => intval($request->input('draw')), 'recordsTotal' => intval($totalData), 'recordsFiltered' => intval($totalFiltered), 'data' => $data]);
        
        // $apptBook = new AppointmentBook;
        
        // $apptBook = $apptBook->get();
        // return $apptBook;
    }



>>>>>>> f0e42524fad9520f8d606e8236e84a02472d3e78
}
