@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Նորությունների ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Նորությունների ցուցակ</li>
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
                                <h3 class="card-title">Նորություններ</h3>

                                <div class="card-tools">
                                    <form action="{{ route('news.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 300px;">
                                            {{--                                            <input type="date" class="form-control " name="start_date"--}}
                                            {{--                                                   value="{{ isset($_GET['start_date']) ? str_replace(' ', 'T', $_GET['start_date']) : '' }}">--}}
                                            {{--                                            <input type="date" class="form-control " name="end_date"--}}
                                            {{--                                                   value="{{ isset($_GET['end_date']) ? str_replace(' ', 'T', $_GET['end_date']) : '' }}">--}}

                                            <select name="status" class="custom-select form-control-borde">
                                                <option value="" selected>Կարգավիճակ</option>
                                                <option
                                                    value="{{ \App\Models\News::ACTIVE }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\News::ACTIVE ? 'selected' : '' }}>
                                                    Ակտիվ
                                                </option>
                                                <option
                                                    value="{{ \App\Models\News::INACTIVE }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\News::INACTIVE ? 'selected' : '' }}>
                                                    Պասիվ
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
                                            <a href="{{route('news.create')}}" class="btn btn-primary">Ավելացնել
                                                նորություն</a>
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
                                        <th>Ավելացման ամսաթիվ</th>
                                        <th>Կարգավիճակ</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($news as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->news_date }}</td>
                                            @if($item->status == \App\Models\News::ACTIVE)
                                                <td>
                                                    <i class="text-success">Ակտիվ</i>
                                                </td>
                                            @else
                                                <td>
                                                    <i class="text-danger">Պասիվ</i>
                                                </td>
                                            @endif
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if(auth()->user()->role == 'admin')
                                                    <a href="{{ route('news.edit', $item->id) }}" class="btn"
                                                       title="Edit details">
                                                        <i class="text-success nav-icon fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('news.destroy', $item->id) }}"
                                                          method="POST"
                                                          style="display: none"
                                                          onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել նորությունը')">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="#" onclick="$(this).prev().submit()" title="Delete">
                                                        <i class="text-danger nav-icon fas fa-trash"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('news.show', $item->id) }}" class="btn"
                                                   title="Show details">
                                                    <i class="text-success nav-icon fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $news->links() !!}
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
