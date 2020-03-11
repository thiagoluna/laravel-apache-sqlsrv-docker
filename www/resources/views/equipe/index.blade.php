@extends('layout.site')

@section('title','Home')

@section('conteudo')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Equipes - Laravel</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">                            
                            <div id="top" class="row"> 
                                <!-- Botão Novo -->
                                <div class="col-md-3">
                                    <a href="{{ route('equipe.create') }}" class="btn btn-primary pull-left h2">
                                        <i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Nova Equipe</a>
                                </div>                            
                                <!-- Form Busca -->
                                <div class="col-md-6">
                                    <form action="{{ route('equipe.busca') }}" method="post">   
                                        <div class="input-group h2">                                        
                                                {{ csrf_field() }}
                                                <input name="criterio" class="form-control" id="criterio" type="text" placeholder="Pesquisar Equipes" 
                                                    @if(isset($criterio))    
                                                        value="{{ $criterio }}">
                                                    @else
                                                        value="">
                                                    @endif
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" type="submit">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                </span>                                
                                        </div>
                                    </form>
                                </div>                                           
                            </div> <!-- /#top -->
                            <hr />
                        </div>
                    </div>
                    <!-- BASIC TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Lista das Equipes Cadastradas</h3>
                        </div>
                        <div class="panel-body">
                            <!-- Listagem dos itens do bd -->
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div id="list" class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-striped" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Supervisor</th>
                                                <th>Sala</th>
                                                <th>Ramal</th>
                                                <th class="actions">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <!-- Listar dados do bd -->                                            
                                            @foreach ($equipes as $equipe)                                                                                            
                                                <tr>
                                                    <td>{{ $equipe->id }}</td>
                                                    <td>{{ $equipe->nome }}</td>
                                                    <td>{{ $equipe->supervisor }}</td>
                                                    <td>{{ $equipe->sala }}</td>
                                                    <td>{{ $equipe->ramal }}</td>
                                                    <td class="actions">
                                                        <a class="btn btn-success btn-xs" href="{{route('equipe.edit', $equipe->id)}}">
                                                            <i class="glyphicon glyphicon-edit"></i>&nbsp; Editar
                                                        </a>                                                    
                                                        <form style="display: inline-block;" method="POST" action="{{route('equipe.destroy', $equipe->id)}}"                                                        
                                                            data-toggle="tooltip" data-placement="top" title="Excluir" onsubmit="return confirm('Confirma exclusão?')">
                                                                {{method_field('DELETE')}}{{ csrf_field() }}                                                
                                                                <button type="submit" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>&nbsp; Excluir</button>
                                                        </form>
                                                    </td>
                                                </tr>                                                                                                                                     
                                            @endforeach
                                        </tbody>                                        
                                    </table>                                             
                                </div>
                            </div> <!-- /#listagem --> 
                            
                            <!-- Paginação -->    
                            @if(isset($criterio))
                                {{ $equipes->appends(['criterio' => $criterio])->links() }}
                            @else
                                {!! $equipes->links() !!}
                            @endif                                                                          
                        </div>
                    </div>
                    <!-- END BASIC TABLE -->
                </div>               
            </div>				
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->



@endsection