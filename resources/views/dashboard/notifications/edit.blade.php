@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Խմբագրել Հաղորդագրությունը</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Գլխավոր</a></li>
                            <li class="breadcrumb-item active">Խմբագրել Հաղորդագրությունը</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-header">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Հաղորդագրություն</h3>
                </div>
                <form action="{{ route('notifications.update', $notifications->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('dashboard.notifications.includes.form', compact('notification'))
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Հաստատել</button>
                        <a href="#" type="button" class="btn btn-danger" onclick="$('#delete-notification').submit()"
                           title="delete">Ջնջել</a>
                    </div>
                </form>
                <form id="delete-notification" action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                      style="display: none"
                      onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել հաղորդագրությունը')">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

        </section>
    </div>

@endsection
