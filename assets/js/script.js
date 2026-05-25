// ========================================
// SYSTÈME FONCIER GLO — Script Principal
// ========================================

// ---- FERMER LES ALERTES AUTO ----
document.addEventListener('DOMContentLoaded', function() {

    // Fermer les messages après 5 secondes
    setTimeout(function() {
        var alertes = document.querySelectorAll('.alert-dismissible');
        alertes.forEach(function(alerte) {
            alerte.style.transition = 'opacity 0.5s';
            alerte.style.opacity    = '0';
            setTimeout(function() {
                alerte.remove();
            }, 500);
        });
    }, 5000);

});

// ---- CONFIRMER LES SUPPRESSIONS ----
function confirmerSuppression(message) {
    return confirm(message || 'Êtes-vous sûr de vouloir supprimer ?');
}

// ---- AFFICHER/CACHER MOT DE PASSE ----
function togglePassword() {
    var input = document.getElementById('password');
    var icon  = document.getElementById('icon-oeil');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('visibility_off');
        icon.classList.add('visibility');
    } else {
        input.type = 'password';
        icon.classList.remove('visibility');
        icon.classList.add('visibility_off');
    }
}

// ---- PRÉVISUALISER IMAGE UPLOADÉE ----
function previsualiserFichier(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('preview');
            if (preview) {
                preview.src     = e.target.result;
                preview.style.display = 'block';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ---- INITIALISER CARTE LEAFLET ----
function initialiserCarte(lat, lng, reference) {

    // Vérifier si l'élément existe
    var element = document.getElementById('carte-parcelles');
    if (!element) return;

    // Créer la carte
    var carte = L.map('carte-parcelles').setView([lat, lng], 15);

    // Fond de carte OpenStreetMap
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        { attribution: '© OpenStreetMap' }
    ).addTo(carte);

    // Marqueur personnalisé
    var icone = L.divIcon({
        className : 'custom-icon',
        html      : '<span class="material-symbols-outlined" '
                  + 'style="color:#DC3545; font-size:24px;">location_on</span>',
        iconSize  : [24, 24]
    });

    // Ajouter le marqueur
    L.marker([lat, lng], { icon: icone })
     .addTo(carte)
     .bindPopup(
         '<b>📍 ' + reference + '</b>'
     )
     .openPopup();
}

// ---- RECHERCHE EN TEMPS RÉEL ----
document.addEventListener('DOMContentLoaded', function() {

    var inputRecherche = document.getElementById('rechercheRapide');
    if (!inputRecherche) return;

    inputRecherche.addEventListener('keyup', function() {
        var valeur = this.value.toLowerCase();
        var lignes = document.querySelectorAll('tbody tr');

        lignes.forEach(function(ligne) {
            var texte = ligne.textContent.toLowerCase();
            if (texte.includes(valeur)) {
                ligne.style.display = '';
            } else {
                ligne.style.display = 'none';
            }
        });
    });

});

// ---- IMPRIMER LA PAGE ----
function imprimerPage() {
    window.print();
}

// ---- RETOUR EN HAUT ----
window.addEventListener('scroll', function() {
    var bouton = document.getElementById('btnHaut');
    if (!bouton) return;

    if (window.scrollY > 300) {
        bouton.style.display = 'block';
    } else {
        bouton.style.display = 'none';
    }
});

function allerEnHaut() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}