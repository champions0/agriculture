@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Արագ հարցերի ցուցակ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Արագ հարցերի ցուցակ</li>
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
                                <h3 class="card-title">Արագ հարցեր</h3>

                                <div class="card-tools">
                                    <form action="{{ route('fast-questions.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 900px;">

                                            <input type="date" class="form-control " name="start_date"
                                                   value="{{ isset($_GET['start_date']) ? str_replace(' ', 'T', $_GET['start_date']) : '' }}">
                                            <input type="date" class="form-control " name="end_date"
                                                   value="{{ isset($_GET['end_date']) ? str_replace(' ', 'T', $_GET['end_date']) : '' }}">

                                            <select name="category_id" class="custom-select form-control-borde">
                                                <option value="" selected>Կատեգորիաներ</option>
                                                @foreach($categories as $key => $category)
                                                    <option value="{{ $key }}" {{ isset($_GET['category_id']) && $_GET['category_id'] == $key ? 'selected' : '' }}>{{ $category }}</option>
                                                @endforeach
                                            </select>

                                            <select name="status" class="custom-select form-control-borde">
                                                <option value="" selected>Կարգավիճակ</option>
                                                <option
                                                    value="{{ \App\Models\FastQuestion::PENDING }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\FastQuestion::PENDING ? 'selected' : '' }}>
                                                    Ընթացիկ
                                                </option>
                                                <option
                                                    value="{{ \App\Models\FastQuestion::SUCCESS }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\FastQuestion::SUCCESS ? 'selected' : '' }}>
                                                    Լուծված
                                                </option>
                                                <option
                                                    value="{{ \App\Models\FastQuestion::DECLINE }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\FastQuestion::DECLINE ? 'selected' : '' }}>
                                                    Մերժված
                                                </option>
                                                <option
                                                    value="{{ \App\Models\FastQuestion::REVIEW }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\FastQuestion::REVIEW ? 'selected' : '' }}>
                                                    Վերանայման ենթական
                                                </option>
                                                <option
                                                    value="{{ \App\Models\FastQuestion::NOTFOUND }}" {{ isset($_GET['status']) && $_GET['status'] == \App\Models\FastQuestion::NOTFOUND ? 'selected' : '' }}>
                                                    Չի գտնվել
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
                                        <th>Համար</th>
                                        <th>Օգտատեր</th>
                                        <th>Կատեգորիա</th>
                                        <th>Հասցե</th>
                                        <th>Կարգավիճակ</th>
                                        <th>Ավելացվել է</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fastQuestions as $fastQuestion)
                                        <tr>
                                            <td class="fast_question_id">{{ $fastQuestion->id }}</td>
                                            <td>{{ $fastQuestion->number }}</td>
                                            <td>
                                                @if($fastQuestion->is_anonymous)
                                                    @if(auth()->user()->role == 'municipality')
                                                        Անանուն
                                                    @else
                                                        <a target="_blank"
                                                           href="{{ route('users.show', $fastQuestion->user->id) }}"
                                                           title="Show details">
                                                            {{ $fastQuestion->user->first_name . ' ' . $fastQuestion->user->last_name }}
                                                        </a>(Անանուն)
                                                    @endif
                                                @else
                                                    <a target="_blank"
                                                       href="{{ route('users.show', $fastQuestion->user->id) }}"
                                                       title="Show details">
                                                        {{ $fastQuestion->user->first_name . ' ' . $fastQuestion->user->last_name }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $fastQuestion->category->name }}</td>
                                            <td>{{ $fastQuestion->address }}</td>
                                            <td>
                                                <input type="hidden" class="fast_question_id" name="fast_question_id"
                                                       value="{{ $fastQuestion->id }}">
                                                @if(auth()->user()->role == 'municipality')
                                                    <select name="status_fast_change"
                                                            class="custom-select form-control-borde fast_status_change">
                                                        <option
                                                            {{ $fastQuestion->status == \App\Models\FastQuestion::PENDING ? 'selected' : '' }} value="{{ \App\Models\FastQuestion::PENDING }}">
                                                            Ընթացիկ
                                                        </option>
                                                        <option
                                                            {{ $fastQuestion->status == \App\Models\FastQuestion::SUCCESS ? 'selected' : '' }} value="{{ \App\Models\FastQuestion::SUCCESS }}">
                                                            Լուծված
                                                        </option>
                                                        <option
                                                            {{ $fastQuestion->status == \App\Models\FastQuestion::DECLINE ? 'selected' : '' }} value="{{ \App\Models\FastQuestion::DECLINE }}">
                                                            Մերժված
                                                        </option>
                                                        <option
                                                            {{ $fastQuestion->status == \App\Models\FastQuestion::REVIEW ? 'selected' : '' }} value="{{ \App\Models\FastQuestion::REVIEW }}">
                                                            Վերանայման ենթական
                                                        </option>
                                                        <option
                                                            {{ $fastQuestion->status == \App\Models\FastQuestion::NOTFOUND ? 'selected' : '' }} value="{{ \App\Models\FastQuestion::NOTFOUND }}">
                                                            Չի գտնվել
                                                        </option>
                                                    </select>
                                                @else
                                                    @if($fastQuestion->status == \App\Models\FastQuestion::PENDING)
                                                        <p class="text-secondary">Դիտարկվող</p>
                                                    @elseif($fastQuestion->status == \App\Models\FastQuestion::SUCCESS)
                                                        <p class="text-success">Հաստատված</p>
                                                    @elseif($fastQuestion->status == \App\Models\FastQuestion::DECLINE)
                                                        <p style="cursor: pointer;"
                                                           class="text-danger decline_fast_message">
                                                            Մերժված <i class="nav-icon fas fa-info-circle"></i>
                                                        </p>
                                                    @elseif($fastQuestion->status == \App\Models\FastQuestion::NOTFOUND)
                                                        <p class="text-warning">
                                                            Չգտնված</p>
                                                    @endif

                                                @endif
                                            </td>

                                            <td>{{ $fastQuestion->created_at }}</td>
                                            <td>
                                                <a href="{{ route('fast-questions.show', $fastQuestion->id) }}"
                                                   class="btn"
                                                   title="Show details">
                                                    <i class="text-success nav-icon fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $fastQuestions->links() !!}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

        {{--        Description Fast modal--}}
        <div class="modal fade" id="descriptionFastModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Նկարագրություն</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @if(auth()->user()->role == 'municipality')
                        <form action="{{ route('fast-question.decline') }}" method="POST">
                            @csrf

                            <div class="modal-body">
                                <input id="fastQuestionId" type="hidden" name="fast_question_id" value="">
                                <textarea required placeholder="Մերժման պատճառը" name="decline_description" rows="5"
                                          style="width: 100%;"></textarea>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
                                <button type="submit" class="btn btn-primary">Հաստատել</button>
                            </div>
                        </form>
                    @else
                        <div class="modal-body">
                            <p id="showFastDescription"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
@endsection

