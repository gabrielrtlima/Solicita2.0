<?php

namespace App\Http\Controllers;

use App\Mail\AlertaFichaMail;
use App\Models\Biblioteca;
use App\Models\Bibliotecario;
use App\Models\Dissertacao;
use App\Models\FichaCatalografica;
use App\Models\Monografia;
use App\Models\PalavraChave;
use App\Models\ProgramaEducacional;
use App\Models\Tcc;
use App\Models\Tese;
use App\Models\TipoDocumento;
use Brick\Math\BigDecimal;
use Database\Seeders\TipoDocumentoSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\StatusMail;
use App\Models\Requisicao_documento;
use App\Models\Requisicao;
use App\Models\Documento;
use App\Models\Curso;
use App\Models\Aluno;
use App\Models\Perfil;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Servidor;
use App\Models\Unidade;
use App\Jobs\SendEmail;

class RequisicaoController extends Controller
{
    public function index()
    {
        return view('autenticacao.formulario-requisicao');
    }

    public function excluirRequisicao($id)
    {
        $requisicao = Requisicao::find($id);
        $documentos = $requisicao->requisicao_documento()->get();

        foreach ($documentos as $doc) {
            # code...
            if ($doc->status != 'Em andamento') {
                return redirect()->back()->with('error', 'Você não pode excluir esta requisição, pois a mesma possui documentos que já foram processados.');
            }
        }
        $requisicao->requisicao_documento()->delete();
        $requisicao->delete();
        return redirect()->back()->with('success', 'Requisição excluída com sucesso!');
    }

    public function getRequisicoes(Request $request)
    {
        //$documento = Documento::where('id',$request->documento_id)->first();
        $documento = Documento::where('id', $request->titulo_id)->first();
        $curso = Curso::where('id', $request->curso_id)->first();
        $cursoSelecionado = Curso::where('id', $request->curso_id)->first();
        $documentoSelecionado = Documento::where('id', $request->titulo_id)->first();
        $cursos = Curso::all();
        $documentos = Documento::all();
        //Verifica se o card clicado foi igual a "TODOS"
        // ->withTrashed()
        if ($request->titulo_id == 6) {
            $titulo = 'Concluídos';
            //$id_documentos retorna um collection. É necessário transformar para array
            //pega todas as requisições com base no id do documento e no id do curso
            $id_documentos = DB::table('requisicao_documentos')
                ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                ->select('requisicao_documentos.id')
                ->where([['curso_id', $request->curso_id], ['status', 'Concluído - Disponível para retirada']])
                ->get();

        } else if ($request->titulo_id == 7) {
            $titulo = 'Indeferidos';
            //$id_documentos retorna um collection. É necessário transformar para array
            //pega todas as requisições com base no id do documento e no id do curso
            $id_documentos = DB::table('requisicao_documentos')
                ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                ->select('requisicao_documentos.id')
                ->where([['curso_id', $request->curso_id], ['status', 'Indeferido']])
                ->get();

        } else {
            $titulo = $documento->tipo;
            $id_documentos = DB::table('requisicao_documentos')
                ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                ->select('requisicao_documentos.id')
                ->where([['documento_id', $request->titulo_id], ['curso_id', $request->curso_id], ['status', 'Em andamento']])
                ->get();
        }
        $id = []; //array auxiliar que pega cada item do $id_documentos
        foreach ($id_documentos as $id_documento) {
            array_push($id, $id_documento->id); //passa o id de $id_documentos para o array auxiliar $id
        }
        $listaRequisicao_documentos = Requisicao_documento::whereIn('id', $id)->get(); //Pega as requisições que possuem o id do curso
        $response = [];
        foreach ($listaRequisicao_documentos as $key) {
            if ($key->requisicao->perfil != null) {
                array_push($response, ['id' => $key->id,
                    'cpf' => $key->aluno->cpf,
                    'perfil' => $key->aluno->perfil,
                    'nome' => $key->aluno->user->name,
                    'curso' => $key->requisicao->perfil->curso->nome,
                    'email' => $key->aluno->user->email,
                    'vinculo' => $key->requisicao->perfil->situacao,
                    'status_data' => $key->status_data,
                    'status_hora' => Requisicao::where('id', $key->requisicao_id)->get('hora_pedido')[0]->hora_pedido,
                    'status' => $key->status,
                    'detalhes' => $key->detalhes,
                    'requisicoes_documentos' => $key
                ]);
            }
        }
        usort($response, function ($a, $b) {
            return $a['nome'] >= $b['nome'];
        });
        $listaRequisicao_documentos = $response;

        // return view('telas_servidor.requisicoes_servidor', compact('titulo','listaRequisicao_documentos', 'quantidades'));

        return view('telas_servidor.requisicoes_servidor',
            compact('titulo',
                'listaRequisicao_documentos',
                'cursos',
                'cursoSelecionado',
                'documentoSelecionado',
                'documentos'));

    }

