@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Հայտարարությունների ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Հայտարարությունների ցուցակ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Հայտարարություններ</h3>

                                <div class="card-tools">
                                    <form action="{{ route('statements.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 300px;">
                                            {{--                                            <input type="date" class="form-control " name="start_date"--}}
                                            {{--                                                   value="{{ isset($_GET['start_date']) ? str_replace(' ', 'T', $_GET['start_date']) : '' }}">--}}
                                            {{--                                            <input type="date" class="form-control " name="end_date"--}}
                                            {{--                                                   value="{{ isset($_GET['end_date']) ? str_replace(' ', 'T', $_GET['end_date']) : '' }}">--}}

                                            <select name="status" class="custom-select form-control-borde">
                                                <option value="" selected>Կարգավիճակ</option>
                                                <option
                                                    value="{{ \App\Models\Statement::ACTIVE }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\Statement::ACTIVE ? 'selected' : '' }}>
                                                    Ակտիվ
                                                </option>
                                                <option
                                                    value="{{ \App\Models\Statement::INACTIVE }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\Statement::INACTIVE ? 'selected' : '' }}>
                                                    Պասիվ
                                                </option>
                                                <option
                                                    value="{{ \App\Models\Statement::CANCELED }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\Statement::CANCELED ? 'selected' : '' }}>
                                                    Ավարտված
                                                </option>
                                            </select>
                                            <input type="text" name="search" class="form-control float-right"
                                                   placeholder="Փնտրել" value="{{ $_GET['search'] ?? '' }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i style="font-weight: 900;" class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @if(auth()->user()->role == 'admin')
                                        <div class="box-tools mr-0" style="margin-top: 20px; float: right">
                                            <a href="{{route('statements.create')}}" class="btn btn-primary">Ավելացնել
                                                հայտարարություն</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Վերնագիր</th>
                                        <th>Հայտարարման ամսաթիվ</th>
                                        <th>Վերջնաժամկետ</th>
                                        <th>Հայտարարող</th>
                                        <th>Կարգավիճակ</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($statements as $statement)
                                        <tr>
                                            <td>{{ $statement->id }}</td>
                                            <td>{{ $statement->title }}</td>
                                            <td>{{ $statement->statement_date }}</td>
                                            <td>{{ $statement->deadline }}</td>
                                            <td>{{ $statement->declarant_first_name . ' ' . $statement->declarant_last_name }}</td>
                                            @if($statement->status == \App\Models\Statement::ACTIVE)
                                                <td>
                                                    <i class="text-success">Ակտիվ</i>
                                                </td>
                                            @elseif($statement->status == \App\Models\Statement::CANCELED)
                                                <td>
                                                    <i class="text-warning">Ավարտված</i>
                                                </td>
                                            @else
                                                <td>
                                                    <i class="text-danger">Պասիվ</i>
                                                </td>
                                            @endif
                                            <td>{{ $statement->created_at }}</td>
                                            <td>
                                                @if(auth()->user()->role == 'admin')
                                                    <a href="{{ route('statements.edit', $statement->id) }}" class="btn"
                                                       title="Edit details">
                                                        <i class="text-success nav-icon fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('statements.destroy', $statement->id) }}"
                                                          method="POST"
                                                          style="display: none"
                                                          onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել հայտարարությունը')">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="#" onclick="$(this).prev().submit()" title="Delete">
                                                        <i class="text-danger nav-icon fas fa-trash"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('statements.show', $statement->id) }}" class="btn"
                                                   title="Show details">
                                                    <i class="text-success nav-icon fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $statements->links() !!}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
