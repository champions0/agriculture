@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Շտապ հարց</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Շտապ հարց</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none"></h3>

                            <div class="col-12">
                                @if(count($fastQuestion->images))
                                    <img src="{{ \App\Services\FileServices::getImageAttribute($fastQuestion->images[0]['path']) }}" class="product-image"
                                         alt="Product Image">
                                    @else
                                    Նկարներ չկան

                                @endif
                            </div>
                            <div class="col-12 product-image-thumbs">
                                @if(count($fastQuestion->images))
                                    @foreach($fastQuestion->images as $image)
                                    <div class="product-image-thumb {{ $loop->first ? 'active' : '' }}"><img
                                            src="{{ \App\Services\FileServices::getImageAttribute($image->path) }}" alt="Product Image"></div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">Տվյալներ</h3>
                            <hr>
                            <h4>Կարգավիճակ՝</h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
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
                                        <p class="text-warning">Ընթացիկ</p>
                                    @elseif($fastQuestion->status == \App\Models\FastQuestion::SUCCESS)
                                        <p class="text-success">Լուծված</p>
                                    @elseif($fastQuestion->status == \App\Models\FastQuestion::DECLINE)
                                        <p class="text-danger">Մերժված</p>
                                    @elseif($fastQuestion->status == \App\Models\FastQuestion::REVIEW)
                                        <p class="text-danger">Վերանայման ենթական</p>
                                    @else
                                        <p class="text-danger">Չի գտնվել</p>
                                    @endif

                                @endif


                            </div>
                            @if($fastQuestion->status == \App\Models\FastQuestion::DECLINE)
                                <h6 class="mt-3">Մերժման պատճառը՝</h6>
                                <div class="btn-group">

                                    <p>{{ $fastQuestion->decline_description ?? '' }}</p>

                                </div>
                            @endif

                            <h4 class="mt-3">Կատեգորիա՝</h4>
                            <div class="btn-group">
                                <p>{{ $fastQuestion->category->name }}</p>

                            </div>

                            <h4 class="mt-3">Հասցե՝</h4>
                            <div class="btn-group">
                                <p>{{ $fastQuestion->address }}</p>
                            </div>

                            <h4 class="mt-3">Օգտատեր՝</h4>
                            <div class="btn-group">
                                @if($fastQuestion->is_anonymous)
                                    @if(auth()->user()->role == 'municipality')
                                        <p>Անանուն</p>
                                    @else
                                        <a target="_blank"
                                           href="{{ route('users.show', $fastQuestion->user->id) }}"
                                           title="Show details">
                                            {{ $fastQuestion->user->first_name . ' ' . $fastQuestion->user->last_name }}
                                        </a>(Անանուն)
                                    @endif
                                @else
                                    <p>
                                        <a href="{{ route('users.show', $fastQuestion->user->id) }}"
                                           target="_blank">
                                            {{ $fastQuestion->user->first_name . ' ' . $fastQuestion->user->last_name }}
                                        </a>
                                    </p>
                                @endif
                            </div>

                            <h4 class="mt-3">Նկարագրություն՝</h4>
                            <div class="btn-group">
                                <p>{{ $fastQuestion->description }}</p>

                            </div>

                            <h4 class="mt-3">Ավելացվել է՝</h4>
                            <div class="btn-group">
{{--                                <p>{{ date('Y-m-d', strtotime($fastQuestion->created_at)) }}</p>--}}
                                <p>{{ $fastQuestion->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>


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
    </div>
@endsection
