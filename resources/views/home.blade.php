@extends('layout.main')
@section('content')

<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <!-- Brand/logo -->
        <a class="navbar-brand text-warning text-bold" href="">Todo List App</a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <div class="nav-items float-right d-flex align-items-center">
                <div class="pr-2 dropdown">
                    <!-- Profile Picture -->
                    <div class="d-flex align-items-center">
                    <img src="{{auth()->user()->image}}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px;">
                        <span class="text-light d-block pl-2"></span>
                        <a href="/logout" class="btn btn-sm btn-danger ml-3">Logout</a>
                </div>
                  <div class="logout">
                    
                  </div>
                </div>
            </div>
        </div>
    </div>

</nav>

    <div class="container border mt-3 border-primary p-3" style="width: 80%;">
        <h3 class="text-center text-dark">To do list</h3>
        <div class="form">
            <form class="container mt-3" action="/task" method="post">
                @csrf
                <div class="hello" style="display: flex; flex-direction:row;justify-content:space-between">
                    <div class="form-group">
                        <input type="text" class="form-control" name="task" id="" placeholder="Add task here..."
                            style="width:650px;" required>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="date" id="" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Beautiful Dropdown Menu -->
        <div class="row py-2">
  <div class="col-md-6">

  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="date_filter">Filter status:</label>

      <form method="get" action="/filter">
        @csrf
        <div class="input-group">
          <select class="form-select" name="date_filter">
            <option value="all" >All</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="missed">Missed</option>
          </select>
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
      </form>

    </div>
  </div>
</div>
        <!-- Beautiful Table -->
        <table class="table">
            <thead>
                <tr class="p-3">
                    <th scope="col"><i class="fa-solid fa-list-check"></i> Task</th>
                    <th scope="col"><i class="fa-regular fa-calendar-days"></i> Due Date</th>
                    <th scope="col"><i class="fa-solid fa-circle-question"></i> Status</th>
                    <th scope="col"><i class="fa-solid fa-person-walking"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $list) 
                
                <tr>
                    <td>{{$list->task}}</td>

                    <td >{{$list->date}}</td>

                    <td class="{{$list->status === 'Missed' ? 'text-danger' : ($list->status === 'Pending' ? 'text-primary' : ($list->status === 'Completed' ? 'text-success' : '')) }} text-bold">{{$list->status}}</td>

                    <td>
                        @if ($list->status == 'Pending')
                       
                            <a href="/completed/{{$list->id}}" class="text-success" style="text-decoration: none;"><i class="fa-solid fa-check text-success"></i> Done</a> |
                       @endif
                        <a href="/destroy/{{$list->id}}" class="text-danger" style="text-decoration: none;" ><i class="fa-solid fa-trash text-danger"></i> Remove</a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- <script> -->
  <!-- JavaScript function to handle filter changes -->
  <!-- function applyFilter(status) {
    const filterForm = document.getElementById('filter-form');
    filterForm.date_filter.value = status;
    filterForm.submit();
  }
</script> -->




@endsection