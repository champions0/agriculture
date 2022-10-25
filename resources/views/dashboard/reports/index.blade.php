@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Դիմումների ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Դիմումների ցուցակ</li>
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
                                <h3 class="card-title">Դիմումներ</h3>

                                <div class="card-tools">
                                    <form action="{{ route('reports.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 750px;">

                                            <input type="date" class="form-control " name="start_date"
                                                   value="{{ isset($_GET['start_date']) ? str_replace(' ', 'T', $_GET['start_date']) : '' }}">
                                            <input type="date" class="form-control " name="end_date"
                                                   value="{{ isset($_GET['end_date']) ? str_replace(' ', 'T', $_GET['end_date']) : '' }}">

                                            <select name="status" class="custom-select form-control-borde">
                                                <option value="" selected>Կարգավիճակ</option>
                                                <option
                                                    value="{{ \App\Models\Report::PENDING }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\Report::PENDING ? 'selected' : '' }}>
                                                    Դիտառրվող
                                                </option>
                                                <option
                                                    value="{{ \App\Models\Report::SUCCESS }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\Report::SUCCESS ? 'selected' : '' }}>
                                                    Հաստատված
                                                </option>
                                                <option
                                                    value="{{ \App\Models\Report::DECLINE }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\Report::DECLINE ? 'selected' : '' }}>
                                                    Մերժված
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

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Օգտատեր</th>
                                        <th>Վերնաագիր</th>
                                        <th>Կարգավիճակ</th>
                                        <th>PDF</th>
                                        <th>Ավելացվել է</th>
{{--                                        <th>Գործողություններ</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reports as $report)
                                        <tr>
                                            <td class="report_id">{{ $report->id }}</td>
                                            <td>{{ $report->user->first_name . ' ' . $report->user->last_name }}</td>
                                            <td>{{ $report->title }}</td>
                                            <td>
                                                <select name="status_change" id="status_change" class="custom-select form-control-borde">
                                                    <option {{ $report->status == \App\Models\Report::PENDING ? 'selected' : '' }} value="{{ \App\Models\Report::PENDING }}">Դիտարկվող</option>
                                                    <option {{ $report->status == \App\Models\Report::SUCCESS ? 'selected' : '' }} value="{{ \App\Models\Report::SUCCESS }}">Հաստատված</option>
                                                    <option {{ $report->status == \App\Models\Report::DECLINE ? 'selected' : '' }} value="{{ \App\Models\Report::DECLINE }}">Մերժված</option>
                                                </select>

{{--                                                @if($report->status == \App\Models\Report::PENDING)--}}
{{--                                                    <p class="text-warning">Դիտարկվող</p>--}}
{{--                                                @elseif($report->status == \App\Models\Report::SUCCESS)--}}
{{--                                                    <p class="text-success">Հաստատված</p>--}}
{{--                                                @else--}}
{{--                                                    <p class="text-danger">Մերժված</p>--}}
{{--                                                @endif--}}
                                            </td>
                                            <td>
                                                <form action="{{ route('reports.downloadPDF') }}" method="POST" formtarget="_blank" target="_blank">
                                                    @csrf
                                                    <input type="hidden" name="report_id" value="{{ $report->id }}">
                                                    <button type="submit" class="btn btn-info">Ներբեռնել</button>
                                                </form>
                                            </td>
                                            <td>{{ $report->created_at }}</td>
{{--                                            <td>--}}
{{--                                                <a href="{{ route('reports.edit', $report->id) }}" class="btn"--}}
{{--                                                   title="Edit details">--}}
{{--                                                    <i class="text-success nav-icon fas fa-edit"></i>--}}
{{--                                                </a>--}}

{{--                                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST"--}}
{{--                                                      style="display: none"--}}
{{--                                                      onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել դիմումը?')">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                </form>--}}
{{--                                                <a href="#" onclick="$(this).prev().submit()" title="Delete">--}}
{{--                                                    <i class="text-danger nav-icon fas fa-trash"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $reports->links() !!}
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

