<?php
/* Template Name: Page Devis */
get_header();
?>
<div class="introduction-product" style="background: #0e445f">
    <div class="container container-devis-form">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h2 class="TextWrapper-sc-__sc-1f8vz90-0 RoqyY" style="text-align: center;">Obtenez votre devis rapidement !</h2>
                <div class="container-pricing-product">
                    <form id="upload-image-form" enctype="multipart/form-data">
                        <label>
                            Nom de la société *
                            <input type="text" name="society-name" required>
                        </label>
                        <label>
                            Adresse complète de votre société *
                            <input type="text" name="society-address" required>
                        </label>
                        <label>
                            Ville de votre société *
                            <input type="text" name="society-address-town" required>
                        </label>
                        <label>
                            Code postal de votre société *
                            <input type="text" name="society-address-zip" required>
                        </label>
                        <label>
                            Adresse de votre projet (si différente)
                            <input type="text" name="project-address">
                        </label>
                        <label>
                            Ville de votre projet (si différente)
                            <input type="text" name="project-address-town">
                        </label>
                        <label>
                            Code postal de votre projet (si différente)
                            <input type="text" name="project-address-zip">
                        </label>
                        <label>
                            Votre Prénom *
                            <input type="text" name="first-name" required>
                        </label>
                        <label>
                            Votre Nom *
                            <input type="text" name="second-name" required>
                        </label>
                        <label>
                            Votre Email *
                            <input type="email" name="email" required>
                        </label>
                        <label>
                            Numéro de portable *
                            <input type="tel" name="phone" required>
                        </label>
                        <label>
                            Description du projet
                            <textarea name="description" id="" cols="30" rows="10"></textarea>
                        </label>

                        <label>
                            Ajouter jusqu'à 3 images<br/>
                            <span style="font-size: 10px">(Seuls les fichiers JPG, PNG, GIF et PDF sont autorisés.) <strong>5Mo maximum</strong></span>
                            <input type="file" name="images[]" id="images" accept="image/*,.pdf" multiple>
                        </label>
                        <span style="font-size: 12px">Si vous souhaitez insérer plus de pièces jointes, vous pouvez nous les envoyer sur <a href="mailto:contact@ateliergambetta.com" style="text-decoration: underline">contact@ateliergambetta.com</a></span>
                        <br/><br/>
                        <div id="message"></div>

                        <button type="submit" class="button">Envoyer</button>
                    </form>

                    <div id="message"></div>

                    <script>
                        let fileValidationError = false; // ❗ variable globale pour bloquer le submit si erreur

                        document.getElementById("images").addEventListener("change", function () {
                            let files = this.files;
                            let maxSize = 5 * 1024 * 1024; // 5 Mo
                            let allowedTypes = ["image/jpeg", "image/png", "image/gif", "application/pdf"];
                            let errorMessages = [];

                            document.getElementById("message").innerHTML = ""; // reset

                            // Vérifier le nombre de fichiers
                            if (files.length > 3) {
                                errorMessages.push("Vous ne pouvez envoyer que 3 fichiers maximum.");
                            }

                            for (let i = 0; i < files.length; i++) {
                                let file = files[i];

                                if (!allowedTypes.includes(file.type)) {
                                    errorMessages.push(`Le fichier n'est pas autorisé.`);
                                }

                                if (file.size > maxSize) {
                                    errorMessages.push(`Le fichier dépasse la taille maximale de 5 Mo.`);
                                }
                            }

                            if (errorMessages.length > 0) {
                                this.value = ""; // reset l'input file
                                document.getElementById("message").innerHTML = "<p style='color:red;'>" + errorMessages.join("<br>") + "</p>";
                                fileValidationError = true; // 🚫 blocage
                            } else {
                                fileValidationError = false; // ✅ autorisé
                            }
                        });

                        document.addEventListener("DOMContentLoaded", function () {
                            document.getElementById("upload-image-form").addEventListener("submit", function (e) {
                                e.preventDefault();

                                // ⚠️ Vérifie s’il y a une erreur côté fichier avant d’aller plus loin
                                if (fileValidationError) {
                                    document.getElementById("message").innerHTML = "<p style='color:red;'>Veuillez corriger les erreurs de fichiers avant de soumettre le formulaire.</p>";
                                    return;
                                }

                                $('.loader-form #loader').addClass('visible');
                                $('#upload-image-form button[type="submit"]').attr('disabled', 'disabled');

                                let fileInput = document.getElementById("images");
                                let files = fileInput.files;
                                let maxSize = 5 * 1024 * 1024; // 5 Mo en octets
                                let allowedTypes = ["image/jpeg", "image/png", "image/gif", "application/pdf"];
                                let errorMessages = [];

                                // Vérifier le nombre de fichiers
                                if (files.length > 3) {
                                    errorMessages.push("Vous ne pouvez envoyer que 3 fichiers maximum.");
                                }

                                for (let i = 0; i < files.length; i++) {
                                    let file = files[i];

                                    // Vérifier le type MIME
                                    if (!allowedTypes.includes(file.type)) {
                                        errorMessages.push(`Le fichier n'est pas autorisé.`);
                                    }

                                    // Vérifier la taille du fichier
                                    if (file.size > maxSize) {
                                        errorMessages.push(`Le fichier dépasse la taille maximale de 5 Mo.`);
                                    }
                                }

                                if (errorMessages.length > 0) {
                                    document.getElementById("message").innerHTML = "<p style='color:red;'>" + errorMessages.join("<br>") + "</p>";
                                    fileValidationError = true;
                                    return;
                                } else {
                                    fileValidationError = false;
                                }

                                // Si tout est bon, on envoie le formulaire
                                let formData = new FormData(this);
                                formData.append("action", "add_opportunity");

                                fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                                    method: "POST",
                                    body: formData,
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        window.location.replace('<?php echo get_site_url(); ?>/demande-de-devis/confirmation-demande/');
                                    })
                                    .catch(error => {
                                        window.location.replace('<?php echo get_site_url(); ?>/demande-de-devis/confirmation-demande/');
                                    });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>






<?php get_footer();