    public function storeRequisicao(Request $request)
    {
        return redirect('confirmacao-requisicao');

    }

    public function preparaNovaRequisicao(Request $request)
    {
        $unidades = Unidade::All();
        $usuarios = User::All();
        $alunos = Aluno::All();
        $perfis = Perfil::where('aluno_id', Auth::user()->aluno->id)->get();
        return view('autenticacao.formulario-requisicao', compact('usuarios', 'unidades', 'perfis', 'alunos'));
    }

    public function preparaNovaRequisicaoBibli(Request $request)
    {
        $unidades = Unidade::All();
        $usuarios = User::All();
        $alunos = Aluno::All();
        $perfis = Perfil::where('aluno_id', Auth::user()->aluno->id)->get();
        $tipos_documentos = TipoDocumento::all();
        return view('autenticacao.formulario-requisicao-bibli', compact('usuarios', 'unidades', 'perfis', 'alunos', 'tipos_documentos'));
    }

    public function cadastrarDocumento(Request $request)
    {
        $tipo_documento = $request->documento;
        $id_perfil = $request->default;
        return view('telas_aluno.cadastrar_documento', ['tipo_documento' => $tipo_documento, 'id_perfil' => $id_perfil]);
    }

    public function criarDocumento(Request $request)
    {
        $idUser = Auth::user()->id;
        $aluno = Aluno::where('user_id', $idUser)->first();
        $perfil = Perfil::where('aluno_id', $aluno->id)->first();
        $unidade = Unidade::where('id', $perfil->unidade_id)->first();

        $ficha = new FichaCatalografica();

        $ficha->autor_nome = $request->autor_nome;
        $ficha->autor_sobrenome = $request->autor_sobrenome;
        $ficha->titulo = $request->titulo;
        $ficha->subtitulo = $request->subtitulo;
        $ficha->local = $request->local;
        $ficha->ano = $request->ano;
        $ficha->folhas = $request->folhas;
        $ficha->ilustracao = $request->ilustracao;
        $ficha->tipo_documento_id = $request->tipo_documento;
        $ficha->inclui_anexo = $request->inclui_anexo;
        $ficha->inclui_apendice = $request->inclui_apendice;
        //Anexar arquivo
        if (($request->hasFile('anexo') && $request->file('anexo')->isValid())) {

            $anexo = $request->anexo->extension();
            $nomeAnexo = "documento_".$aluno->cpf.date('Ymd').date('His').'.'.$anexo;
            $ficha->anexo = $nomeAnexo;
            $request->anexo->storeAs('fichas/', $nomeAnexo);
            $request->anexo = $nomeAnexo;
        }

        $ficha->save();

        if ($request->tipo_documento == 2) {
            $monografia = new Monografia();
            $monografia->nome_orientador = $request->nome_orientador;
            $monografia->sobrenome_orientador = $request->sobrenome_orientador;
            $monografia->nome_coorientador = $request->nome_coorientador;
            $monografia->sobrenome_coorientador = $request->sobrenome_coorientador;
            $monografia->curso = $perfil->default;
            $monografia->tipo_curso = $request->tipo_curso;
            $monografia->campus = $unidade->nome;
            $monografia->ficha_catalografica_id = $ficha->id;
            $monografia->save();
        } elseif ($request->tipo_documento == 4) {
            $tese = new Tese();
            $tese->nome_orientador = $request->nome_orientador;
            $tese->sobrenome_orientador = $request->sobrenome_orientador;
            $tese->nome_coorientador = $request->nome_coorientador;
            $tese->sobrenome_coorientador = $request->sobrenome_coorientador;
            $tese->programa = $request->programa;
            $tese->ficha_catalografica_id = $ficha->id;
            $tese->save();
        } elseif ($request->tipo_documento == 3) {
            $programaEduc = new ProgramaEducacional();
            $programaEduc->programa = $request->programa;
            $programaEduc->campus = $unidade->nome;
            $programaEduc->ficha_catalografica_id = $ficha->id;
            $programaEduc->nome_orientador = $request->nome_orientador;
            $programaEduc->sobrenome_orientador = $request->sobrenome_orientador;
            $programaEduc->nome_coorientador = $request->nome_coorientador;
            $programaEduc->sobrenome_coorientador = $request->sobrenome_coorientador;
            $programaEduc->produto = $request->produto;
            $programaEduc->save();
        } elseif ($request->tipo_documento == 1) {
            $dissertacao = new Dissertacao();
            $dissertacao->nome_orientador = $request->nome_orientador;
            $dissertacao->sobrenome_orientador = $request->sobrenome_orientador;
            $dissertacao->nome_coorientador = $request->nome_coorientador;
            $dissertacao->sobrenome_coorientador = $request->sobrenome_coorientador;
            $dissertacao->campus = $unidade->nome;
            $dissertacao->programa = $request->programa;
            $dissertacao->ficha_catalografica_id = $ficha->id;
            $dissertacao->save();
        }else {
            dd($request);
        }

        $palavra = new PalavraChave();
        $palavra->palavra = $request->primeira_chave;
        $palavra->ficha_catalografica_id = $ficha->id;
        $palavra->save();

        $palavra = new PalavraChave();
        $palavra->palavra = $request->segunda_chave;
        $palavra->ficha_catalografica_id = $ficha->id;
        $palavra->save();

        $palavra = new PalavraChave();
        $palavra->palavra = $request->terceira_chave;
        $palavra->ficha_catalografica_id = $ficha->id;
        $palavra->save();

        if ($request->quarta_chave != null) {
            $palavra = new PalavraChave();
            $palavra->palavra = $request->quarta_chave;
            $palavra->ficha_catalografica_id = $ficha->id;
            $palavra->save();
        }
        if ($request->quinta_chave != null) {
            $palavra = new PalavraChave();
            $palavra->palavra = $request->quinta_chave;
            $palavra->ficha_catalografica_id = $ficha->id;
            $palavra->save();
        }

        $requisicao = new Requisicao();
        $perfil = Perfil::where('id', $request->id_perfil)->first();
        $requisicao->data_pedido = date('Y-m-d');
        $requisicao->hora_pedido = date('H:i');
        $requisicao->perfil_id = $perfil->id;
        $requisicao->aluno_id = $aluno->id; //necessária adequação com o código de autenticação do usuário do perfil aluno
        $requisicao->save();

        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = date('Y-m-d');
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = $perfil->aluno_id;
        $documentosRequisitados->status = 'Em andamento';
        $documentosRequisitados->ficha_catalografica_id = $ficha->id;
        $documentosRequisitados->save();


        $bibliotecas = Biblioteca::all();
        $unidadeId = $perfil->unidade_id;
        foreach ($bibliotecas as $biblioteca) {
            if($unidadeId == $biblioteca->unidade_id) {
                \Illuminate\Support\Facades\Mail::send(new AlertaFichaMail($biblioteca, Auth::user(), $unidade));
            }
        }



        return redirect(Route('home-aluno'))->with('success', 'Ficha Catalografica Cadastrada Com Sucesso!');
    }

