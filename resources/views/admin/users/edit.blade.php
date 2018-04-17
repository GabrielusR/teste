@extends('layouts.app')


@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        Editar seu perfil
    </div>
    
    <div class="panel-body">
        <form action="{{ route('user.profile.store') }}" method='post' enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $user->id }}">
            
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>
             <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input type="password" name="password"  class="form-control">
            </div>
            <div class="form-group">
                <label for="about">Bio</label>
                <textarea name="about" id="bio" cols="6" rows="6" class="form-control">{{ $user->profile->about }}</textarea>
            </div>
             <div class="form-group">
                <label for="avatar">Atualizar avatar</label>
                 <div>
                    <img src="{{ asset($user->profile->avatar) }}" width="20%" height="20%">
                </div>
                <input type="file" name="avatar" value="{{ $user->profile->avatar }}" class="form-control">
            </div>
            <div class="form-group">
               <div class="text-center">
                    <button class="btn btn-success" type="submit">
                        Atualizar
                    </button>
               </div>
            </div>
        </form>
    </div>
</div>

@stop


@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@stop


@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<script>
    $(document).ready(function() {
        $('#bio').summernote();
    });
</script>
@stop