@extends('layout.site')

@section('title','Home')

@section('conteudo')

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Equipes > Cadastrar Nova Equipe</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body"> 
                        <!-- Mensagens validação -->
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <!-- Área do Form-->
                        <form method="post" action="{{route('equipe.store')}}">
                            {{ csrf_field() }}
                            <!-- area de campos do form -->
                            <!-- 3 campos por linha -->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Digite o valor" value="">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="supervisor">Supervisor</label>
                                    <input type="text" class="form-control" name="supervisor" placeholder="Digite o valor" value="">
                                </div>                                                                
                            </div>
                            <!-- 4 campos por linha -->
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="sala">Sala</label>
                                        <input type="text" class="form-control" name="sala" placeholder="Digite a sala" value="">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="ramal">Ramal</label>
                                        <input type="text" class="form-control" name="ramal" placeholder="Digite o ramal" value="">
                                    </div>
                                                                        
                                </div>
                            <hr />
                            <div id="actions" class="row">
                                <!-- Div col-md-12 ocupa toda largura no grid -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i>&nbsp; Salvar</button>
                                    <a href="{{ route('equipe.create') }}" class="btn btn-default">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection