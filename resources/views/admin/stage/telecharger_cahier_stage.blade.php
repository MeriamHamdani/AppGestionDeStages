<!DOCTYPE html>
<html>

<head>
    <title>Cahier de stage de : {{ $data['etudiant'] }}</title>
</head>

<body>
    <h1 class="text-center">Cahier de stage de : {{ $data['etudiant'] }} </h1>
    <h4> {{ $data['classe'] }}</h4>
    @foreach($data['taches'] as $tache )
    <h2 style="text-align: center;">{{ $tache->titre }}</h2>
    <hr>

    @if($tache->titre)<h2>{{ $tache->titre }} </h2>
    @else<h2>Sans titre </h2>
    @endif
    <h5><span style="float: right"> {{ $tache->date }}</span></h5>
    @if($tache->contenu!=null)
    <p>{!! $tache->contenu !!}</p>
    @else
    <p></p>
    @endif
    @endforeach

</body>

</html>