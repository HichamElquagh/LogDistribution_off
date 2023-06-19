@extends('admin.layouts.template')

@section('page-title')
    Clients | Log Dist Du Nord
@endsection

@section('admin')
<!-- Include the font stylesheet -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:400,700&display=swap" rel="stylesheet">

<style>
   /* Custom CSS for font styling */
   body {
    font-family: 'Roboto', sans-serif;
  }

  h4 {
    font-size: 24px;
  }

  .card-value {
    font-size: 20px;
    font-weight: bold;
  }
  .card-title {
    font-size: 17px;
    font-weight: bold;
  }
  .custom-card {
    border: 0px solid #ddd !important;
    transition: box-shadow 0.3s ease !important;
  }

  .custom-card:hover {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
    border-color: #aaa !important;
  }

  .custom-card .card-header {
    background-color: #6c757d !important;
    color: white !important;
  }

  .custom-card .card-header:hover {
    background-color: #5a6268 !important;
  }
</style>
    
<div class="page-content">
    <div class="container-fluid">
       
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Clients Detail</h4>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
              <li class="breadcrumb-item active">Clients Detail</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
        <!-- Card for client Information -->
        <div class="col-md-6 mx-auto">
          <div class="card border-1 rounded shadow-sm custom-card">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0 text-light text-center">Client Information</h5>
            </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-4 text-cen">
                  <i class="fas fa-map-marker-alt"></i>
                  <span class="ml-2" style="font-weight: bold;">Address:</span>
                </div>
                <div class="col-md-8 text-start">
                  <span>xxxxxxxxx</span>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-4 ">
                  <i class="far fa-envelope"></i>
                  <span class="ml-2" style="font-weight: bold;">Email:</span>
                </div>
                <div class="col-md-8 text-start">
                  <span>xxxxxxxxxxxxxx</span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 ">
                  <i class="fas fa-phone-alt"></i>
                  <span class="ml-2" style="font-weight: bold;">Phone:</span>
                </div>
                <div class="col-md-8 text-start">
                  <span>xxxxxxxxxxxxxxxxxxxx</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
          

<div class="row mt-4">
    <!-- Four Small Cards for Statistics -->
    <div class="col-md-3 d-flex">
      <div class="card text-white bg-primary border-0 rounded flex-fill">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <i class="fas fa-file fa-3x mb-2"></i>
            <h5 class="card-title">Commande</h5>
            <p class="card-text card-value">Value 1</p>
          </div>
          <i class="fas fa-arrow-up ml-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex">
      <div class="card text-white bg-success border-0 rounded flex-fill">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <i class="fas fa-wallet fa-3x mb-2"></i>
            <h5 class="card-title">Cheque Portfeuil</h5>
            <p class="card-text card-value">Value 2</p>
          </div>
          <i class="fas fa-arrow-down ml-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex">
      <div class="card text-white bg-danger border-0 rounded flex-fill">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <i class="fas fa-users fa-3x mb-2"></i>
            <h5 class="card-title">client</h5>
            <p class="card-text card-value">Value 3</p>
          </div>
          <i class="fas fa-arrow-up ml-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex">
      <div class="card text-white bg-info border-0 rounded flex-fill">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <i class="fas fa-chart-line fa-3x mb-2"></i>
            <h5 class="card-title">Chiffre d'affaire</h5>
            <p class="card-text card-value">Value 4</p>
          </div>
          <i class="fas fa-arrow-down ml-2"></i>
        </div>
      </div>
    </div>
  </div>
  
  

        <div class="row mt-4">
          <!-- Table with Show More Button -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header  text-dark   text-center">
                <h5 class="mb-0">Last 10 Commande</h5>
                          </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Column 1</th>
                      <th>Column 2</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Value 1</td>
                      <td>Value 2</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Value 3</td>
                      <td>Value 4</td>
                    </tr>
                  </tbody>
                </table>
                <button class="btn btn-primary">Show More</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <!-- Table with More Details Button -->
          <div class="col-md-12">
            <div class="card">
                <div class="card-header  text-dark   text-center">
                    <h5 class="mb-0">Last 10 Commande</h5>
                              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Column A</th>
                      <th>Column B</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Value A1</td>
                      <td>Value B1</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Value A2</td>
                      <td>Value B2</td>
                    </tr>
                  </tbody>
                </table>
                <button class="btn btn-primary">More Details</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
<link href="https://fonts.googleapis.com/css2?family=Roboto:400,700&display=swap" rel="stylesheet">

@section('styles')

@endsection