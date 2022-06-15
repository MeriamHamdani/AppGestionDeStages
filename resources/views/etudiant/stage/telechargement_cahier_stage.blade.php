<!DOCTYPE html>
<html>

<head>
    <title>{{ $data['titre'] }}</title>
</head>

<body>
    <h1 style="text-align: center;">{{ $data['titre'] }}</h1>
    <hr>
    <div class="dt-ext table-responsive">
        <table class="display" id="auto-fill">
            
                <tr>
                    <td>Titre</td>
                    <td>Contenu</td>

                </tr>
            
            <tbody>
                @foreach ($data['taches'] as $tache )
                <tr>
                    @if($tache->titre)<td>{{ $tache->titre }} - <span style="float: right">{{ $tache->date }} </span>
                    </td>
                    @else<td>Sans titre - <span style="float: right">{{ $tache->date }}</span></td>
                    @endif
                    <td>{!! $tache->contenu !!}</td>
                </tr>
                @endforeach
            </tbody>

        </table>








        @foreach ($data['taches'] as $tache )

        @if($tache->titre)<h2>{{ $tache->titre }} </h2>
        @else<h2>Sans titre </h2>
        @endif
        <h5><span style="float: right"> {{ $tache->date }}</span></h5>
        <p>{!! $tache->contenu !!}</p>
        @endforeach

</body>

</html>