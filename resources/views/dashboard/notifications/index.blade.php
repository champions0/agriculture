@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Հաղորդագրությունների ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Հաղորդագրությունների ցուցակ</li>
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
                                <h3 class="card-title">Հաղորդագրություններ</h3>

                                <div class="card-tools">
                                    <form action="{{ route('notifications.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 450px;">
                                            <select name="status" class="custom-select form-control-borde">
                                                <option value="" selected>Կարգավիճակ</option>
                                                <option value="1" {{ isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : '' }}>Ակտիվ</option>
                                                <option value="0" {{ isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : '' }}>Պասիվ</option>
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
                                    <div class="box-tools mr-0" style="margin-top: 20px; float: right">
                                        <a href="{{route('notifications.create')}}" class="btn btn-primary">Ավելացնել Հաղորդագրություն</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Վերնագիր</th>
                                        <th>Տեսակ</th>
                                        <th>Կարգավիճակ</th>
                                        <th>Ավելացվել է</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td>{{ $notification->id }}</td>
                                            <td>{{ $notification->title }}</td>
                                            <td>{{ $notification->type ?? 'Տեսակավորված չէ' }}</td>
                                            @if($notification->status == 1)
                                                <td>
                                                    <i class="text-success">Կարդացված</i>
                                                </td>
                                            @elseif($notification->status == 0)
                                                <td>
                                                    <i class="text-danger">Նոր</i>
                                                </td>
                                            @else
                                                <td>
                                                    <i class="text-danger">Բացված</i>
                                                </td>
                                            @endif
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <a href="{{ route('notifications.show', $notification->id) }}" class="btn"
                                                   title="Show details">
                                                    <i class="text-success nav-icon fas fa-eye"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $notifications->links() !!}
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
