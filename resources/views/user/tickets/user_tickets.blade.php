@extends('layouts.userapp')
@section('title', 'My Tickets')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> My Tickets</h4>

  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Table Basic</h5>
    <div class="table-responsive text-nowrap">
      @if($tickets->isEmpty())
       <table class="table">
            <thead>
              <tr>
                <th>Problem Description</th>
                <th>Status</th>
                <th>Last Updated</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">
                        You have not created any tickets.
                    </td>
                </tr>
            </tbody>
        </table>
            @else
    <table class="table" id="myTable">
        <thead>
          <tr>
            <th>Problem Description</th>
            <th>Ticket ID</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($tickets as $ticket)
                <tr>
                    <td>
                        <a>
                            {{ $ticket->problem_description }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ url('user/tickets/' . $ticket->ticket_id) }}">
                            # {{ $ticket->ticket_id }}
                        </a>
                    </td>
                    <td>
                        @if($ticket->status == "Open")
                        <span class="badge bg-label-primary me-1">{{ $ticket->status }}</span>
                        @else
                            <span class="badge bg-label-warning me-1">{{ $ticket->status }}</span>
                        @endif
                    </td>
                    <td>
                        {{ $ticket->updated_at }}
                    </td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                          >
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                          >
                        </div>
                      </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>  
    @endif
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
@endsection
