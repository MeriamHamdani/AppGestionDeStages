<!DOCTYPE html>
<html>

<head>
    <title>{{ $data['titre'] }}</title>
</head>

<body>
    <h1 style="text-align: center;">{{ $data['titre'] }}</h1>
    <hr>


    @foreach($data['taches'] as $tache )

    @if($tache->titre)<h2>{{ $tache->titre }} </h2>
    @else<h2>Sans titre </h2>
    @endif
    <h5><span style="float: right"> {{ $tache->date }}</span></h5>
    <p>{!! $tache->contenu !!}</p>
    @endforeach

</body>

</html>
