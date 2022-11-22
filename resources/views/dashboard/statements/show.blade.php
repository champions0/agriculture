@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Միջոցառում</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Միջոցառում</li>
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
                                    <img class=""
                                         @if(isset($event->wallpaper))
                                         {{--                                            src="{{ env('APP_URL'). '/storage/' . $user->avatar }}"--}}
                                         src="{{ \App\Services\FileServices::getImageAttribute($event->wallpaper) }}"
                                         @else
                                         src="{{ asset('/assets/dist/img/hePhoto.jpg') }}"

                                         {{--                                             @if($user->gender == 'female')--}}
                                         {{--                                                 src="{{ asset('/assets/dist/img/shePhoto.jpg') }}"--}}

                                         {{--                                             @else--}}
                                         {{--                                                 src="{{ asset('/assets/dist/img/hePhoto.jpg') }}"--}}
                                         {{--                                             @endif--}}
                                         @endif
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $event->title }}</h3>

                                <p class="text-muted text-center">{{ $event->subject->name }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Կազմակերպիչը՝</b>
                                        <p class="float-right">{{ $event->organizer }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Տարիքային սահմանափակումը՝</b>
                                        <p class="float-right">{{ $event->age }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Սեռը՝</b>
                                        <p class="float-right">
                                            @if($event->gender == 'male')
                                                Տղաներ
                                            @elseif($event->gender == 'female')
                                                Աղջիկներ
                                            @else
                                                Բոլորը
                                            @endif
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Սկիզբը՝</b>
                                        <p class="float-right">{{ $event->start_date }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Ավարտը՝</b>
                                        <p class="float-right">{{ $event->end_date }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Հասցեն՝</b>
                                        <p class="float-right">{{ $event->address }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Բնակավայրերը՝</b>
                                        <p class="float-right">
                                            @foreach($event->residences as $residence)
                                                {{ $residence->residence->name }}<br>
                                            @endforeach
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Լրացուցիչ տեղեկություններ՝</b>
                                        <p class="float-right">{{ $event->additional_info }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Կարճ նկարագրություն՝</b>
                                        <p class="float-right">{{ $event->short_description }}</p>
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
