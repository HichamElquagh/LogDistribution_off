@extends('admin.layouts.template')

@section('page-title')
    Fournisseurs | Log Dist Du Nord
@endsection

@section('admin')
       <!-- Include the font stylesheet -->
       <link href="https://fonts.googleapis.com/css2?family=Roboto:400,700&display=swap" rel="stylesheet">
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Fournisseurs Detail</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Fournisseurs Detail</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



<div class="row mt-4 text-center">
  <!-- Card for Fournisseur Information -->
  <div class="col-md-6 mx-auto">
    <div class="card border-1 rounded mb-3">
      <div class="card-header bg-secondary text-white">
        <h5 class="mb-0 text-white" style="font-family: 'Roboto', sans-serif;">Fournisseur Information</h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <i class="fas fa-map-marker-alt"></i>
          <span class="ms-2">Address:</span>
          <span class="ml-auto">xxxxxxxxx</span>
        </div>
        <div class="mb-3">
          <i class="far fa-envelope"></i>
          <span class="ms-2">Email:</span>
          <span class="ml-auto">xxxxxxxxxxxxxx</span>
        </div>
        <div class="mb-3">
          <i class="fas fa-phone-alt"></i>
          <span class="ms-2">Phone:</span>
          <span class="ml-auto">xxxxxxxxxxxxxxxxxxxx</span>
        </div>
      </div>
    </div>
  </div>
</div>

          

        <div class="row mt-4">
          <!-- Four Small Cards for Statistics -->
          <div class="col-md-3">
            <div class="card text-white bg-primary border-0 rounded">
              <div class="card-body">
                <i class="fas fa-file fa-3x mb-2"></i>
                <h5 class="card-title">Commande</h5>
                <p class="card-text">Value 1</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-success border-0 rounded">
              <div class="card-body">
                <i class="fas fa-wallet fa-3x mb-2"></i>
                <h5 class="card-title">Cheque Portfeuil</h5>
                <p class="card-text">Value 2</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-danger border-0 rounded">
              <div class="card-body">
                <i class="fas fa-users fa-3x mb-2"></i>
                <h5 class="card-title">Fournisseur</h5>
                <p class="card-text">Value 3</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-info border-0 rounded">
              <div class="card-body">
                <i class="fas fa-chart-line fa-3x mb-2"></i>
                <h5 class="card-title">Chiffre d'affaire</h5>
                <p class="card-text">Value 4</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <!-- Table with Show More Button -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header  text-dark">
                Last 10 Commande
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
              <div class="card-header text-dark">
                Last 10 Transaction
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

@section('styles')
<style>
  /* Custom CSS for font styling */
  p {
    font-family: Arial, sans-serif;
    font-size: 14px;
  }

  h5 {
    font-family: Arial, sans-serif;
    font-size: 18px;
    font-weight: bold;
  }

  h4 {
    font-family: Arial, sans-serif;
    font-size: 24px;
    font-weight: bold;
  }

  .card-title {
    font-weight: bold;
  }

  .card-text {
    margin-bottom: 0;
  }
</style>
@endsection
