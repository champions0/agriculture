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

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none"></h3>

                            <div class="col-12">
                                @if(count($news->images))
                                    <img src="{{ \App\Services\FileServices::getImageAttribute($news->images[0]['path']) }}"
                                         class="product-image"
                                         alt="Product Image"
                                         style="object-fit: contain; height: 500px;"
                                    >
                                    @else
                                    Նկարներ չկան
                                @endif
                            </div>
                            <div class="col-12 product-image-thumbs">
                                @if(count($news->images))
                                    @foreach($news->images as $image)
                                    <div class="product-image-thumb {{ $loop->first ? 'active' : '' }}"><img
                                            src="{{ \App\Services\FileServices::getImageAttribute($image->path) }}" alt="Product Image"></div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">Տվյալներ</h3>
                            @if( $news->wallpaper )
                            <hr>
                                <div>
                                    <img src="{{ \App\Services\FileServices::getImageAttribute($news->wallpaper) }}"
                                            alt="Product Image"
                                            style="object-fit: contain; height: 90px;"
                                    >
                                </div>
                            @endif
                            <hr>
                            <h4>Կարգավիճակ՝</h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <input type="hidden" class="fast_question_id" name="fast_question_id"
                                        value="{{ $news->id }}">
                                @if($news->status == \App\Models\News::INACTIVE)
                                    <p class="float-right text-warning">Պասիվ</p>
                                @elseif($news->status == \App\Models\News::ACTIVE)
                                    <p class="float-right text-success">Ակտիվ</p>
                                @endif
                            </div>

                            <h4 class="mt-3">Ավելացման ամսաթիվը՝</h4>
                            <div class="btn-group">
                                <p class="float-right">{{ $news->news_date }}</p>
                            </div>

                            <h4 class="mt-3">Նկարագրությունր՝</h4>
                            <div class="btn-group">
                                <p class="float-right">{{ $news->description }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->



        </section>
    </div>
@endsection
