{{-- <section id="ajax-datatable">
    <!-- Responsive tables start -->
<div class="row" id="table-responsive">
   <div class="col-12">
       <div class="card card-company-table">
           <div class="card-header">
               <h4 class="card-title">Responsive tables</h4>
               <div class="col-md-3" style="text-align: end">
                <input type="text" id="searchInput" class="form-control" placeholder="Search">
            </div>
           </div> --}}
           <div class="table-responsive">
               <table class="table mb-0">
                   <thead class="table-dark">
                       <tr>
                           <th scope="col" >#</th>
                           <th scope="col" >Name</th>
                           <th scope="col" >Mobile</th>
                           <th scope="col" >Email</th>
                           <th scope="col" >Designation</th>
                           <th scope="col" >D.O.B</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       @php  $i = ($employees->currentPage() - 1) * $employees->perPage() + 1; @endphp
                       @foreach ($employees as $item)
                           <tr>
                               <td >{{ $i }}</td>
                               <td>
                                   <div class="d-flex align-items-center">
                                       <div class="avatar rounded">
                                           <div class="avatar-content">
                                               <img src="{{ asset('public/admin/app-assets/images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                                           </div>
                                       </div>
                                       <div>
                                           <div class="fw-bolder"><a href="{{ route('admin.employees.show',$item->id) }}">{{ $item->first_name }} {{ $item->last_name }}</a></div>
                                           <div class="font-small-2 text-muted">{{ $item->email }}</div>
                                       </div>
                                   </div>
                               </td>
                               <td >{{ $item->mobile }}</td>
                               <td >{{ $item->email }}</td>
                               <td >
                                   <div class="d-flex align-items-center">
                                       <div class="avatar bg-light-primary me-1">
                                           <div class="avatar-content">
                                               <i data-feather="monitor" class="font-medium-3"></i>
                                           </div>
                                       </div>
                                       <span><strong>{{ $item->designation }}</strong></span>
                                   </div>
                               </td>
                               <td >{{ $item->date_of_birth }}</td>
                               <td>
                                   <div class="dropdown">
                                       <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                           <i data-feather="more-vertical">wiew</i>
                                       </button>
                                       <div class="dropdown-menu dropdown-menu-end">
                                           <a class="dropdown-item" href="{{route('admin.employees.edit',$item->id)}}">
                                               <i data-feather="edit-2" class="me-50"></i>
                                               <span>Edit</span>
                                           </a>
                                           <a class="dropdown-item" href="{{route('admin.employees.show',$item->id)}}">
                                               <i data-feather="eye" class="me-50"></i>
                                               <span>View</span>
                                           </a>
                                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#danger_ke{{ $item->id }}">
                                               <i data-feather="trash" class="me-50"></i>
                                               <span>Delete</span>
                                           </a>
                                       </div>
                                   </div>

                                   <div class="modal fade modal-danger text-start" id="danger_ke{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered">
                                           
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h5 class="modal-title" id="myModalLabel120">Delete</h5>
                                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                   </div>
                                                   <div class="modal-body">
                                                       Are you sure you want to delete !
                                                   </div>
                                                   <form action="{{route('admin.employees.destroy',$item->id)}}" method="POST">
                                                       @csrf
                                                       @method('delete')
                                                       <div class="modal-footer">
                                                           <button type="submit" class="btn btn-danger" @if ($item->is_default == 1) @disabled(true) @endif>Delete</button>
                                                       </div>
                                                   </form>
                                               </div>
                                       </div>
                                   </div>
                               </td>
                           </tr>
                           @php
                               $i++;
                           @endphp
                       @endforeach
                       
                   </tbody>
               </table>
               @include('admin._pagination', ['data' => $employees])
           </div>
           
           {{-- <div class="table-responsive">
               <table class="table mb-0">
                   <!-- ... (your table structure) ... -->
               </table>
               {{ $employees->links('admin._pagination') }}
           </div> --}}
       {{-- </div>
   </div>
</div>
<!-- Responsive tables end -->
</section> --}}


<script>
    feather.replace();
</script>

