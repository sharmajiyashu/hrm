
           <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >Name</th>
                        <th scope="col" >Sub total</th>
                        <th scope="col" >Tax Rate</th>
                        <th scope="col" >Tax Amount</th>
                        <th scope="col" >Total</th>
                        <th scope="col" >Paid Amount</th>
                        <th>Due Amount</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php  $i = ($invoices->currentPage() - 1) * $invoices->perPage() + 1; @endphp
                    @foreach ($invoices as $item)
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
                                        <div class="fw-bolder">{{ $item->first_name }} {{ $item->last_name }}</div>
                                        <div class="font-small-2 text-muted">{{ $item->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td ><strong>{{ $item->sub_total }}</strong></td>
                            <td >{{ $item->tax_rate }} %</td>
                            <td>{{ $item->tax }}</td>
                            <td class="fw-bolder me-1">{{ $item->total }}</td>
                            <td>{{ $item->paid_amount }}</td>
                            <td>{{ $item->due_amount }}</td>
                            @if ($item->due_amount > 0)
                                <td><span class="badge rounded-pill badge-light-danger"> Due</span></td>
                            @else
                                <td><span class="badge rounded-pill badge-light-success"> Paid</span></td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{route('admin.invoices.edit',$item->id)}}">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="{{route('admin.invoices.show',$item->id)}}">
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
                                                <form action="{{route('admin.invoices.destroy',$item->id)}}" method="POST">
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
            @include('admin._pagination', ['data' => $invoices])
           </div>
           
          

<script>
    feather.replace();
</script>

