$(document).ready(function(){
    $("#form_inscription").on('submit', function(event){
        event.preventDefault();
        $.post(
            'inscription.php', // Un script PHP que l'on va créer juste après
            {   
                nom : $("#nom").val(),
                prenom : $("#prenom").val(),
                naissance : $("#birthday").val(),
                genre : $("input[name=genre]:checked", "#form_inscription").val(),
                ville : $("#ville").val(),
                email : $("#email").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                password : $("#password").val()
            },

            function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard
                if(data == 'Success'){
                    // Le membre est connecté. Ajoutons lui un message dans la page HTML.
     
                    $("#resultat").html("<p>Vous avez été enregistré avec succès !</p>");
                }
                else{
                // Le membre n'a pas été connecté. (data vaut ici "failed")
     
                    $("#resultat").html("<p>Erreur lors de l'enregistrement...</p>");
                }
            },

            'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
        );

    });
});