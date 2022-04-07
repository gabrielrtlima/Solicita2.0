@extends('layouts.app')

@section('conteudo')
    <!-- @section('navbar2.blade.php')
    Home
@endsection -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="row tituloFicha">
                <div class="col-md-12">
                    Ficha Catalográfica -
                    @if($tipo_documento == 2)Monografia
                    @elseif($tipo_documento == 4)Tese
                    @elseif($tipo_documento == 3)Produto Educacional
                    @elseif($tipo_documento == 1)Dissertação
                    @endif
                </div>
            </div>
            <form method="POST" enctype="multipart/form-data" id="formRequisicao"
                  action="">
                @csrf
                <input type="hidden" name="tipo_documento" value="{{$tipo_documento}}">

                <! –– Dados Pessoais ––>

                <div class="col-md-12 corpoFicha shadow my-4">
                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Dados Pessoais</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group py-2">
                                <label class="textoFicha" for="exampleFormControlInput1">Nome<span
                                        style="color: red">*</span>:</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                       placeholder="Nome"
                                       value="{{\App\Models\User::where('id', $aluno->user_id)->first()->name}}"
                                       disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dados para o bibliotecario -->

                <div class="col-md-12 corpoFicha shadow my-4">
                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Dados para o Bibliotecário(a)</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 py-2 textoFicha">
                            <div class="form-group">
                                <label for="cutter">Cutter: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="cutter" name="cutter"
                                       value="" placeholder="Digite o código de Cutter" required>
                            </div>

                            <div class="form-group">
                                <label for="classificacao">Classificação: <span style="color: red">*</span></label>
                                <input type="number" class="form-control" id="classificacao" name="classificacao"
                                       value="" placeholder="Digite a classificação" required>
                            </div>
                            <div class="form-group">
                                <a href="https://www.tabelacutter.com/" target="_blank" class="btn btn-block"
                                   style="background-color: var(--biblioteca); border-radius: 0.5rem; color: white;"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i> Tabela Cutter</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--DADOS DO TRABALHO-->

                <div class="col-md-12 corpoFicha shadow my-4">

                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Dados do Trabalho</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 py-2 textoFicha">
                            <div class="form-group">
                                <label for="autor_nome">Nome: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="autor_nome" name="autor_nome"
                                       placeholder="Digite o nome do Autor" value="{{$fichaCatalografica->autor_nome}}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="autor_sobrenome">Sobrenome: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="autor_sobrenome" name="autor_sobrenome"
                                       placeholder="Digite o sobrenome do Autor"
                                       value="{{$fichaCatalografica->autor_sobrenome}}" required>
                            </div>
                            <div class="form-group">
                                <label for="titulo">Título: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       placeholder="Digite o Título" value="{{$fichaCatalografica->titulo}}" required>
                            </div>
                            <div class="form-group">
                                <label for="subtitulo">Subtítulo: </label>
                                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                                       placeholder="Digite o Subtítulo" value="{{$fichaCatalografica->subtitulo}}">
                            </div>
                            <div class="form-group">
                                <label for="local">Local: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="local" name="local"
                                       placeholder="Digite o Local" value="{{$fichaCatalografica->local}}" required>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ano">Ano: <span style="color: red">*</span></label>
                                        <input class="form-control" type="number" min="1900" max="2099" step="1"
                                               name="ano"
                                               value="{{$fichaCatalografica->ano}}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="folhas">Folhas: <span style="color: red">*</span></label>
                                        <input type="number" class="form-control" id="folhas" name="folhas"
                                               placeholder="Quantidade de Folhas"
                                               value="{{$fichaCatalografica->folhas}}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ilustracao">Ilustração: <span style="color: red">*</span></label>
                                        <select class="form-control" id="ilustracao" name="ilustracao">
                                            <option value="colorido"
                                                    @if($fichaCatalografica->ilustracao == 'colorido') selected @endif>
                                                Colorido
                                            </option>
                                            <option value="preto_branco"
                                                    @if($fichaCatalografica->ilustracao == 'preto_branco') selected @endif>
                                                Preto e Branco
                                            </option>
                                            <option value="nao_possui"
                                                    @if($fichaCatalografica->ilustracao == 'nao_possui') selected @endif>
                                                Não Possui
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inclui_anexo">Inclui Anexo ? <span
                                                style="color: red">*</span></label>
                                        <select class="form-control" id="inclui_anexo" name="inclui_anexo">
                                            <option @if($fichaCatalografica->inclui_anexo == 0) selected
                                                    @endif value="0">Não
                                            </option>
                                            <option @if($fichaCatalografica->inclui_anexo == 1) selected
                                                    @endif value="1">Sim
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inclui_apendice">Inclui Apêndice ? <span style="color: red">*</span></label>
                                        <select class="form-control" id="inclui_apendice" name="inclui_apendice">
                                            <option @if($fichaCatalografica->inclui_apendice == 0) selected
                                                    @endif value="0">Não
                                            </option>
                                            <option @if($fichaCatalografica->inclui_apendice == 1) selected
                                                    @endif value="1">Sim
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="forma-group">
                                    <label for="anexoArquivo">Visualizar os elementos pré-textuais: <span
                                            style="color: red">*</span>
                                    </label><br>
                                    <a class="btn btn-primary" href="{{ route('baixar-anexo', $requisicao->id) }}"
                                       style="margin-bottom: 10px">Visualizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <! –– Dados Especificos ––>

                @if($tipo_documento == 2) <! -- MONOGRAFIA --!>
                <div class="col-md-12 corpoFicha shadow my-4">
                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Monografia</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 py-2 textoFicha">
                            <div class="form-group">
                                <label for="nome_orientador">Nome do Orientador: <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                       placeholder="Digite o nome do orientador" value="{{$documento->nome_orientador}}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="sobrenome_orientador">Sobrenome do Orientador: <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" id="sobrenome_orientador"
                                       name="sobrenome_orientador"
                                       placeholder="Digite o Sobrenome do orientador"
                                       value="{{$documento->sobrenome_orientador}}" required>
                            </div>

                            <div class="form-group">
                                <label for="nome_coorientador">Nome do Coorientador: </label>
                                <input type="text" class="form-control" id="nome_coorientador"
                                       placeholder="Digite o Nome do Coorientador"
                                       value="{{$documento->nome_coorientador}}" name="nome_coorientador">
                            </div>

                            <div class="form-group">
                                <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                <input type="text" class="form-control" id="sobrenome_coorientador"
                                       placeholder="Digite o Sobrenome do Coorientador"
                                       value="{{$documento->sobrenome_coorientador}}"
                                       name="sobrenome_coorientador">
                            </div>

                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tipo_curso">Selecione o Tipo do seu Curso: <span
                                                style="color: red">*</span></label>
                                        <select class="form-control" aria-label="Selecione o tipo do curso"
                                                name="tipo_curso" id="tipo_curso">
                                            <option value="especializacao"
                                                    @if($documento->tipo_curso == 'especializacao') selected @endif>
                                                Especialização
                                            </option>
                                            <option value="graduacao"
                                                    @if($documento->tipo_curso == 'graduacao') selected @endif>Graduação
                                            </option>
                                            <option value="mba" @if($documento->tipo_curso == 'mba') selected @endif>
                                                MBA
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="curso">Curso: <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="curso" name="curso"
                                               placeholder="Digite o Nome do Curso" value="{{$documento->curso}}"
                                               required
                                               disabled>
                                        <input type="hidden" class="form-control" id="curso" name="curso"
                                               placeholder="Digite o Nome do Curso" value="{{$documento->curso}}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="campus">Campus: <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="campus" name="campus"
                                               placeholder="Digite o Nome do Campus" value="{{$documento->campus}}"
                                               required
                                               disabled>
                                        <input type="hidden" class="form-control" id="campus" name="campus"
                                               placeholder="Digite o Nome do Campus" value="{{$documento->campus}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @elseif($tipo_documento == 4) <! -- TESE --!>
                <div class="col-md-12 corpoFicha shadow my-4">
                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Tese</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 py-2 textoFicha">
                            <div class="form-group">
                                <label for="nome_orientador">Nome do Orientador: <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                       placeholder="Digite o Nome do Orientador"
                                       value="{{$documento->nome_orientador}}">
                            </div>

                            <div class="form-group">
                                <label for="sobrenome_orientador">Sobrenome do Orientador: <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" id="sobrenome_orientador"
                                       name="sobrenome_orientador"
                                       placeholder="Digite o Sobrenome do orientador"
                                       value="{{$documento->sobrenome_orientador}}" required>
                            </div>

                            <div class="form-group">
                                <label for="nome_coorientador">Nome do coorientador:</label>
                                <input type="text" class="form-control" id="nome_coorientador" name="nome_coorientador"
                                       placeholder="Digite o Nome do Coorientador"
                                       value="{{$documento->nome_coorientador}}">
                            </div>

                            <div class="form-group">
                                <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                <input type="text" class="form-control" id="sobrenome_coorientador"
                                       placeholder="Digite o Sobrenome do Coorientador"
                                       value="{{$documento->sobrenome_coorientador}}"
                                       name="sobrenome_coorientador">
                            </div>

                            <div class="form-group">
                                <label for="programa">Nome do Programa de Pós-Graduação <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" id="programa" name="programa"
                                       placeholder="Digite o Nome do Programa" value="{{$documento->programa}}">
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($tipo_documento == 3)
                    <div class="col-md-12 corpoFicha shadow my-4">
                        <div class="row">
                            <div class="col-md-12 cabecalho py-2">
                                <span class="tituloCabecalho">Produto Educacional</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 py-2 textoFicha">
                                <div class="form-group">
                                    <label for="nome_orientador">Nome do Orientador: <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                           placeholder="Digite o Nome do Orientador"
                                           value="{{$documento->nome_orientador}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="sobrenome_orientador">Sobrenome do Orientador: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="sobrenome_orientador"
                                           name="sobrenome_orientador"
                                           placeholder="Digite o Sobrenome do Orientador"
                                           value="{{$documento->sobrenome_orientador}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="nome_coorientador">Nome do Coorientador: </label>
                                    <input type="text" class="form-control" id="nome_coorientador"
                                           placeholder="Digite o Nome do Coorientador"
                                           value="{{$documento->nome_coorientador}}"
                                           name="nome_coorientador">
                                </div>

                                <div class="form-group">
                                    <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                    <input type="text" class="form-control" id="sobrenome_coorientador"
                                           placeholder="Digite o Sobrenome do Coorientador"
                                           value="{{$documento->sobrenome_coorientador}}"
                                           name="sobrenome_coorientador">
                                </div>
                                <div class="form-group">
                                    <label for="programa">Nome do Programa de Pós-Graduação <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="programa" name="programa"
                                           placeholder="Digite o Nome do Programa" value="{{$documento->programa}}">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo_curso">Selecione o Tipo do Produto: <span
                                            style="color: red">*</span></label>
                                    <select class="form-control" aria-label="Selecione o tipo do produto"
                                            name="produto" id="produto">
                                        <option @if($documento->produto == 'produto_bibliografico') selected
                                                @endif value="produto_bibliografico">Produto Bibliográfico
                                        </option>
                                        <option @if($documento->produto == 'ativos_propriedade') selected
                                                @endif value="ativos_propriedade">Ativos de Propriedade (Ex: Patente,
                                            Marca e etc.)
                                        </option>
                                        <option @if($documento->produto == 'tecnologia_social') selected
                                                @endif value="tecnologia_social">Tecnologia Social
                                        </option>
                                        <option @if($documento->produto == 'curso_formacao') selected
                                                @endif value="curso_formacao">Curso para Formação
                                        </option>
                                        <option @if($documento->produto == 'produto_editoracao') selected
                                                @endif value="produto_editoracao">Produto de Editoração
                                        </option>
                                        <option @if($documento->produto == 'material_didatico') selected
                                                @endif value="material_didatico">Material Didático
                                        </option>
                                        <option @if($documento->produto == 'software') selected @endif value="software">
                                            Software/Aplicativo (Programa de computador)
                                        </option>
                                        <option @if($documento->produto == 'evento') selected @endif value="evento">
                                            Evento Organizado
                                        </option>
                                        <option @if($documento->produto == 'norma') selected @endif value="norma">Norma
                                            ou Marco Regulatório
                                        </option>
                                        <option @if($documento->produto == 'relatorio') selected
                                                @endif value="relatorio">Relatório técnico conclusivo
                                        </option>
                                        <option @if($documento->produto == 'manual') selected @endif value="manual">
                                            Manual/Protocolo
                                        </option>
                                        <option @if($documento->produto == 'traducao') selected @endif value="traducao">
                                            Tradução
                                        </option>
                                        <option @if($documento->produto == 'acervo') selected @endif value="acervo">
                                            Acervo
                                        </option>
                                        <option @if($documento->produto == 'base_dados') selected
                                                @endif value="base_dados">Base de dados técnico-científica
                                        </option>
                                        <option @if($documento->produto == 'cultivar') selected @endif value="cultivar">
                                            Cultivar
                                        </option>
                                        <option @if($documento->produto == 'produto_comunicacao') selected
                                                @endif value="produto_comunicacao">Produto de Comunicação
                                        </option>
                                        <option @if($documento->produto == 'carta') selected @endif value="carta">Carta,
                                            mapa ou simila
                                        </option>
                                        <option @if($documento->produto == 'produto_sigilo') selected
                                                @endif value="produto_sigilo">Produtos/Processos em Sigilo
                                        </option>
                                        <option @if($documento->produto == 'taxonomia') selected
                                                @endif value="taxonomia">Taxonomias, Ontologias e Tesauros
                                        </option>
                                        <option @if($documento->produto == 'empresa_social') selected
                                                @endif value="empresa_social">Empresa ou Organização Social Inovadora
                                        </option>
                                        <option @if($documento->produto == 'processo') selected @endif value="processo">
                                            Processo / Tecnologia e Produto / Material não patenteáveis
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="campus">Campus: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="campus" name="campus"
                                           placeholder="Digite o Nome do Campus" value="{{$documento->campus}}"
                                           required
                                           disabled>
                                    <input type="hidden" class="form-control" id="campus" name="campus"
                                           placeholder="Digite o Nome do Campus" value="{{$documento->campus}}"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($tipo_documento == 1)
                    <div class="col-md-12 corpoFicha shadow my-4">
                        <div class="row">
                            <div class="col-md-12 cabecalho py-2">
                                <span class="tituloCabecalho">Dissertação</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 py-2 textoFicha">
                                <div class="form-group">
                                    <label for="nome_orientador">Nome do Orientador: <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                           placeholder="Digite o Nome do Orientador"
                                           value="{{$documento->nome_orientador}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="sobrenome_orientador">Sobrenome do Orientador: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="sobrenome_orientador"
                                           name="sobrenome_orientador"
                                           placeholder="Digite o Sobrenome do Orientador"
                                           value="{{$documento->sobrenome_orientador}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="nome_coorientador">Nome do Coorientador: </label>
                                    <input type="text" class="form-control" id="nome_coorientador"
                                           placeholder="Digite o Nome do Coorientador"
                                           value="{{$documento->nome_coorientador}}"
                                           name="nome_coorientador">
                                </div>

                                <div class="form-group">
                                    <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                    <input type="text" class="form-control" id="sobrenome_coorientador"
                                           placeholder="Digite o Sobrenome do Coorientador"
                                           value="{{$documento->sobrenome_coorientador}}"
                                           name="sobrenome_coorientador">
                                </div>
                                <div class="form-group">
                                    <label for="programa">Nome do Programa de Pós-Graduação <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="programa" name="programa"
                                           placeholder="Digite o Nome do Programa" value="{{$documento->programa}}">
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="curso">Curso: <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="curso" name="curso"
                                                   placeholder="Digite o Nome do Curso" value="{{$documento->curso}}"
                                                   required
                                                   disabled>
                                            <input type="hidden" class="form-control" id="curso" name="curso"
                                                   placeholder="Digite o Nome do Curso" value="{{$documento->curso}}"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="campus">Campus: <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="campus" name="campus"
                                                   placeholder="Digite o Nome do Campus" value="{{$documento->campus}}"
                                                   required
                                                   disabled>
                                            <input type="hidden" class="form-control" id="campus" name="campus"
                                                   placeholder="Digite o Nome do Campus" value="{{$documento->campus}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            @endif

            <!-- PALAVRAS CHAVE -->
                <div class="col-md-12 corpoFicha shadow my-4">
                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Palavras-chave</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 py-2 textoFicha">
                            <div class="form-group">
                                <label for="primeira">Primeira Palavra:<span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="primeira" name="primeira_chave"
                                       placeholder="1. Palavras-chave" value="{{$palavrasChave[0]->palavra}}">
                            </div>

                            <div class="form-group">
                                <label for="segunda">Segunda Palavra:<span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="segunda" name="segunda_chave"
                                       placeholder="2. Palavras-chave" value="{{$palavrasChave[1]->palavra}}">
                            </div>

                            <div class="form-group">
                                <label for="terceira">Terceira Palavra:<span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="terceira" name="terceira_chave"
                                       placeholder="3. Palavras-chave" value="{{$palavrasChave[2]->palavra}}">
                            </div>

                            @if(sizeof($palavrasChave) >= 4 )
                                <input type="hidden" name="palavra_chave4_id" value="{{$palavrasChave[3]->id}}">
                                <div class="form-group">
                                    <label for="quarta">Quarta Palavra:</label>
                                    <input type="text" class="form-control" id="quarta" name="quarta_chave"
                                           placeholder="4. Palavras-chave" value="{{$palavrasChave[3]->palavra}} ">
                                </div>
                                @if(sizeof($palavrasChave) == 5)
                                    <input type="hidden" name="palavra_chave5_id" value="{{$palavrasChave[4]->id}}">
                                    <div class="form-group">
                                        <label for="quinta">Quinta Palavra:</label>
                                        <input type="text" class="form-control" id="quinta" name="quinta_chave"
                                               placeholder="5. Palavras-chave" value="{{$palavrasChave[4]->palavra}} ">
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mt-5">
                    @if($requisicao->status == 'Em andamento')
                        <div class="col-md-3">
                            <a type="button" class="btn btn-block"
                               style="background-color: var(--padrao); border-radius: 0.5rem; color: white;"
                               href="{{ route('listar-fichas') }}">Voltar</a>
                        </div>

                        <div class="col-md-3">
                            <a type="button" class="btn btn-block"
                               style="background-color: var(--destaque); border-radius: 0.5rem; color: white;"
                               href="{{ route('rejeitar-ficha',$requisicao->id) }}">Indeferir Ficha</a>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block" id="btn_gerar_ficha"
                                    style="background-color: #1A2876; border-radius: 0.5rem; color: white;"
                                    href="#">Visualizar Ficha
                            </button>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block" id="btn_enviar_ficha"
                                    style="background-color: var(--confirmar); border-radius: 0.5rem; color: white;"
                                    href="#">
                                Enviar Ficha
                            </button>
                        </div>
                    @else
                        <div class="col-md-4">
                            <a type="button" class="btn btn-block"
                               style="background-color: var(--padrao); border-radius: 0.5rem; color: white;"
                               href="{{ route('listar-fichas') }}">Voltar</a>
                        </div>

                        <div class="col-md-4">
                            <a type="button" class="btn btn-block" id="btn_gerar_ficha"
                               style="background-color: var(--textcolor); border-radius: 0.5rem; color: white;">Gerar
                                Ficha</a>
                        </div>

                        <div class="col-md-4">
                            <button type="button" class="btn btn-block"
                                    style="background-color: var(--confirmar); border-radius: 0.5rem; color: white;"
                                    href="#" id="btn_enviar_ficha">
                                Enviar
                            </button>
                        </div>
                    @endif
                    <input type="hidden" name="tipo_documento" value="{{$tipo_documento}}">
                    <input type="hidden" name="aluno_id" value="{{$aluno->id}}">
                    <input type="hidden" name="ficha_catalografica_id" value="{{$fichaCatalografica->id}}">
                    <input type="hidden" name="palavra_chave1_id" value="{{$palavrasChave[0]->id}}">
                    <input type="hidden" name="palavra_chave2_id" value="{{$palavrasChave[1]->id}}">
                    <input type="hidden" name="palavra_chave3_id" value="{{$palavrasChave[2]->id}}">
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    $("#btn_gerar_ficha").on("click",function () {
        $('#formRequisicao').attr("action", "{{route('preview')}}");
    });

    $("#btn_enviar_ficha").click(function () {
        $('#formRequisicao').attr("action", "{{route('atualizar-ficha')}}");
    });

    var sel = $('#produto');
    var selected = sel.val(); // cache selected value, before reordering
    var opts_list = sel.find('option');
    opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
    sel.html('').append(opts_list);
    sel.val(selected); // set cached selected value

</script>

@endsection
