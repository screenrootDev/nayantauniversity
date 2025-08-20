<section class="section fade">
      <div class="container">
        <div class="row gy-4">
            
            <?php 
            $undergraduate_heading = get_sub_field('undergraduate_programme_overview_section_heading');
            if (!empty($undergraduate_heading)) : ?>
                <div class="col-12">
                    <div class="section-heading">
                        <?php echo wpautop($undergraduate_heading); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php 
            $programme_cards = get_sub_field('programme_overview_cards');
            if (!empty($programme_cards) && is_array($programme_cards)) : ?>
                <div class="col-12">
                    <div class="card card-big">
                        <div class="row g-4 g-md-5">
                            <?php foreach ($programme_cards as $card) : 
                                $title = $card['programme_overview_title'] ?? '';
                                $description = $card['programme_overview_description'] ?? '';
                                if ($title && $description) : ?>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card-title text-same-color h4">
                                            <?php echo esc_html($title); ?>
                                        </div>
                                        <div class="card-text">
                                            <p><?php echo esc_html($description); ?></p>
                                        </div>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>