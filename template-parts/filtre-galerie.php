<div class="visible-xs">
    <button class="button filter-buttons-toggle">Filtres</button>
</div>
<form method="GET" action="<?= get_site_url(); ?>/galerie/" class="filters-form">
    <div class="col-filter">
        <p class="intro-filter">Affinez votre recherche : </p>
    </div>
    <!-- Checkbox pour typo_client -->
    <div class="filter-group">
        <h4><?php _e('Clients', 'textdomain'); ?></h4>
        <div class="list-group">
        <?php
        // Fonction récursive pour afficher les termes et leurs enfants
        function display_terms_recursive($terms, $selected, $taxonomy, $level = 0) {
            foreach ($terms as $term) {
                $checked = in_array($term->slug, $selected) ? 'checked' : '';
                echo '<label style="margin-left: ' . ($level * 20) . 'px;">';
                echo '<input type="checkbox" name="' . esc_attr($taxonomy) . '[]" value="' . esc_attr($term->slug) . '" ' . $checked . '>';
                echo esc_html($term->name);
                echo '</label>';

                // Rechercher les termes enfants
                $child_terms = get_terms(array(
                    'taxonomy' => $taxonomy,
                    'parent' => $term->term_id,
                    'hide_empty' => false,
                ));

                if (!empty($child_terms)) {
                    display_terms_recursive($child_terms, $selected, $taxonomy, $level + 1);
                }
            }
        }

        // Obtenir tous les termes parents de la taxonomy 'typo_client'
        $typo_clients = get_terms(array(
            'taxonomy' => 'typo_client',
            'parent' => 0,
            'hide_empty' => false,
        ));

        // Sélectionner les termes cochés
        $selected_clients = isset($_GET['typo_client']) ? (array) $_GET['typo_client'] : array();

        // Afficher les termes et leurs enfants récursivement
        if (!empty($typo_clients)) {
            display_terms_recursive($typo_clients, $selected_clients, 'typo_client');
        }
        ?>
        </div>
    </div>

    <!-- Checkbox pour typo_product -->
    <div class="filter-group">
        <h4><?php _e('Produits', 'textdomain'); ?></h4>
        <div class="list-group">
        <?php
        // Obtenir tous les termes parents de la taxonomy 'typo_product'
        $typo_products = get_terms(array(
            'taxonomy' => 'typo_product',
            'parent' => 0,
            'hide_empty' => false,
        ));

        // Sélectionner les termes cochés
        $selected_products = isset($_GET['typo_product']) ? (array) $_GET['typo_product'] : array();

        // Afficher les termes et leurs enfants récursivement
        if (!empty($typo_products)) {
            display_terms_recursive($typo_products, $selected_products, 'typo_product');
        }
        ?>
        </div>
    </div>

    <!-- Checkbox pour typo_materiaux -->
    <div class="filter-group">
        <h4><?php _e('Matériels', 'textdomain'); ?></h4>
        <div class="list-group">
        <?php
        // Obtenir tous les termes parents de la taxonomy 'typo_materiaux'
        $typo_materiaux = get_terms(array(
            'taxonomy' => 'typo_materiaux',
            'parent' => 0,
            'hide_empty' => false,
        ));

        // Sélectionner les termes cochés
        $selected_materiaux = isset($_GET['typo_materiaux']) ? (array) $_GET['typo_materiaux'] : array();

        // Afficher les termes et leurs enfants récursivement
        if (!empty($typo_materiaux)) {
            display_terms_recursive($typo_materiaux, $selected_materiaux, 'typo_materiaux');
        }
        ?>
        </div>
    </div>
    <div class="col-filter">
        <button type="submit" class="button primary">Filtrer</button>
        <a href="<?= get_site_url(); ?>/galerie/" class="button secondary" style="text-align: center; border: 2px solid #0E445F">Supprimer les filtres</a>
    </div>

    <div id="selected-tags" class="selected-tags"></div>
</form>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.filters-form');
    const tagsContainer = document.getElementById('selected-tags');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');

    // Fonction pour créer un tag
    function createTag(checkbox) {
        const tag = document.createElement('div');
        tag.className = 'tag';
        tag.dataset.value = checkbox.value;
        tag.dataset.taxonomy = checkbox.name;
        
        const label = checkbox.closest('label').textContent.trim();
        tag.innerHTML = `
            ${label}
            <span class="tag-remove">×</span>
        `;

        tag.querySelector('.tag-remove').addEventListener('click', () => {
            checkbox.checked = false;
            tag.remove();
        });

        return tag;
    }

    // Initialiser les tags pour les checkboxes déjà cochées
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            tagsContainer.appendChild(createTag(checkbox));
        }

        // Ajouter l'écouteur d'événements pour les changements
        checkbox.addEventListener('change', (e) => {
            const existingTag = tagsContainer.querySelector(`[data-value="${e.target.value}"][data-taxonomy="${e.target.name}"]`);
            
            if (e.target.checked && !existingTag) {
                tagsContainer.appendChild(createTag(e.target));
            } else if (!e.target.checked && existingTag) {
                existingTag.remove();
            }
        });
    });
});
</script>