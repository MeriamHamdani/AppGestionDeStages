< script type = "text/javascript" >
    var id = 1;

function ajouterZoneTexte() {
    var zoneTexte = document.createElement('input');
    zoneTexte.setAttribute('type', 'text');
    zoneTexte.setAttribute('id', 'zoneTexte' + id);

    id++; //Pour pas que chaque zone de texte ait le même ID.

    document.getElementById("zonesTexte").appendChild(zoneTexte); //Ajouter la zone de texte.
} 

</script>