<option value="" disable selected hidden>-- Selecionar Curso -- </option>
@foreach($cursos as $curso)
    <option value="{{$curso->id}}">{{$curso->nome}}</option>
@endforeach
