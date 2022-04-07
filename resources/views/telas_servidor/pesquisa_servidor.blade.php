@extends('layouts.app')

@section('conteudo')

    <div class="container">

        <div class="row justify-content-sm-center">
            <div class="col-md-11">
                <div class="tituloListagem">Alunos</div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-11">
                <table class="table table-borderless shadow table-hover mb-2" style="border-radius: 1rem; background-color: white; border: none" id="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col" class="titleColumn">CPF</th>
                        <th scope="col" class="titleColumn">Email</th>
                        <th scope="col" class="titleColumn text-center"
                            style="cursor:pointer">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($alunos as $aluno)
                        <tr>
                            <td class="align-middle">
                                {{$aluno->id}}
                            </td>
                            <td class="align-middle">{{\App\Models\User::where('id',$aluno->user_id)->first()->name}}</td>
                            <td class="align-middle">{{$aluno->cpf}}</td>
                            <td class="align-middle">{{\App\Models\User::where('id',$aluno->user_id)->first()->email}}</td>
                            <td class="text-center"><form action="{{  route('listar-requisicoes-servidor', ['id'=> $aluno->id])  }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn" style="background-color: transparent">
                                        <img src="images/botao_info.svg" height="30px"
                                             title="Histórico do Usuário">
                                    </button>
                                </form></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

  {{--   INICIO DA TABELA DE RESULTADO --}}

  <script>

      $('#table').DataTable({
          searching: true,

          "language": {
              "lengthMenu": "Mostrar _MENU_ registros por página",
              "info": "Exibindo página _PAGE_ de _PAGES_",
              "infoEmpty": "Nenhum registro disponível",
              "zeroRecords": "Nenhum registro disponível",
              "search": "",
              "paginate": {
                  "previous": "Anterior",
                  "next": "Próximo",
              }
          },
          "dom": '<"top"f>rt<"bottom"p><"clear">',
          "order": [],
          "columnDefs": [{
              "targets": [2],
              "orderable": false
          }]
      });

      $('.dataTables_filter').addClass('here');
      $('.dataTables_filter').addClass('');
      $('.here').addClass('center');
      $('.here').removeClass('dataTables_filter');
      $('.table-hover').removeClass('dataTable');
      $('.here').find('input').addClass('search-input');
      $('.here').find('input').addClass('align-middle');
      $('.here').find('label').contents().unwrap();
      $('.here').find('input').wrap('<div class="col-md-12 my-3 py-1" style="background-color: #C2C2C2; border-radius: 1rem;"> <div class="col-md-7 my-2"> <div class="col-md-12 p-1 img-search" style="background-color: white; border-radius: 0.5rem;"> </div> </div> </div>');
      $('.img-search').prepend('<img src="{{asset('images/search.png')}}" width="25px">');

  </script>
@endsection
