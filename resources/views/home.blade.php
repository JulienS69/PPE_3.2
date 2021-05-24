<!-- Vue qui consiste à afficher le tableau de bord "Vous êtes connecté en tant que..." -->

@extends('layouts.app')

<head>
    <link rel="icon" href="{{asset('images/pill.ico')}}">
</head>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tableau de bord') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('Vous êtes actuellement connecté en tant que Visiteur Médicale') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
