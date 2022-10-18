@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Քաղաքացիների ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Քաղաքացիների ցուցակ</li>
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
                                <h3 class="card-title">Քաղաքացիներ</h3>

                                <div class="card-tools">
                                    <form action="{{ route('citizens.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 300px;">
{{--                                            <select name="order_by" class="custom-select form-control-borde">--}}
{{--                                                <option value="" selected>Order By</option>--}}
{{--                                                <option value="listing_count" {{ isset($_GET['order_by']) && $_GET['order_by'] == 'listing_count' ? 'selected' : '' }}>Listing count</option>--}}
{{--                                                <option value="created_at" {{ isset($_GET['order_by']) && $_GET['order_by'] == 'created_at' ? 'selected' : '' }}>Created At</option>--}}
{{--                                            </select>--}}
                                            <input type="text" name="search" class="form-control float-right"
                                                   placeholder="Փնտրել" value="{{ $_GET['search'] ?? '' }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i style="font-weight: 900;" class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="box-tools" style="margin-top: 20px; ">
                                        <a href="{{route('citizens.create')}}" class="btn btn-primary">Ավելացնել</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Անուն</th>
{{--                                        <th>Ազգանուն</th>--}}
{{--                                        <th>Հայրանուն</th>--}}
                                        <th>Ծննդյան ամսաթիվ</th>
                                        <th>Սեռ</th>
                                        <th>Հեռախոսահամար</th>
                                        <th>Հասցե</th>
{{--                                        <th>Կարգավիճակ</th>--}}
{{--                                        <th>Ավելացվել է</th>--}}
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($citizens as $citizen)
                                        <tr>
                                            <td>{{ $citizen->id }}</td>
                                            <td>{{ $citizen->first_name . ' ' . $citizen->last_name . ' ' . $citizen->surname }}</td>
{{--                                            <td>{{ $citizen->last_name }}</td>--}}
{{--                                            <td>{{ $citizen->surname }}</td>--}}
                                            <td>{{ $citizen->birth_date }}</td>
                                            <td>{{ $citizen->gender }}</td>
                                            <td>{{ $citizen->phone }}</td>
                                            <td>{{ $citizen->address }}</td>
{{--                                            @if($citizen->status == 1)--}}
{{--                                                <td>--}}
{{--                                                    <i class="text-success">Ակտիվ</i>--}}
{{--                                                </td>--}}
{{--                                            @else--}}
{{--                                                <td>--}}
{{--                                                    <i class="text-danger">Պասիվ</i>--}}
{{--                                                </td>--}}
{{--                                            @endif--}}
{{--                                            <td>{{ $citizen->created_at }}</td>--}}
                                            <td>
                                                <a href="{{ route('citizens.edit', $citizen->id) }}" class="btn" title="Edit details">
                                                    <i class="text-success nav-icon fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('citizens.destroy', $citizen->id) }}" method="POST"
                                                      style="display: none"
                                                      onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել քաղաքացուն?')">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" onclick="$(this).prev().submit()" title="Delete">
                                                    <i class="text-danger nav-icon fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $citizens->links() !!}
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
