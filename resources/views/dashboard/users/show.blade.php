@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Օգտատեր</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Օգտատեր</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row row justify-content-center">
                    <div class="col-md-8">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         @if(isset($user->avatar))
                                            src="{{ env('APP_URL'). '/storage/' . $user->avatar }}"
                                         @else
                                             @if($user->gender == 'male')
                                                src="{{ asset('/assets/dist/img/hePhoto.jpg') }}"
                                             @else
                                                src="{{ asset('/assets/dist/img/shePhoto.jpg') }}"
                                             @endif
                                         @endif
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $user->first_name . ' ' . $user->last_name }}</h3>

                                <p class="text-muted text-center">{{ $user->role }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Համար՝</b>
                                        <p class="float-right">{{ $user->number }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Անձնագրի համար՝</b>
                                        <p class="float-right">{{ $user->passport }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Էլ. հասցե՝</b> <a href="mailto:{{ $user->email }}"
                                                             class="float-right">{{ $user->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Հեռախոսահամար՝</b> <a href="tel:{{ $user->country_code . $user->phone }}"
                                                                 class="float-right">{{ $user->country_code . $user->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Հասցե՝</b>
                                        <p class="float-right">{{ $user->address }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Ծննդյան ամսաթիվ՝</b>
                                        <p class="float-right">{{ $user->birth_date }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Կարգավիճակ՝</b>
                                        <p class="float-right">{{ $user->status == 1 ? 'Ակտիվ' : 'Պասիվ' }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Դիմումների քանակ՝</b>
                                        <p class="float-right">{{ $user->reports->count() }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Գրանցման ամսաթիվ՝</b>
                                        <p class="float-right">{{ date('Y-m-d', strtotime($user->created_at)) }}</p>
                                    </li>
                                </ul>
                                {{--                                <a onclick="window.print()"><i class="fal fa-print"></i> Natisni oglas</a>--}}

                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
