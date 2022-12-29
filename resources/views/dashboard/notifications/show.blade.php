@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Հաղորթագևություն</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Հաղորթագևություն</li>
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

                                <h3 class="profile-username text-center">{{ $notification->title }}</h3>


                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Տեսակ՝</b>
                                        <p class="float-right">{{ isset($notification->type) && $notification->type == \App\Models\Notification::TAX ? 'Հարկային' : 'Տեսակավորված չէ' }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Նկարագրություն՝</b>
                                        <p class="float-right">{{ $notification->description }}</p>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Կարգավիճակ՝</b>

                                        @if($notification->status == 1)
                                            <p class="float-right">Կարդացված</p>
                                        @elseif($notification->status == 0)
                                            <p class="float-right">Նոր</p>
                                        @else
                                            <p class="float-right">Բացված</p>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <b>Գրանցման ամսաթիվ՝</b>
                                        <p class="float-right">{{ date('Y-m-d', strtotime($notification->created_at)) }}</p>
                                    </li>
                                </ul>
                                {{--                                <a onclick="window.print()"><i class="fal fa-print"></i> Natisni oglas</a>--}}

                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
