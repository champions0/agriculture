@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Դիմում</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Դիմում</a></li>
                            <li class="breadcrumb-item active">Դիմում</li>
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

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Օգտատեր՝</b>
                                        <p class="float-right">
                                            <a target="_blank" href="{{ route('users.show', $report->user->id) }}"
                                               title="Show details">
                                                {{ $report->user->first_name . ' ' . $report->user->last_name }}
                                            </a>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Վերնագիր՝</b>
                                        <p class="float-right">{{ $report->title ?? '' }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Բովանդակություն՝</b>
                                        <p class="float-right">{{ isset($report->text) ? $report->text : '' }}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Կցված ֆայլեր՝</b>
                                        <p class="float-right">
                                            @foreach($report->files as $file)
                                                <a target="_blank" href="{{ \App\Services\FileServices::getImageAttribute($file->path) }}">
                                                    <i class="nav-icon fas fa-file"></i>
                                                    <span>Ֆայլ{{ $loop->index + 1 }}</span>
                                                </a><br>
                                            @endforeach
                                        </p>
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
