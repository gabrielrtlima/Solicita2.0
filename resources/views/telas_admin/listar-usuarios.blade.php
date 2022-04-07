@extends('layouts.app')

@section('conteudo')

<div class="container">

    <div class="row justify-content-sm-center">
        <div class="col-md-11">
            <div class="tituloListagem">Usuários</div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-11">
            <table class="table table-borderless shadow table-hover mb-2" style="border-radius: 1rem; background-color: white; border: none" id="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col" class="titleColumn">Email</th>
                    <th scope="col" class="titleColumn text-center"
                        style="cursor:pointer">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td class="align-middle">
                            {{ $usuario->id }}
                        </td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td class="text-center"><a href="{{ route('editar-usuario', ['id_usuario' => $usuario->id]) }}">
                                <img src="images/botao_editar.svg" height="30px"
                                     title="Editar Usuário"></a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>


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
