<?php

namespace App\Http\Controllers;

use App\Models\GeneralSchedule;
use App\Models\Schedule;
use App\Models\ScheduleTime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends BaseController
{
    protected $model;
    protected $route;
    protected $heading;
    protected $topHeading;

    public function __construct()
    {
        $this->model = new Schedule();
        $this->route = 'schedule';
        $this->heading = 'Schedule';
        \Illuminate\Support\Facades\View::share('top_heading', 'Schedule');
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
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate($this->model->rules);
        $this->model->saveFormData($this->model, $request);

        flashSuccess(getLang($this->heading . " Successfully Created."));

        if (isset($request->add_new)) return redirect(route($this->route . ".create"));

        return redirect(route($this->route . ".index"));
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

    public function getDateRange(Request $request)
    {
        $type = $request->incDec;
        $lastDate = date('Y-m-d', strtotime($request->lastDate));
        $data = "+" . $type . " week";
        $endDate = date("Y-m-d", strtotime("+" . $type . " week"));

        $branchTime = \App\Models\GeneralSchedule::all();
        if ($request->dateType == 'next') {
            $period = new \DatePeriod(
                new \DateTime($lastDate),
                new \DateInterval('P1D'),
                new \DateTime($endDate)
            );
            $dateData = \Illuminate\Support\Facades\View::make('schedule/partials/date_rang')->with(['period' => $period, 'branchTime' => $branchTime])->render();

            return [
                'status' => 1,
                'result' => $lastDate . '-' . $endDate,
                'lastDate' => $endDate,
                'dateData' => $dateData,
            ];
        } else {
            $period = new \DatePeriod(
                new \DateTime($endDate),
                new \DateInterval('P1D'),
                new \DateTime($lastDate)
            );
            $dateData = \Illuminate\Support\Facades\View::make('schedule/partials/date_rang')->with(['period' => $period, 'branchTime' => $branchTime])->render();

            return [
                'status' => 1,
                'result' => $endDate . '-' . $lastDate,
                'lastDate' => $endDate,
                'dateData' => $dateData,
            ];
        }
    }

    public function getBranchTime(Request $request)
    {
        $user = Auth::user();
        $time = Schedule::with('scheduleTime')->where(['branch_id'=>$user->id,'start_date'=>date('Y-m-d',strtotime($request->dateValue))])->first();
       $dateValue = date('M d, Y', strtotime($request->dateValue));
        $dateData = \Illuminate\Support\Facades\View::make('schedule/partials/set_branch_time')->with(['user' => $user, 'time' => $time, 'dateValue' => $dateValue])->render();

        return [
            'status' => 1,
            'result' => $dateData,
        ];
    }

    public function getBranchSchedule(){
        $user = Auth::user();
        $schedule = Schedule::with('scheduleTime')->where(['branch_id'=>$user->id])->get();
        return [
            'status' => 1,
            'result' => $schedule,
        ];
    }  

    public function setBranchTime(Request $request)
    {
        $keyValue = $request->keyValue;

        $startDate = date('Y-m-d', strtotime($request->activityDate));

        if($request->is_repeat ){
            $dateArray = [];
            $dateArrayMg = [];
            if ($request->is_repeat == 1 &&  $request->addDateType == 'month'){
                $last = \Carbon\Carbon::parse($startDate)->addMonth($request->repeatTime ?? 1);
            }else{
                $last = \Carbon\Carbon::parse($startDate)->addWeek($request->repeatTime ?? 1);
            }
            $period = new \DatePeriod(
                new \DateTime( $startDate),
                new \DateInterval('P1D'),
                new \DateTime( date('Y-m-d', strtotime($last)))

            );
            foreach ($period as $time){
                if(in_array($time->format('D'),$request->repeatWeek) ){
                    $this->setSchedulerTime($request, $time->format('Y-m-d'));
                    array_push($dateArray,$time->format('Y-m-d'));
                    array_push($dateArrayMg,$time->format('Ymd'));
                }
            }
            $scheduledata =  Schedule::where('branch_id',Auth::id())->whereIn('start_date' , $dateArray)->get();
            $data = [];
            foreach ($scheduledata as $item){
            foreach ($item->scheduleTime as $value){
                $data[date('Ymd',strtotime($item->start_date))]= [date('h:i a',strtotime($value->start_time)) .' - '. date('h:i a',strtotime($value->end_time))];
            }
            }
            return [
                'status'=>1,
                'repeat'=>1,
                'data'=>$data,
                'dateArray'=>$dateArrayMg,
            ];
        }else{
            $this->setSchedulerTime($request, $startDate);
            $scheduledata =  Schedule::with('scheduleTime')->where(['branch_id'=>Auth::id(),'start_date' => $startDate])->first();
           $data = '';
           foreach ($scheduledata->scheduleTime as $item){
               $data.= date('h:i a',strtotime($item->start_time)) .' - '. date('h:i a',strtotime($item->end_time)) .'<br/>';
           }
            return [
                'status'=>1,
                'repeat'=>2,
                'dateValue'=>date('Ymd',strtotime($startDate)),
                'data'=>$data
            ];
        }
    }
    public function setSchedulerTime($request, $activityDate){
       $scheduleId =  Schedule::where(['branch_id'=>Auth::id(),'start_date' => date('Y-m-d', strtotime($activityDate))])->first();
        $schedule = new Schedule();
        $schedule->branch_id = Auth::id();
        $schedule->start_date = date('Y-m-d', strtotime($activityDate));
        $schedule->is_open = isset($request->is_open)?$request->is_open:'0';
        $schedule->reason = $request->reason;
        $schedule->save();
       ScheduleTime::where('schedule_id',$scheduleId)->delete();
       if($scheduleId != null){
           $scheduleId->delete();
       }
        if ($schedule) {
            foreach ($request->row as $row) {
                $scheduleTime = new ScheduleTime();
                $scheduleTime->schedule_id = $schedule->id;
                $scheduleTime->start_time = date('H:i:s',strtotime($row['start_time']));
                $scheduleTime->end_time = date('H:i:s',strtotime($row['end_time']));
                $scheduleTime->save();
            }
        }

    }
    public function setBranchGeneralTime(Request $request){
//        return $request->all();
        foreach ($request->row as $data){
            $schedule = GeneralSchedule::find($data['id']);
                $schedule->start_time = isset($data['start_time'])? date('H:i:s',strtotime($data['start_time'])) : null;
                $schedule->end_time = isset($data['end_time'])?date('H:i:s',strtotime($data['end_time'])): null;
            $schedule->is_open = isset($data['is_open'])?1 : 0;
            $schedule->save();
        }
        $data = $this ->currentGeneralData();
        return [
          'status'=>1,
          'result'=>$data,
        ];
    }
    public function currentGeneralData(){

        $period = new \DatePeriod(
            new \DateTime(date('Y-m-d')),
            new \DateInterval('P1D'),
            new \DateTime(date("Y-m-d", strtotime("+1 week")))

        );
        \Carbon\Carbon::parse(now())->addWeek();
        $branchTime = GeneralSchedule::all();

        $dateData = \Illuminate\Support\Facades\View::make('schedule/partials/date_rang')->with(['period'=>$period,'branchTime'=>$branchTime])->render();
        return $dateData;
    }
}
