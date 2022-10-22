@extends('.dashboard.layouts.app')
<script>

    {{--setTimeout(function () {--}}
    {{--    drawGraph({{$data_users}},{{$data_months}},"bar","Uporabniki");--}}
    {{--    drawGraph({{$data_listings}},{{$data_months_listings}},"line","Ogalsi");--}}
    {{--}, 3000);--}}

</script>
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            {{-- {{dd($data_months)}} --}}
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ադմինիստրատորի վահանակ</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                            <li class="breadcrumb-item active">Գլխավոր</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <p>Բոլոր օգտատերերը՝</p>
                                <h3>{{ $allUsers }}</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('users.index') }}" class="small-box-footer">Դիտել ամբողջը <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <p>Ակտիվ օգտատերերը՝</p>
                                <h3>{{ $activeUsers }}</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('users.index', ['status' => 1]) }}" class="small-box-footer">Դիտել ամբողջը
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <p>Բոլոր դիմումները՝</p>
                                <h3>{{ $allReports }}</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('reports.index') }}" class="small-box-footer">Դիտել ամբողջը <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <p>Դիտարկվող դիմումները՝</p>
                                <h3>{{ $pendingReports }}</h3>

                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('reports.index', ['status' => \App\Models\Report::PENDING]) }}" class="small-box-footer">Դիտել ամբողջը <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <p>Հաստատվծ դիմումները՝</p>
                                <h3>{{ $successReports }}</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('reports.index', ['status' => \App\Models\Report::SUCCESS]) }}" class="small-box-footer">Դիտել ամբողջը <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <p>Մերժված դիմումները՝</p>
                                <h3>{{ $declineReports }}</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('reports.index', ['status' => \App\Models\Report::DECLINE]) }}" class="small-box-footer">Դիտել ամբողջը <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <div class="small-box bg-info">--}}
{{--                            <div class="inner">--}}
{{--                                --}}{{--                                <h3>{{ $totalRevenue }}</h3>--}}

{{--                                <p>Total Daily Revenue</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-bag"></i>--}}
{{--                            </div>--}}
{{--                            --}}{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </section>
    </div>
@endsection
