@extends('layout.admin')

@section('title', 'Préstamos')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Préstamos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">

    <div class="my-3">
      <a href="/loans/create" class="btn btn-primary">
        <i class="fa fa-plus-circle"></i>
        Registrar Nuevo Préstamo
      </a>
    </div>
    <!-- Default box -->
    <div class="card card-success card-outline">
      <div class="card-header">
        <h3 class="card-title">Préstamos activos</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Cliente</th>
              <th class="text-right">Balance</th>
              <th class="text-right">Cuota mensual</th>
            </tr>
          </thead>
          <tbody>
            @foreach($loans as $loan)
            <tr>
              <td>{{ $loan->customer->full_name }}</td>
              <td align="right">@money($loan->capital)</td>
              <td align="right">@money($loan->quota)</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        Footer
      </div>
    </div>

  </section>

</div>
@endsection
