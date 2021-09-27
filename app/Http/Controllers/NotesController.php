<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\LoyaltyPointsLog;
use App\Models\Notes;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function store(Request $request)
    {
        $client = Client::find($request->clientId);
        if ($client) {
            Notes::createNew($client, $request->notes_content);

            if ($request->ajax()) {
                return response([
                    'status' => true,
                    'html' => view('client.partials.notes_table')->with(['items' => $client->notes])->render()
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Notes::find($id);
        if ($note) {
            return response([
                'status' => true,
                'html' => view('client.partials.notes_edit_modal')->with(['note' => $note])->render()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $note = Notes::find($request->id);
        $client = Client::find($request->clientId);
        if ($note) {
            Notes::updateExisting($request->id, $request->notes_content);

            if ($request->ajax()) {
                return response([
                    'status' => true,
                    'html' => view('client.partials.notes_table')->with(['items' => $client->notes])->render()
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
