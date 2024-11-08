<?php

namespace App\Http\Controllers;
use App\Models\Tickets;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        'assignees.name as assignee_name'
    )
    ->when($search, function ($query, $search) {
        return $query->where('tickets.title', 'like', '%' . $search . '%')
                     ->orWhere('tickets.description', 'like', '%' . $search . '%')
                     ->orWhere('creators.name', 'like', '%' . $search . '%')
                     ->orWhere('assignees.name', 'like', '%' . $search . '%');
    })
    ->get();

// Pasar los tickets a la vista
return view('tickets.index', ['tickets' => $tickets]);
        //  Usamos Eloquent con relaciones para obtener los tickets
        //   $tickets = Tickets::with(['creator', 'assignee'])->get();

        //   // Pasamos los tickets a la vista
        //   return view('tickets.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = DB::table('users')->get();

        // Retornar la vista de creación de ticket con los usuarios
        return view('tickets.new', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'nullable|exists:users,id' // Asegura que el usuario asignado exista
        ]);
    
        // Crear un nuevo ticket
        $ticket = new Tickets();
        $ticket->title = $request->title;                // Título del ticket
        $ticket->description = $request->description;    // Descripción del ticket
        $ticket->created_by = auth()->id();              // Usuario autenticado que crea el ticket
        $ticket->assigned_to = $request->assigned_to;    // Usuario asignado
        $ticket->status = 'abierto';                        // Estado inicial del ticket
        $ticket->save();
    
        // Obtener todos los tickets con la información de los creadores y asignados
        $tickets = DB::table('tickets')
            ->join('users as creators', 'tickets.created_by', '=', 'creators.id')
            ->leftJoin('users as assignees', 'tickets.assigned_to', '=', 'assignees.id')
            ->select(
                'tickets.*',
                'creators.name as creator_name',
                'assignees.name as assignee_name'
            )
            ->get();
    
        // Retornar la vista de índice de tickets con la lista actualizada
        return view('tickets.index', ['tickets' => $tickets]);
        }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Tickets::find($id);

        // Usar DB query en lugar de Eloquent
        $users = DB::table('users')->get();
    
        return view('tickets.edit', ['ticket' => $ticket, 'users' => $users]);;
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
    return redirect()->route('tickets.index')->with('success', 'Ticket actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Tickets::find($id);

        // Si el ticket no existe, redirigir a la lista de tickets con un mensaje de error
        if (!$ticket) {
            return redirect()->route('tickets.index')->with('error', 'Ticket no encontrado.');
        }
    
        // Eliminar el ticket
        $ticket->delete();
    
        // Obtener todos los tickets actualizados con la información de los creadores y asignados
        $tickets = Tickets::with(['creator', 'assignee'])->get();
    
        // Retornar la vista de índice de tickets con la lista actualizada
        return view('tickets.index', ['tickets' => $tickets]);
    }
}
