@extends('layouts.app')

@section('content')
<div class="panel panel-default">
   <div class="panel-heading">
       Usuários descartados
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
                    Restaurar
                </th>
                <th>
                   Excluir permanentemente
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
                          <a href="{{ route('user.restore', ['id' => $user->id ]) }}" class="btn btn-sm btn-success">Restaurar</a>
                        </td>
                         <td>
                          <a href="{{ route('user.kill', ['id' => $user->id ]) }}" class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                   </tr>
               @endforeach
               
               @else
                   <tr>
                       <th colspan="5" class="text-center">Nenhum usuário descartado.</th>
                   </tr>
               @endif
            </tbody>
        </table>  
    </div>
</div>
@stop
