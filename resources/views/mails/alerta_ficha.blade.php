<div class="container" style="background-color:white">
    <p><font face="Times New Roman" font size="4" color="black">Olá, bibliotecarios da {{ $biblioteca->nome }}.</font><br>
        <font face="Times New Roman" font size="4" color="black">Há uma nova solicitação de ficha catalográfica feita pelo aluno: {{ $usuarioSolicitante->name }}!</font></p>
    <a href="{{route('home')}}">CLIQUE AQUI PARA ACESSAR O SOLICITA</a><br>
    <p align="center"><font face="Times New Roman" font size="4" color="black">Atenciosamente, </font></p>

    @if(str_contains(mb_strtolower($unidade->nome), 'upe'))
        <p align="center" style=""><font face="Times New Roman" font size="4" color="black"> <strong> Universidade de Pernambuco<br>
                    Núcleo de Gestão de Bibliotecas e Documentação - NBID</strong></font></p>
    @endif
    @if(str_contains(mb_strtolower($unidade->nome), 'ufape'))
        <p align="center" style=""><font face="Times New Roman" font size="4" color="black"> <strong> Universidade
                    Federal do Agreste de Pernambuco<br>
                    Sistema Integrado de Bibliotecas (SIB-UFAPE)</strong></font></p>
    @endif
</div>

