@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Օգտատերերի ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Օգտատերերի ցուցակ</li>
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
                                <h3 class="card-title">Օգտատերեր</h3>

                                <div class="card-tools">
                                    <form action="{{ route('users.index') }}" method="GET">
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

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Համար</th>
                                        <th>Անուն</th>
{{--                                        <th>Էլ․ հասցե</th>--}}
                                        <th>Հեռախոսահամար</th>
                                        <th>Ծննդյան ամսաթիվ</th>
                                        <th>Դեր</th>
                                        <th>Կարգավիճակ</th>
                                        <th>Ավելացվել է</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ isset($user->number) ? \Illuminate\Support\Facades\Crypt::decrypt($user->number) : '' }}</td>
                                            <td>
                                                <a target="_blank" href="{{ route('users.show', $user->id) }}"
                                                   title="Show details">
                                                    {{ $user->first_name . ' ' . $user->last_name . ' ' . $user->surname }}
                                                </a>
                                            </td>
{{--                                            <td>{{ $user->email }}</td>--}}
                                            <td>{{ $user->country_code . $user->phone }}</td>
                                            <td>{{ $user->birth_date }}</td>
                                            <td>{{ $user->role }}</td>
                                            @if($user->status == 1)
                                                <td>
                                                    <i class="text-success">Ակտիվ</i>
                                                </td>
                                            @else
                                                <td>
                                                    <i class="text-danger">Պասիվ</i>
                                                </td>
                                            @endif
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}" class="btn"
                                                   title="Show details">
                                                    <i class="text-success nav-icon fas fa-eye"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $users->links() !!}
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
