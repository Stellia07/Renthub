@extends('owner.owner_dashboard')
@section('owner')


@php
  $id = Auth::user()->id;
  $ownerId = App\Models\User::find($id);
  $status = $ownerId->status;
@endphp

 <div class="page-content">


  @if($status === 'active')
    <h4>Owner Account Is <span class="text-success">Active </span> </h4>

    @else
      <h4>Owner Account Is <span class="text-danger">Inactive </span> </h4>
      <p class="text-danger"><b> Please wait for admin to check and approve your account</b></p>
    @endif

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
              <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
              <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
            </div>
            
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Your Property</h6>
                      
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $propertyCount }}</h3>
                        
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="ownersChart" class="mt-md-3 mt-xl-0"
                            data-active-ownerprop="{{ $activeOwnerProp }}"
                            data-inactive-ownerprop="{{ $inactiveOwnerProp }}"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Your Tenants</h6>
                      
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $tenantCount }}</h3>
                        
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="tenantsChart" class="mt-md-3 mt-xl-0"
                            data-active-tenants="{{ $activeTenants }}" 
                            data-pending-tenants="{{ $pendingTenants }}"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          


          <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Your Property</h6>
                  
                </div>
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                      <th>Sl </th>
                      <th>Name </th> 
                      <th>P Type </th> 
                      <th>Furnish Type </th> 
                      <th>Owner Name </th> 
                      <th>Status </th>  
                      </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($property as $key => $item)  

                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $item->property_name }}</td>
                      <td>{{ $item['type']['type_name'] }}</td>
                      <td>{{ $item->furnish_status }}</td>
                      <td>{{ $item['owner']['name'] }}</td>
                      <td>

                        @if($item->status == 1)
                          <span class="badge rounded-pill bg-success">Active</span>
                        @else
                          <span class="badge rounded-pill bg-danger">Inactive</span>
                        @endif

                      </td>
                      
                      
                      
                    </tr>

                  @endforeach  

                    </tbody>
                  </table>
                </div>
              </div> 
            </div>
          </div>
        </div> <!-- row -->

      </div>

@endsection