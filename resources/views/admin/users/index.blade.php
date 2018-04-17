@extends('layouts.app')

@section('content')
<div class="panel panel-default">
   <div class="panel-heading">
       Usuários
   </div>
    <div class="panel-body">
          <table class="table table-hover">
            <thead>
                <th>
                   Avatar
                </th>
                <th>
                    Nome
                </th>
                <th>
                    Bio
                </th>
                <th>
                    Editar
                </th>
                <th>
                    Administrador
                </th>
                <th>
                    Descartar
                </th>
            </thead>
            <tbody>
              @if($users->count() > 0)
              
               @foreach($users as $user)
                   <tr>
                        <td>
                            <img src="{{ asset($user->profile->avatar) }}" width="60px" height="60px" style="border-radius:50%;">
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->profile->about }}
                        </td> 
                        <td>
                            <a href="{{ route('user.profile.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-success">Editar</a>
                        </td>
                        <td>
                            @if($user->admin)
                                <a href="{{ route('user.admin', ['id' => $user->id])}}" class="btn btn-sm btn-danger">OFF</a>
                            @else    
                                <a href="{{ route('user.not.admin', ['id' => $user->id]) }}" class="btn btn-sm btn-success">ON</a>
                            @endif
                        </td>
                        <td>
                          @if(Auth::user()->id != $user->id)
                               <a href="{{ route('user.delete', ['id' => $user->id ]) }}" class="btn btn-sm btn-danger">Descartar</a>
                          @endif
                        </td>
                   </tr>
               @endforeach
               
               @else
                   <tr>
                       <th colspan="5" class="text-center">Nenhum usuário criado.</th>
                   </tr>
               @endif
            </tbody>
        </table>  
    </div>
</div>
@stop
