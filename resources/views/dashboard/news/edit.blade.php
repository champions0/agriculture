@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Խմբագրել նորությունը</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Խմբագրել նորությունը</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-body">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h1 class="card-title">Խմբագրել նորությունը</h1>
                                </div>

                                <form
                                    action="{{ route('news.update', $news->id) }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @method('PATCH')

                                    @include('dashboard.news.includes.form', compact('news'))
                                    <div class="card-footer col-md-12">
                                        <button type="submit" class="btn btn-primary">Հաստատել</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
