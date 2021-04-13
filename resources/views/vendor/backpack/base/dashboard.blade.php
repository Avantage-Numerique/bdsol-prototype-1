
@extends(backpack_view('blank'))


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <figure>
                        <img src="{{asset('images/avantage-numerique-noire-nopadding.svg')}}" alt="{{config('app.name')}}" class="w-25" />
                    </figure>
                </div>
            </div>
        </div>

    </div>

@endsection

@php
    /*$widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => trans('backpack::base.welcome'),
        'content'     => trans('backpack::base.use_sidebar'),
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];*/
@endphp
