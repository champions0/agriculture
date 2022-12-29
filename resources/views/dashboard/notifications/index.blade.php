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
                                                <option value="{{\App\Models\Notification::UNREAD}}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\Notification::UNREAD ? 'selected' : '' }}>Չկարդացված</option>
                                                <option value="{{\App\Models\Notification::READ}}" {{ isset($_GET['status']) && $_GET['status'] ==  \App\Models\Notification::READ ? 'selected' : '' }}>Կարդացված</option>
                                                <option value="{{\App\Models\Notification::OPENED}}" {{ isset($_GET['status']) && $_GET['status'] ==  \App\Models\Notification::OPENED ? 'selected' : '' }}>Չբացված</option>
                                            </select>
                                            <select name="type" class="custom-select form-control-borde">
                                                <option value="" selected>Տեսակ</option>
                                                <option value="{{\App\Models\Notification::OTHER}}" {{ isset($_GET['type']) && $_GET['type'] == \App\Models\Notification::OTHER ? 'selected' : '' }}>Տեսակավորված չէ</option>
                                                <option value="{{\App\Models\Notification::TAX}}" {{ isset($_GET['type']) && $_GET['type'] ==  \App\Models\Notification::TAX ? 'selected' : '' }}>Հարկային</option>
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
                                            <td>{{ isset($notification->type) && $notification->type == \App\Models\Notification::TAX ? 'Հարկային' : 'Տեսակավորված չէ' }}</td>
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
                                            <td>{{ $notification->created_at }}</td>
                                            <td>
                                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                                      style="display: none"
                                                      onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել հաղորդագրությունը')">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" onclick="$(this).prev().submit()" title="Delete">
                                                    <i class="text-danger nav-icon fas fa-trash"></i>
                                                </a>
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
