<?php

namespace App\Http\Controllers;
use App\Models\Soporte;
use App\Models\Tickets;

use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class SoporteController extends Controller
{
    public function index(Request $request)
    {
        
      //  Realizamos la consulta con JOINs
        // $tickets = DB::table('tickets')
        //     ->join('users as creators', 'tickets.created_by', '=', 'creators.id')
        //     ->leftJoin('users as assignees', 'tickets.assigned_to', '=', 'assignees.id')
        //     ->select(
        //         'tickets.id', 
        //         'tickets.title', 
        //         'tickets.status', 
        //         'creators.name as creator_name',
        //         'assignees.name as assignee_name'
        //     )
        //     ->get();

        // Pasamos los tickets a la vista
    //    return view('tickets.index', ['tickets' => $tickets]);
    $search = $request->input('search');
    $tickets = DB::table('tickets')
    ->join('users as creators', 'tickets.created_by', '=', 'creators.id')
    ->leftJoin('users as assignees', 'tickets.assigned_to', '=', 'assignees.id')
    ->select(
        'tickets.id',
        'tickets.title',
        'tickets.status',
        'creators.name as creator_name',
        'assignees.name as assignee_name',
        'tickets.created_at',
        'tickets.updated_at',
    )
    ->when($search, function ($query, $search) {
        return $query->where('tickets.title', 'like', '%' . $search . '%')
                     ->orWhere('tickets.description', 'like', '%' . $search . '%')
                     ->orWhere('creators.name', 'like', '%' . $search . '%')
                     ->orWhere('assignees.name', 'like', '%' . $search . '%');
    })
    ->get();

// Pasar los tickets a la vista
return view('soporte.index', ['tickets' => $tickets]);
     
    }
    public function edit($id)
    {
        $ticket = Tickets::find($id);

        // Usar DB query en lugar de Eloquent
        $users = DB::table('users')->get();
    
        return view('soporte.edit', ['ticket' => $ticket, 'users' => $users]);;
}
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // Buscar el ticket por su ID
    $ticket = Tickets::find($id);

    // Validar y actualizar los campos del ticket
    $ticket->title = $request->input('title');
    $ticket->description = $request->input('description');
    $ticket->status = $request->input('status');
    $ticket->created_by = $request->input('created_by');
    $ticket->assigned_to = $request->input('assigned_to');
    $ticket->save();

    // Redirigir a la lista de tickets después de actualizar
    return redirect()->route('soporte.index')->with('success', 'Ticket actualizado exitosamente.');
    }

    //
}
