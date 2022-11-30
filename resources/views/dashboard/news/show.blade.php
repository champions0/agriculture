@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Նորություն</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Նորություն</li>
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
                                         @if(isset($news->wallpaper))
                                         {{--                                            src="{{ env('APP_URL'). '/storage/' . $user->avatar }}"--}}
                                         src="{{ \App\Services\FileServices::getImageAttribute($news->wallpaper) }}"
                                         @else
                                         src="{{ asset('/assets/dist/img/noImage.jpg') }}"
                                         @endif
                                         alt="Statement profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $news->title }}</h3>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Ավելացման ամսաթիվը՝</b>
                                        <p class="float-right">{{ $news->news_date }}</p>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Նկարագրությունր՝</b>
                                        <p class="float-right">{{ $news->description }}</p>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Կարգավիճակը՝</b>
                                        @if($news->status == \App\Models\News::INACTIVE)
                                            <p class="float-right text-warning">Պասիվ</p>
                                        @elseif($news->status == \App\Models\News::ACTIVE)
                                            <p class="float-right text-success">Ակտիվ</p>
                                        @endif
                                    </li>
                                </ul>
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
