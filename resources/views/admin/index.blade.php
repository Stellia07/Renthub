@extends('admin.admin_dashboard')
@section('admin')

 <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
              <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
              <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input disabled>
            </div>
            
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <h6 class="card-title mb-0">Listed Properties</h6>
                      <div class="dropdown mb-2">
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $activePropertiesCount }}</h3>
                        
                      </div>
                      <!-- <div class="col-6 col-md-12 col-xl-7">
                        <div id="chartjsDoughnut" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total of Owners</h6>
                      <div class="dropdown mb-2">
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $totalOwners }}</h3>
                        
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="ordersChart" class="mt-md-3 mt-xl-0"
                          data-active-owners="{{ $activeOwners }}"
                          data-inactive-owners="{{ $inactiveOwners }}"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total of Tenants</h6>
                      <div class="dropdown mb-2">
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $totalTenants }}</h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                      <!-- <div class="col-6 col-md-12 col-xl-7">
                        <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->

        

        <div class="row">
          <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Monthly Listings</h6>
                  <div class="dropdown mb-2">
                    
                  </div>
                </div>
                <p class="text-muted">
The monthly listings graph illustrates the variation in property listings added each month throughout the year.</p>
                <div id="monthlySalesChart"></div>
              </div> 
            </div>
          </div>
          
        </div> <!-- row -->

        <div class="row">
          


          <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">All Properties</h6>
                  <div class="dropdown mb-2">
                    
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>Name </th> 
                        <th>P Type </th> 
                        <th>Furnish Type </th> 
                        <th>Property Code </th> 
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
                        <td>{{ $item->property_code }}</td>
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

      <script>
          var monthlyListingsData = @json($monthlyListings);
      </script>

@endsection