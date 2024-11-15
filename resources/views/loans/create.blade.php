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
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/loans">Préstamos</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">

    <!-- Default box -->
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Registrar Nuevo Préstamo</h3>
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
        <form action="" method="post">
          <div class="form-group">
            <label for="customer_id">Cliente</label>
            <select name="customer_id" id="customer_id" class="form-control">
              <option value="">Seleccione</option>
              @foreach($customers as $customer)
              <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="capital">Capital</label>
            <input type="number" name="capital" id="capital" class="form-control">
          </div>
          <div class="form-group">
            <label for="method">Tipo interés</label>
            <select name="method" id="method" class="form-control">
              <option value="simple">Fijo</option>
            </select>
          </div>
        </form>
      </div>
      <div class="card-footer">
        Footer
      </div>
    </div>

  </section>

</div>
@endsection
