<div class="row justify-content-center">
    <div class="col-sm-12" align="center">
        <a target="_blank" href="http://ufape.edu.br/">
            <img src="{{$message->embed(public_path() . '/images/logo_ufape_blue_email.png')}}" style="height: 80px">
        </a>
    </div>
</div>
@if($documento->status == "Concluido")


    <div class="container" style="background-color:white">
        {{-- DEFERIMENTO --}}
        <p><font face="Times New Roman" font size="4" color="black">Olá, {{$usuario->name}}! </font></p>

        <p><font face="Times New Roman" font size="4" color="black">A ficha catalográfica <strong>ESTÁ
                    DISPONÍVEL PARA RETIRADA! </strong> </font></p>

        <p><font face="Times New Roman" font size="4" color="black">Acesse o <a target="_blank"
                                                                                href="{{route('home')}}">Solicita</a>
                para ter acesso a sua ficha.</font></p>
        <p></p>
        <p align="center"><font face="Times New Roman" font size="4" color="black">Atenciosamente, </font></p>

        <p align="center" style=""><font face="Times New Roman" font size="4" color="black"> <strong>
                    Universidade Federal do Agreste de Pernambuco<br>
                    Setor Escolaridade</strong></font></p>
    </div>
@else
    <div class="container" style="background-color:white">
        {{-- Indeferimento --}}
        <p><font face="Times New Roman" font size="4" color="black">Olá, {{$usuario->name}}! </font></p>

        <p><font face="Times New Roman" font size="4" color="black">A emissão da ficha catalográfica foi
                indeferida. </font></p>

        <p><font face="Times New Roman" font size="4" color="black">Caso necessite de mais informações a respeito do indeferimento, acesse o
                <a target="_blank" href="{{route('home')}}">Solicita</a>. </font>
        </p>
        <p></p>
        <p align="center"><font face="Times New Roman" font size="4" color="black">Atenciosamente, </font></p>

        <p align="center" style=""><font face="Times New Roman" font size="4" color="black"> <strong> Universidade
                    Federal do Agreste de Pernambuco<br>
                    Setor da Biblioteca</strong></font></p>
    </div>
@endif



