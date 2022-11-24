@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Հայտարարություն</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Հայտարարություն</li>
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
                                         @if(isset($statement->wallpaper))
                                         {{--                                            src="{{ env('APP_URL'). '/storage/' . $user->avatar }}"--}}
                                         src="{{ \App\Services\FileServices::getImageAttribute($statement->wallpaper) }}"
                                         @else
                                         src="{{ asset('/assets/dist/img/noImage.jpg') }}"
                                         @endif
                                         alt="Statement profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $statement->title }}</h3>

{{--                                <p class="text-muted text-center">{{ $statement->subject->name }}</p>--}}

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Հայտարարողի աանունը՝</b>
                                        <p class="float-right">{{ $statement->declarant_first_name }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Հայտարարողի ազգանունը՝</b>
                                        <p class="float-right">{{ $statement->declarant_last_name }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Հայտարարման ամսաթիվը՝</b>
                                        <p class="float-right">{{ $statement->statement_date }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Վերջնաժամկետը՝</b>
                                        <p class="float-right">{{ $statement->deadline }}</p>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Նկարագրությունր՝</b>
                                        <p class="float-right">{{ $statement->description }}</p>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Կարգավիճակը՝</b>
                                        @if($statement->status == \App\Models\Statement::INACTIVE)
                                            <p class="float-right text-warning">Պասիվ</p>
                                        @elseif($statement->status == \App\Models\Statement::ACTIVE)
                                            <p class="float-right text-success">Ակտիվ</p>
                                        @elseif($statement->status == \App\Models\Statement::CANCELED)
                                            <p class="float-right text-danger">Ավարտված</p>
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
