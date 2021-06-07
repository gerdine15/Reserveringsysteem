@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row title-wrap">
        <div class="col-md-12">
            <h1>
                Gegevens
                <input type="hidden" id="user_id" value="{{ $user->id }}">
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="firstname" class="font-weight-bold">
                            Voornaam:
                        </label>

                        <div>
                            {{ $user->firstname }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prefix" class="font-weight-bold">
                            Tussenvoegsel:
                        </label>

                        <div>
                            {{ $user->prefix ?? 'N.V.T' }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastname" class="font-weight-bold">
                            Achternaam:
                        </label>

                        <div>
                            {{ $user->lastname }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="member" class="font-weight-bold">
                            Lidnummer:
                        </label>

                        <div>
                            {{ $user->member ?? 'N.V.T' }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="font-weight-bold">
                            E-mailadres:
                        </label>

                        <div>
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="club" class="font-weight-bold">
                            Clubnummer:
                        </label>

                        <div>
                            {{ $user->club->name }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        @if ($user->picture)
                            <img class="w-50 p-1 userPicture rounded-circle border border-dark" src="{{ route('get_user_image', ['id' => $user->id, 'filename' => $user->picture]) }}" alt="" id="userPicture">

                            <button id="deleteUserPicture" type="button" class="deleteUserPictureBtn"><i class='fas fa-trash'></i></button>

                            <input type="file" id="addUserPictureFile" name="picture" class="d-none deleteUserPhotoFile">
                        @else
                            <form id="addProfilePhoto" class="mb-0" enctype="multipart/form-data" method="POST" action="{{ route('save_user_image', ['user' => $user]) }}">
                                @csrf
                                @method('PUT')
                                <input id="addNewUserPictureFile" type="file" name="picture">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
