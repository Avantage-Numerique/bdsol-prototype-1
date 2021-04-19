
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
    <div class="row">
        <div class="col-12">
            <h2>Personnes</h2>
            @foreach($personnes as $personne)
                <article>
                    <div class="card">
                        <div class="card-body">
                            @if (!empty($personne->avatar))
                                <img class="w-50 img-avatar" src="{{asset('storage/persons/avatars/'.$personne->avatar)}}" alt="{{$personne->name}}" style="width: 100%; max-width: 30px; height: auto;" />
                            @endif
                            <span class="ml-3">{{$personne->name}}</span>
                        </div>
                    </div>
                </article>
            @endforeach
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