    public function novaRequisicao(Request $request)
    {
        $checkBoxDeclaracaoVinculo = $request->declaracaoVinculo;
        $checkBoxComprovanteMatricula = $request->comprovanteMatricula;
        $checkBoxHistorico = $request->historico;
        $checkBoxProgramaDisciplina = $request->programaDisciplina;
        $checkBoxOutros = $request->outros;
        $mensagens = [
            'requisicaoPrograma.required' => 'Preencha este campo com as informações relativas à disciplina e a finalidade do pedido',
            'requisicaoPrograma.max' => 'O campo só pode ter no máximo 190 caracteres',
            'requisicaoOutros.max' => 'O campo só pode ter no máximo 190 caracteres'
        ];

        if ($checkBoxProgramaDisciplina != '') {
            $request->validate([
                'requisicaoPrograma' => ['required'],
            ]);
            $request->validate([
                'requisicaoPrograma' => 'required|max:190'
            ], $mensagens);
        }
        if ($checkBoxOutros != '') {
            $request->validate([
                'requisicaoOutros' => ['required'],
            ]);
            $request->validate([
                'requisicaoOutros' => 'required|max:190'
            ], $mensagens);
        }
        $requisicao = new Requisicao();
        $idUser = Auth::user()->id;
        $user = User::find($idUser); //Usuário Autenticado
        $aluno = Aluno::where('user_id', $idUser)->first(); //Aluno autenticado
        $perfil = Perfil::where('id', $request->default)->first();
        $arrayDocumentos = [];//Array Temporário
        $date = date('Y/m/d', time());
        $hour = date('H:i');
        $requisicao->data_pedido = $date;
        $requisicao->hora_pedido = $hour;
        $requisicao->perfil_id = $perfil->id;
        $requisicao->aluno_id = $aluno->id; //necessária adequação com o código de autenticação do usuário do perfil aluno
        $requisicao->save();
        if ($checkBoxDeclaracaoVinculo) {
            $texto = "";
            array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 1, $perfil, $texto));
        }
        if ($checkBoxComprovanteMatricula) {
            $texto = "";
            array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 2, $perfil, $texto));
        }
        if ($checkBoxHistorico) {
            $texto = "";
            array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 3, $perfil, $texto));
        }
        if ($checkBoxProgramaDisciplina) {
            $texto = $request->get('requisicaoPrograma');
            array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 4, $perfil, $texto));
        }
        if ($checkBoxOutros) {
            $texto = $request->get('requisicaoOutros');
            array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 5, $perfil, $texto));
        }
        //#Documentos
        $ano = date('Y', time());
        $size = count($arrayDocumentos);
        $requisicao->requisicao_documento()->saveMany($arrayDocumentos);
        $id = [];
        foreach ($arrayDocumentos as $key) {
            array_push($id, $key->documento_id);
        }
        $arrayAux = Documento::whereIn('id', $id)->get();
        // $documento = Documento::where('id',$request->titulo_id)->first();
        $curso = Curso::where('id', $request->curso_id)->first();
        return view('autenticacao.confirmacao-requisicao', compact('arrayDocumentos', 'requisicao', 'arrayAux', 'size', 'ano', 'date', 'hour'));
    }

    public function requisitados(Requisicao $requisicao, $id, Perfil $perfil, $texto)
    {
        date_default_timezone_set('America/Sao_Paulo');
        //$date = date('d/m/Y', time());
        $hour = date('H:i');
        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = now();
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = $perfil->aluno_id;
        $documentosRequisitados->status = 'Em andamento';
        if ($id === 4) {
            $documentosRequisitados->detalhes = $texto;
        }
        if ($id === 5) {
            $documentosRequisitados->detalhes = $texto;
        }
        $documentosRequisitados->documento_id = $id;
        $documentosRequisitados->detalhes = $texto;
        return $documentosRequisitados;
    }

    public function confirmacaoRequisicao(Request $request)
    {
        return redirect('/autenticacao.confirmacao-requisicao');
    }

    public function finalizaRequisicao(Request $request)
    {
        return redirect('/home-aluno');
    }

    public function cancelaRequisicao()
    {
        return view('/autenticacao.home-aluno');
    }

    public function listarRequisicoesAluno()
    {
        $requisicao = Requisicao::paginate(10);
        return view('/home-aluno')->with($requisicao);
    }

    public function indeferirRequisicao(Request $request)
    {
        $request->validate([
            'anotacoes' => ['required'],
        ]);
        $id = $request->idDocumento;
        $servidorLogado = Auth::user();
        $servidor = Servidor::where('user_id', $servidorLogado->id)->first();
        $id_documento = Requisicao_documento::where('id', $id)->first();
        $id_documento->anotacoes = $request->anotacoes;
        $id_documento->status = "Indeferido";
        $id_documento->servidor_id = $servidor->id;
        $aluno = Aluno::where('id', $id_documento->aluno_id)->first();
        $user = User::where('id', $aluno->user_id)->first();
        $documento = Documento::where('id', $id_documento->documento_id)->first();
        $to_email = $user->email;
        $nome_documento = $documento->tipo;
        $data = array(
            'usuario' => $user,
            'aluno' => $aluno,
            'servidor' => $servidor,
            'documento' => $id_documento,
            'nome_documento' => $nome_documento,
            'anotacoes' => $id_documento->anotacoes,
        );
        $id_documento->save();
        $subject = 'Solicita - Status da Requisicao: ' . $id_documento->status;


        $details = ['data' => $data, 'cabecalho' => 'naoresponder.lmts@gmail.com', 'titulo' => 'Solicita - LMTS', 'toEmail' => $to_email, 'subject' => $subject];

        SendEmail::dispatch($details);
        return redirect()->back()->with('success', 'Documento(s) Indeferidos(s) com Sucesso!'); //volta pra mesma url
    }

    public function concluirRequisicao(Request $request)
    {
        $servidorLogado = Auth::user();
        $servidor = Servidor::where('user_id', $servidorLogado->id)->first();
        $arrayDocumentos = $request->checkboxLinha;
        $id_documentos = Requisicao_documento::find($arrayDocumentos);//whereIn
        if (isset($id_documentos)) {
            foreach ($id_documentos as $id_documento) {
                $id_documento->status = "Concluído - Disponível para retirada";
                $id_documento->servidor_id = $servidor->id;
                $aluno = Aluno::where('id', $id_documento->aluno_id)->first();
                $user = User::where('id', $aluno->user_id)->first();
                $documento = Documento::where('id', $id_documento->documento_id)->first();
                $to_email = $user->email;
                $nome_documento = $documento->tipo;
                $data = array(
                    'usuario' => $user,
                    'aluno' => $aluno,
                    'servidor' => $servidor,
                    'documento' => $id_documento,
                    'nome_documento' => $nome_documento,
                    'anotacoes' => $id_documento->anotacoes,
                );
                $id_documento->save();
                $subject = 'Solicita - Status da Requisicao: ' . $id_documento->status;

                $details = ['data' => $data, 'cabecalho' => 'naoresponder.lmts@gmail.com', 'titulo' => 'Solicita - LMTS', 'toEmail' => $to_email, 'subject' => $subject];

                SendEmail::dispatch($details);

            }
        }
        return redirect()->back()->with('success', 'Documento(s) Concluido(s) com Sucesso!'); //volta pra mesma url
    }

    public function exibirBusca()
    {
        return view('telas_servidor.relatorio_servidor');
    }

    public function gerarRelatorio(Request $request)
    {

        $mensagens = [
            'dataInicio.date' => 'Preencha este campo com as informações relativas à disciplina e a finalidade do pedido',
            'dataFim.after_or_equal' => 'A data final deve ser uma data posterior ou igual a data de inicio',
            'dataInicio.before_or_equal' => 'A data de inicio deve ser uma data antes ou igual a hoje.'
        ];

        $request->validate([
            'dataInicio' => 'date |before_or_equal:today',
            'dataFim' => 'date|after_or_equal:dataInicio',
        ], $mensagens);

        $id_documentos = DB::table('requisicao_documentos')
            ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
            ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
            ->select('requisicao_documentos.id')
            ->whereDate('status_data', '>=', $request->dataInicio)
            ->whereDate('status_data', '<=', $request->dataFim)
            ->get();


        //var_dump($id_documentos);
        $id = []; //array auxiliar que pega cada item do $id_documentos
        foreach ($id_documentos as $id_documento) {
            array_push($id, $id_documento->id); //passa o id de $id_documentos para o array auxiliar $id
        }
        $listaRequisicao_documentos = Requisicao_documento::whereIn('id', $id)->get(); //Pega as requisições que possuem o id do curso

        $contadorDeclaracaoVinculo = 0;
        $contadorComprovanteMatricula = 0;
        $contadorHistorico = 0;
        $contadorProgramaDisciplina = 0;
        $contadorOutros = 0;

        foreach ($listaRequisicao_documentos as $key) {
            if ($key->documento_id == 1) {
                $contadorDeclaracaoVinculo++;
            }
            if ($key->documento_id == 2) {
                $contadorComprovanteMatricula++;
            }
            if ($key->documento_id == 3) {
                $contadorHistorico++;
            }
            if ($key->documento_id == 4) {
                $contadorProgramaDisciplina++;
            }
            if ($key->documento_id == 5) {
                $contadorOutros++;
            }
        }

        $total = $contadorDeclaracaoVinculo +
            $contadorComprovanteMatricula +
            $contadorHistorico +
            $contadorProgramaDisciplina +
            $contadorOutros;
        return view('telas_servidor.relatorio_servidor'
            , compact('contadorDeclaracaoVinculo',
                'contadorComprovanteMatricula',
                'contadorHistorico',
                'contadorProgramaDisciplina',
                'contadorOutros',
                'total'
            ));
    }

    public function exibirPesquisa()
    {
        $alunos = Aluno::all();
        return view('telas_servidor.pesquisa_servidor', compact('alunos'));
    }

    public function pesquisarAluno(Request $request)
    {
        $RequestNome = $request->input('formNome') . '%';
        $RequestCPF = $request->input('formCPF');
        $alunos = [];

        if ($request->input('formNome') != '') {
            $alunos = DB::table('users')
                ->join('alunos', 'alunos.user_id', '=', 'users.id')
                ->select('users.name', 'users.email', 'alunos.cpf', 'users.id')
                ->where('name', 'like', $RequestNome)
                ->get();
        } else if ($request->input('formCPF') != '') {
            $alunos = DB::table('users')
                ->join('alunos', 'alunos.user_id', '=', 'users.id')
                ->select('users.name', 'users.email', 'alunos.cpf', 'users.id')
                ->where('cpf', 'like', $RequestCPF)
                ->get();
        }


        return view('telas_servidor.pesquisa_servidor', compact('alunos'));

    }

}


//   $documento = Documento::where('id',$request->tipoDocumento_id)->first();
//   $qtdDeclaracaoVinculo = DB::table('requisicao_documentos')
//           ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
//           ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
//           ->select ('requisicao_documentos.id')
//           ->where([['requisicao_documentos.documento_id','1']])
//           ->get();

//   $id_documentos = $id_documentos->count();


//   return view('telas_servidor.relatorio_servidor',compact('qtdDeclaracaoVinculo'));
// }
