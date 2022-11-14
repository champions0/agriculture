@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Միջոցառումների ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Միջոցառումների ցուցակ</li>
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
                                <h3 class="card-title">Միջոցառումներ</h3>

                                <div class="card-tools">
                                    <form action="{{ route('events.index') }}" method="GET">
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
                                    <div class="box-tools" style="margin-top: 20px; ">
                                        <a href="{{route('events.create')}}" class="btn btn-primary">Ավելացնել միջոցառում</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Վերնագիռ</th>
                                        <th>Թեմա</th>
                                        <th>Տարիք</th>
                                        <th>Սեռ</th>
                                        <th>Կազմակերպիչ</th>
                                        <th>Սկիզբ</th>
                                        <th>Ավարտ</th>
                                        <th>Կարգավիճակ</th>
                                        <th>Ավելացվել է</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <td>{{ $event->id }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->subject->name ?? '' }}</td>
                                            <td>{{ $event->age }}</td>
                                            <td>{{ $event->gender }}</td>
                                            <td>{{ $event->organizer }}</td>
                                            <td>{{ $event->start_date }}</td>
                                            <td>{{ $event->end_date }}</td>
                                            @if($event->status == 1)
                                                <td>
                                                    <i class="text-success">Ակտիվ</i>
                                                </td>
                                            @else
                                                <td>
                                                    <i class="text-danger">Պասիվ</i>
                                                </td>
                                            @endif
                                            <td>{{ $event->created_at }}</td>
                                            <td>
                                                <a href="{{ route('events.edit', $event->id) }}" class="btn" title="Edit details">
                                                    <i class="text-success nav-icon fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                      style="display: none"
                                                      onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել միջոցառումը?')">
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
                                {!! $events->links() !!}
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
